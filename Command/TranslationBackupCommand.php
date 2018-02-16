<?php
namespace App\TransBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use App\TransBundle\Entity\Translator;

class TranslationBackupCommand extends ContainerAwareCommand
{

    protected $output;
    protected $container;
    protected $log;

    protected function configure()
    {
        $this
            ->setName('app:translation:backup')
            ->setDescription('backup translations')
        ;
    }

    // ~

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->output = $output;
        $this->container = $this->getContainer();
        $this->log = $this->container->get('app.log');
        $this->doctrine = $this->container->get('doctrine');
        $this->em = $this->doctrine->getManager();
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);

        // ~

        $ymls = [];
        $translatorEntities = $this->em->getRepository(Translator::class)->findAll();
        foreach ($translatorEntities as $translatorEntity) {
            foreach ($translatorEntity->getTranslations() as $translation) {
                if (!isset($ymls[$translation->getLocale()])) {
                    $ymls[$translation->getLocale()] = [];
                }
                $ymls[$translation->getLocale()][$translatorEntity->getStrId()] = $translation->getName();
            }
        }

        $path = $this->container->get('kernel')->getLogDir() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'messages' . DIRECTORY_SEPARATOR;

        $fs = new Filesystem();

        try {
            $fs->mkdir($path);
        } catch (IOExceptionInterface $e) {
            $this->output->writeln("An error occurred while creating your directory at " . $e->getPath());
        }

        foreach ($ymls as $langKey => $yml) {
            $yaml = Yaml::dump($yml);
            $fileName = 'messages.' . $langKey;
            $fileNameDate = $fileName . '-' . date('Y-m-d_H-i');
            file_put_contents($path . $fileName . '.yml', $yaml);
            file_put_contents($path . $fileNameDate . '.yml', $yaml);
        }
        $this->output->writeln("Backup of translation files is located in the directory " . $path);
    }
}
