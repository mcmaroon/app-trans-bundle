<?php

namespace App\TransBundle\Controller;

use App\AppBundle\Helper\AbstractAdminController;
use App\TransBundle\Entity\Translator;
use App\TransBundle\Form\AdminTranslatorType;

class AdminTranslatorController extends AbstractAdminController
{
    public function getControllerBundleName(){
        return 'AppTransBundle';
    }
    
    public function getControllerEntity() {
        return new Translator;
    }

    public function getControllerFormType() {
        return AdminTranslatorType::class;
    }
}
