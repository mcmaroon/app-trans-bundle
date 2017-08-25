<?php

namespace App\TransBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\TransBundle\DependencyInjection\TranslationCompilerPass;

class AppTransBundle extends Bundle
{
    public function build(ContainerBuilder $container) {
        parent::build($container);

        $container->addCompilerPass(new TranslationCompilerPass());
    }
}
