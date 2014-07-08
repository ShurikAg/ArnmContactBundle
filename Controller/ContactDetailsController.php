<?php
namespace Arnm\ContactBundle\Controller;

use Arnm\ContactBundle\Form\ContactDetailsType;
use Arnm\ContactBundle\Model\ContactDetails;
use Arnm\ConfigBundle\Manager\ConfigManager;
use Arnm\CoreBundle\Controllers\ArnmController;
/**
 * This controller administrates contact bundle configurations
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ContactDetailsController extends ArnmController
{

    /**
     * Shows and handles editing of existing category form
     *
     * @return Response
     */
    public function editAction()
    {
        $config = new ContactDetails();
        $configMgr = $this->getConfigManager();
        $configMgr->load($config);

        $form = $this->createForm(new ContactDetailsType(), $config);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                try {
                    $configMgr->save($config);

                    $this->getSession()
                        ->getFlashBag()
                        ->add('notice', $this->get('translator')
                        ->trans('contact.details.message.update.success', array(), 'contact'));
                } catch (\Exception $exc) {
                    $this->getSession()
                        ->getFlashBag()
                        ->add('error', $this->get('translator')
                        ->trans($exc->getMessage(), array(), 'contact'));
                }

                return $this->redirect($this->generateUrl('arnm_contact_details'));
            }
        }
        return $this->render('ArnmContactBundle:ContactDetails:edit.html.twig', array(
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
