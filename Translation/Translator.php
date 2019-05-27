<?php

namespace App\TransBundle\Translation;

use Symfony\Bundle\FrameworkBundle\Translation\Translator as BaseTranslator;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\TransBundle\Entity\Translator as EntityTranslator;

class Translator extends BaseTranslator
{

    private $doctrine;

    public function setDoctrine(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        if (null === $domain) {
            $domain = 'messages';
        }

        $em = $this->doctrine->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityTranslator = $em->getRepository(EntityTranslator::class)->findOneByStrId($id);

        if (!$entityTranslator) {
            $entityTranslator = new EntityTranslator();
            $entityTranslator->setStrId($id);
            $em->persist($entityTranslator);
            $em->flush();
        }

        $str = (string)$entityTranslator;

        if (!strlen($str)) {
            $str = strtr($this->getCatalogue($locale)->get((string)$id, $domain), $parameters);
        }

        return $str;
    }
}
