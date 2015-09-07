<?php
namespace Arnm\ContactBundle\Service;

use Arnm\ConfigBundle\Manager\ConfigManager;
use Arnm\ContactBundle\Entity\Request;
use Arnm\ContactBundle\Model\Settings;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;
/**
 * This is a service class for number of functionalities for contact us bundle
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ContactManager
{
    /**
     * Instance of config manager
     *
     * @var Arnm\ConfigBundle\Manager\ConfigManager
     */
    protected $configMgr;

    /**
     * Instance of mailer
     *
     * @var Swift_Mailer
     */
    protected $mailer;

    /**
     * Settings object
     *
     * @var Settings
     */
    protected $settings;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var Symfony\Bundle\TwigBundle\TwigEngine
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param ConfigManager $configMgr
     */
    public function __construct(ConfigManager $configMgr, \Swift_Mailer $mailer, TranslatorInterface $translator, TwigEngine $templating)
    {
        $this->setConfigMgr($configMgr);
        $this->setMailer($mailer);
        $this->setTranslator($translator);
        $this->setTemplating($templating);
    }

    /**
     * Sends notification about newly received request if configured to send one.
     *
     * @param Request $request
     */
    public function sendNotification(Request $request)
    {
        if (! $this->notificationNeeded()) {
            return;
        }

        $message = $this->createMessageObject($request, $this->getContactSettings());

        return $this->getMailer()->send($message);
    }

    /**
     * Creates a full messages that eventually will be sent as notification
     *
     * @param Request $request
     * @param Settings $settings
     *
     * @return \Swift_Message
     */
    protected function createMessageObject(Request $request, Settings $settings)
    {
        $message = \Swift_Message::newInstance();
        $message->setTo($settings->getEmail(), $settings->getName());
        $message->setFrom($settings->getEmail(), $settings->getName());
        $message->setReplyTo($request->getEmail(), $request->getName());
        $message->setSubject($request->getSubject());
        //build html message
        $htmlMessage = $this->getTemplating()->render('ArnmContactBundle:Emails:notification.html.twig', array('request' => $request));
        $plainMessage = $this->getTemplating()->render('ArnmContactBundle:Emails:notification.plain.twig', array('request' => $request));
        $message->setBody($htmlMessage, 'text/html');
        $message->addPart($plainMessage, 'text/plain');

        return $message;
    }


    /**
     * Determines if we need and can send notification about a request
     *
     * @return boolean
     */
    protected function notificationNeeded()
    {
        $settings = $this->getContactSettings();
        $email = $settings->getEmail();
        if ($settings->getSendNewContactNotification() == true && ! empty($email)) {
            return true;
        }

        return false;
    }

    /**
     * Gets contact settings object
     *
     * @return Arnm\ContactBundle\Model\Settings
     */
    protected function getContactSettings()
    {
        if (! ($this->settings instanceof Settings)) {
            $this->settings = new Settings();
            $this->configMgr->load($this->settings);
        }

        return $this->settings;
    }

    /**
     * @return ConfigManager
     */
    public function getConfigMgr()
    {
        return $this->configMgr;
    }

    /**
     * @param Arnm\ConfigBundle\Manager\ConfigManager $configMgr
     *
     * @return ContactManager
     */
    public function setConfigMgr(ConfigManager $configMgr)
    {
        $this->configMgr = $configMgr;

        return $this;
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param \Swift_Mailer $mailer
     *
     * @return ContactManager
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }

    /**
     * @param Settings $settings
     *
     * @return ContactManager
     */
    public function setSettings(Settings $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return TranslatorInterface
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param TranslatorInterface $translator
     *
     * @return ContactManager
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * @return TwigEngine
     */
    public function getTemplating()
    {
        return $this->templating;
    }

    /**
     * @param Symfony\Bundle\TwigBundle\TwigEngine $templating
     *
     * @return ContactManager
     */
    public function setTemplating(TwigEngine $templating)
    {
        $this->templating = $templating;

        return $this;
    }

}
