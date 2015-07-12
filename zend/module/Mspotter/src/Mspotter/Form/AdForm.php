<?php
// Filename: /module/Mspotter/src/Mspotter/Form/AdForm.php
namespace Mspotter\Form;

use Zend\Form\Form;

class AdForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'ad-fieldset',
            'type' => 'Mspotter\Form\AdFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Insert new Ad'
            )
        ));
    }
}