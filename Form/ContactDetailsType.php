<?php
namespace Arnm\ContactBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
/**
 * Request type form class
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class ContactDetailsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('address1', 'text', array(
        'label' => 'contact.details.form.address1.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.address1.help',
    		'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('address2', 'text', array(
        'label' => 'contact.details.form.address2.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.address2.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('city', 'text', array(
        'label' => 'contact.details.form.city.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.city.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('state', 'text', array(
        'label' => 'contact.details.form.state.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.state.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('country', 'text', array(
        'label' => 'contact.details.form.country.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.country.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('zip', 'text', array(
        'label' => 'contact.details.form.zip.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.zip.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('phone', 'text', array(
        'label' => 'contact.details.form.phone.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.phone.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('email', 'text', array(
        'label' => 'contact.details.form.email.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.email.help',
            'translation_domain' => 'contact',
            'class' => 'form-control'
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
    return 'contact_config';
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   */
  public function getDefaultOptions(array $options)
  {
    return array(
        'data_class' => 'Arnm\ContactBundle\Model\ContactDetails'
    );
  }
}
