<?php
namespace Arnm\ContactBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
/**
 * Request type form class
 *
 * @author Alex Agulyansky <alex@iibspro.com>
 */
class SettingsType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('sendNewContactNotification', 'checkbox', array(
        'label' => 'contact.details.form.sendNewContactNotification.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.sendNewContactNotification.help',
            'translation_domain' => 'contact',
            'class' => 'checkbox'
        ),
        'translation_domain' => 'contact',
        'required' => false
    ));
    $builder->add('name', 'text', array(
        'label' => 'contact.details.form.name.label',
        'attr' => array(
            'data-toggle' => 'popover',
            'content' => 'contact.details.form.name.help',
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
    return 'contact_settings';
  }

  /**
   * (non-PHPdoc)
   * @see Symfony\Component\Form.AbstractType::getDefaultOptions()
   */
  public function getDefaultOptions(array $options)
  {
    return array(
        'data_class' => 'Arnm\ContactBundle\Model\Settings'
    );
  }
}
