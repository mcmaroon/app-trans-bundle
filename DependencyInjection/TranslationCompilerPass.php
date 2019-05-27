<?php

namespace App\TransBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use App\TransBundle\Translation\Translator;

class TranslationCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $reference = new Reference('doctrine');
        $container->getDefinition('translator.default')->setClass(Translator::class);
        $container->getDefinition('translator.default')->addMethodCall('setDoctrine', [$reference]);
    }

}
