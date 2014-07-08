<?php
namespace Arnm\ContactBundle\Controller;

use Arnm\ContactBundle\Form\RequestType;

use Arnm\ContactBundle\Entity\Request;

use Arnm\ContactBundle\Model\ContactDetails;

use Arnm\CoreBundle\Controllers\ArnmController;
/**
 * This is the main contact page controller used in the actual website itself
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ContactController extends ArnmController
{

    public function indexAction($submitted = false)
    {
        //get all the config for contact details
        $details = new ContactDetails();
        $this->get('arnm_config.manager')->load($details);

        //create the form object
        $request = new Request();
        $form = $this->createForm(new RequestType(), $request);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($request);
                $em->flush();

                $this->get('arnm_contact.manager')->sendNotification($request);

                return $this->redirect($this->generateUrl('contact_sent'));
            }
        }

        return $this->render('ArnmContactBundle:Contact:index.html.twig',
        array(
            'details' => $details,
            'form' => $form->createView(),
            'submitted' => $submitted
        ));
    }
}
