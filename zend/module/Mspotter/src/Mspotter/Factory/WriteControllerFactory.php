<?php
// Filename: /module/Mspotter/src/Mspotter/Factory/WriteControllerFactory.php
namespace Mspotter\Factory;

use Mspotter\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $adService        = $realServiceLocator->get('Mspotter\Service\AdServiceInterface');
        $adInsertForm     = $realServiceLocator->get('FormElementManager')->get('Mspotter\Form\AdForm');

        return new WriteController(
            $adService,
            $adInsertForm
        );
    }
}