<?php
namespace Arnm\ContactBundle\Controller;

use Arnm\ContactBundle\Form\SettingsType;

use Arnm\ContactBundle\Model\Settings;

use Arnm\ConfigBundle\Manager\ConfigManager;
use Arnm\CoreBundle\Controllers\ArnmController;
/**
 * This controller administrates contact bundle configurations
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class SettingsController extends ArnmController
{

    /**
     * Shows and handles editing of existing category form
     *
     * @return Response
     */
    public function editAction()
    {
        $config = new Settings();
        $configMgr = $this->getConfigManager();
        $configMgr->load($config);

        $form = $this->createForm(new SettingsType(), $config);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                try {
                    $configMgr->save($config);

                    $this->getSession()
                        ->getFlashBag()
                        ->add('notice', $this->get('translator')
                        ->trans('contact.settings.message.update.success', array(), 'contact'));
                } catch (\Exception $exc) {
                    $this->getSession()
                        ->getFlashBag()
                        ->add('error', $this->get('translator')
                        ->trans($exc->getMessage(), array(), 'contact'));
                }

                return $this->redirect($this->generateUrl('arnm_contact_settings'));
            }
        }
        return $this->render('ArnmContactBundle:Settings:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Gets an instance of config manager
     *
     * @return Arnm\ConfigBundle\Manager\ConfigManager
     */
    protected function getConfigManager()
    {
        return $this->get('arnm_config.manager');
    }
}
