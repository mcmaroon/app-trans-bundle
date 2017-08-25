<?php

namespace App\TransBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use App\TransBundle\Translation\Translator;

class TranslationCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $container->getDefinition('translator.default')->setClass(Translator::class);
    }

}
