<?php
// Filename: /module/Mspotter/src/Mspotter/Factory/ZendDbSqlMapperFactory.php
namespace Mspotter\Factory;

use Mspotter\Mapper\ZendDbSqlMapper;
use Mspotter\Model\Ad;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ZendDbSqlMapperFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ZendDbSqlMapper(
            $serviceLocator->get('Zend\Db\Adapter\Adapter'),
            new ClassMethods(false),
            new Ad()
        );
    }
}