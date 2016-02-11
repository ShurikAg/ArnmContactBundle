<?php
namespace Arnm\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Blameable\Traits\BlameableEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Arnm\ContactBundle\Entity\Request
 *
 * @ORM\Table(name="request")
 * @ORM\Entity(repositoryClass="Arnm\ContactBundle\Entity\RequestRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @Gedmo\Loggable
 */
class Request
{
    use SoftDeleteableEntity;
    use TimestampableEntity;
    use BlameableEntity;

    const STATUS_NEW = 'new';
    const STATUS_READ = 'read';
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Gedmo\Versioned
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $name;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Gedmo\Versioned
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     * @Assert\Email(
     * message = "The email '{{ value }}' is not a valid email.",
     * checkMX = true,
     * checkHost = true
     * )
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     * @Gedmo\Versioned
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $phone;

    /**
     * @var string $subject
     *
     * @ORM\Column(name="subject", type="string", length=255)
     * @Gedmo\Versioned
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $subject;

    /**
     * @var string $message
     *
     * @ORM\Column(name="message", type="string", length=1000)
     * @Gedmo\Versioned
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $message;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=20)
     * @Gedmo\Versioned
     */
    private $status = self::STATUS_NEW;

    /**
	 * @var RequestType $type
	 *
	 * @ORM\ManyToOne(targetEntity="RequestType", inversedBy="requests")
	 * @ORM\JoinColumn(name="request_type_id", referencedColumnName="id", nullable=true)
	 * @Gedmo\Versioned
	 */
	private $type;


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
     * Set name
     *
     * @param string $name
     * @return Request
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Request
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Request
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Request
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Request
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Request
     */
    public function setStatus($status)
    {
        if(!in_array($status, array(self::STATUS_NEW, self::STATUS_READ)))
        {
            throw new \RuntimeException("Not valid status!");
        }
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
