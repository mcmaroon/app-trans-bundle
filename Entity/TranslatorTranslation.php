<?php
namespace App\TransBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(
 *      name="translator_translation"
 * )
 * @ORM\Entity
 */
class TranslatorTranslation
{

    use ORMBehaviors\Translatable\Translation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    public function setName($name)
    {
        $this->name = \trim($name);

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}
