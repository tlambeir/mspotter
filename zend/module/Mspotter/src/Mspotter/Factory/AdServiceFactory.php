<?php
// Filename: /module/Mspotter/src/Mspotter/Factory/AdServiceFactory.php
namespace Mspotter\Factory;

use Mspotter\Service\AdService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new AdService(
            $serviceLocator->get('Mspotter\Mapper\AdMapperInterface')
        );
    }
}