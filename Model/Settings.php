<?php
namespace Arnm\ContactBundle\Model;

use Arnm\ConfigBundle\Model\ConfigImpl;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This class is responsible for configuration handling of contact module
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class Settings extends ConfigImpl
{

    /**
     * Whether or not to send new contact notifications
     *
     * @var boolean
     *
     * @Assert\Type(type="boolean", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $sendNewContactNotification;

    /**
     * Email to which the notification should be sent
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     * @Assert\Email(
     * message = "The email '{{ value }}' is not a valid email.",
     * checkMX = true,
     * checkHost = true
     * )
     */
    protected $email;

    /**
     * Name to whom to send the notification
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $name;

    /**
     * {@inheritdoc}
     * @see Arnm\ConfigBundle\Model.ConfigInterface::getNamespace()
     */
    public function getNamespace()
    {
        return 'contact_settings';
    }
    /**
     * @return boolean
     */
    public function getSendNewContactNotification()
    {
        return $this->sendNewContactNotification;
    }

    /**
     * @param boolean $sendNewContactNotification
     */
    public function setSendNewContactNotification($sendNewContactNotification)
    {
        $this->sendNewContactNotification = (boolean) $sendNewContactNotification;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }
}
