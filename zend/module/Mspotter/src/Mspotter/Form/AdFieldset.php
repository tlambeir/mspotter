<?php
// Filename: /module/Mspotter/src/Mspotter/Form/AdFieldset.php
namespace Mspotter\Form;

use Mspotter\Model\Ad;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;


class AdFieldset extends Fieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Ad());

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'

        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'text',
            'options' => array(
                'label' => 'The Text'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => 'Ad Title'
            )
        ));
    }
}