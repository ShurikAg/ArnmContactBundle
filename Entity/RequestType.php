<?php
namespace Arnm\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
/**
 * Arnm\ContactBundle\Entity\RequestType
 *
 * @ORM\Table(name="request_type")
 * @ORM\Entity(repositoryClass="Arnm\ContactBundle\Entity\RequestTypeRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 *
 * @UniqueEntity("type")
 */
class RequestType
{
    use SoftDeleteableEntity;
    use TimestampableEntity;
    use BlameableEntity;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255, unique=true)
     * @Gedmo\Versioned
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $type;

    /**
     * @var boolean $active
     *
     * @ORM\Column(name="active", type="boolean")
     * @Gedmo\Versioned
     */
    private $active = true;

    /**
     * @var ArrayCollection $Request
     *
     * @ORM\OneToMany(targetEntity="Request", mappedBy="type")
     */
    private $requests;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->requests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return RequestType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return RequestType
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Adds a single request into the list
     *
     * @param \Arnm\ContactBundle\Entity\Request $resquest
     *
     * @return RequestType
     */
    public function addRequest(\Arnm\ContactBundle\Entity\Request $resquest)
    {
        $this->requests[] = $resquest;

        return $this;
    }

    /**
     * Gets a collection of all requests related to this type
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRequests()
    {
        return $this->requests;
    }
}
