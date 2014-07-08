<?php
namespace Arnm\ContactBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
/**
 * Request type form class
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class RequestTypeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('type', 'text', array(
        'label' => 'contact.request_type.form.type.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.request_type.form.type.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('active', 'checkbox', array(
        'label' => 'contact.request_type.form.active.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.request_type.form.active.help',
            'translation_domain' => 'contact',
            'class' => 'checkbox'
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
    return 'request_type';
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   */
  public function getDefaultOptions(array $options)
  {
    return array(
        'data_class' => 'Arnm\ContactBundle\Entity\RequestType'
    );
  }
}
