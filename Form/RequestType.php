<?php
namespace Arnm\ContactBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
/**
 * Request form class
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class RequestType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', 'text', array(
        'label' => 'contact.request.form.name.label',
        'attr' => array(
            'rel' => 'tooltip',
            'title' => 'contact.request.form.name.help',
            'class' => 'span4'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('email', 'text', array(
        'label' => 'contact.request.form.email.label',
        'attr' => array(
            'rel' => 'tooltip',
            'title' => 'contact.request.form.email.help',
            'class' => 'span4'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('subject', 'text', array(
        'label' => 'contact.request.form.subject.label',
        'attr' => array(
            'rel' => 'tooltip',
            'title' => 'contact.request.form.subject.help',
            'class' => 'span5 subject'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('message', 'textarea', array(
        'label' => 'contact.request.form.message.label',
        'attr' => array(
            'rel' => 'tooltip',
            'title' => 'contact.request.form.message.help',
            'class' => 'span5 message'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.FormTypeInterface::getName()
   */
  public function getName()
  {
    return 'request';
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   */
  public function getDefaultOptions(array $options)
  {
    return array(
        'data_class' => 'Arnm\ContactBundle\Entity\Request'
    );
  }
}
