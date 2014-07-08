<?php
namespace Arnm\ContactBundle\Model;

use Arnm\ConfigBundle\Model\ConfigImpl;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This class is responsible for configuration handling of contact
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ContactDetails extends ConfigImpl
{

    /**
     * First line of the address
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $address1;
    /**
     * Sencond line of the address
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $address2;
    /**
     * City
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $city;
    /**
     * State/province
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $state;
    /**
     * Country
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $country;
    /**
     * Zip code
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $zip;
    /**
     * Phone number
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     */
    protected $phone;
    /**
     * Email address
     *
     * @var string
     *
     * @Assert\Type(type="string", message="The value {{ value }} is not a valid {{ type }}.")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true,
     *     checkHost = true
     * )
     */
    protected $email;

    /**
     * {@inheritdoc}
     * @see Arnm\ConfigBundle\Model.ConfigInterface::getNamespace()
     */
    public function getNamespace()
    {
        return 'contact';
    }

	/**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

	/**
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

	/**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

	/**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

	/**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

	/**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

	/**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

	/**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

	/**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

	/**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

	/**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

	/**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

	/**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

	/**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
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
        $this->email = $email;

        return $this;
    }
}
