<?php
namespace App\TransBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Translator
 *
 * @ORM\Table(
 *      name="translator"
 * )
 * @ORM\Entity(repositoryClass="App\TransBundle\Repository\TranslatorRepository")
 */
class Translator
{

    use \Knp\DoctrineBehaviors\Model\Translatable\Translatable;
    use \App\AppBundle\Model\Traits\TranslatablePropertyAccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strId;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setStrId($strId)
    {
        $this->strId = \trim($strId);

        return $this;
    }

    public function getStrId()
    {
        return $this->strId;
    }

}
