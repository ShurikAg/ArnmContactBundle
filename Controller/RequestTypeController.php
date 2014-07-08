<?php
namespace Arnm\ContactBundle\Controller;

use Arnm\ContactBundle\Form\RequestTypeType;

use Arnm\ContactBundle\Entity\RequestType;

use Arnm\CoreBundle\Controllers\ArnmController;
/**
 * This controller administrate request types
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class RequestTypeController extends ArnmController
{
    /**
     * Shows a list of request types
     *
     * @return Response
     */
    public function indexAction()
    {
        $entities = $this->getEntityManager()
            ->getRepository('ArnmContactBundle:RequestType')
            ->findAll();

        return $this->render('ArnmContactBundle:RequestType:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Shows and handles create new request type form
     *
     * @return Response
     */
    public function newAction()
    {
        $type = new RequestType();
        $form = $this->createForm(new RequestTypeType(), $type);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $em->persist($type);
                $em->flush();

                $this->getSession()
                    ->getFlashBag()
                    ->add('notice', $this->get('translator')
                    ->trans('contact.request_type.message.create.success', array(), 'contact'));

                return $this->redirect($this->generateUrl('arnm_contact_request_types'));
            }
        }
        return $this->render('ArnmContactBundle:RequestType:new.html.twig',
        array(
            'type' => $type,
            'form' => $form->createView()
        ));
    }

    /**
     * Shows and handles editing of existing category form
     *
     * @return Response
     */
    public function editAction($id)
    {
        $em = $this->getEntityManager();
        $type = $em->getRepository('ArnmContactBundle:RequestType')->findOneById($id);
        if (! ($type instanceof RequestType)) {
            throw new $this->createNotFoundException("Requested type was not found!");
        }

        $form = $this->createForm(new RequestTypeType(), $type);

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $em->persist($type);
                $em->flush();

                $this->getSession()
                    ->getFlashBag()
                    ->add('notice', $this->get('translator')
                    ->trans('contact.request_type.message.update.success', array(), 'contact'));

                return $this->redirect(
                $this->generateUrl('arnm_contact_request_type_edit', array(
                    'id' => $type->getId()
                )));
            }
        }
        return $this->render('ArnmContactBundle:RequestType:edit.html.twig',
        array(
            'type' => $type,
            'form' => $form->createView()
        ));
    }

    /**
     * Delete category
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        $em = $this->getEntityManager();
        $type = $em->getRepository('ArnmContactBundle:RequestType')->findOneById($id);
        if (! ($type instanceof RequestType)) {
            throw new $this->createNotFoundException("Requested type was not found!");
        }

        if ($type->getRequests()->count() > 0) {
            $this->getSession()
                ->getFlashBag()
                ->add('error', $this->get('translator')
                ->trans('contact.request_type.message.delete.fail.requests_exists', array(), 'contact'));
        } else {
            $em->remove($type);
            $em->flush();

            $this->getSession()
                ->getFlashBag()
                ->add('notice', $this->get('translator')
                ->trans('contact.request_type.message.delete.success', array(), 'contact'));
        }
        return $this->redirect($this->generateUrl('arnm_contact_request_types'));
    }
}
