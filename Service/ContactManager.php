<?php
namespace Arnm\ContactBundle\Service;

use Arnm\ConfigBundle\Manager\ConfigManager;
use Arnm\ContactBundle\Entity\Request;
use Arnm\ContactBundle\Model\Settings;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
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
     * @var Symfony\Bundle\FrameworkBundle\Translation\Translator
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
    public function __construct(ConfigManager $configMgr,\Swift_Mailer $mailer, Translator $translator, TwigEngine $templating)
    {
        $this->configMgr = $configMgr;
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->templating = $templating;
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

        return $this->mailer->send($message);
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
        $htmlMessage = $this->templating->render('ArnmContactBundle:Emails:notification.html.twig', array('request' => $request));
        $plainMessage = $this->templating->render('ArnmContactBundle:Emails:notification.plain.twig', array('request' => $request));
        $message->setBody($htmlMessage, 'text/html');
        $message->addPart($plainMessage, 'text/plain');

        return $message;
    }

    /**
     * Constructs andsends the actual notification
     *
     * @param Resquest $request
     * @param Settings $settings
     */
    protected function doSendNotifcation(Resquest $request, Settings $settings)
    {

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
}
