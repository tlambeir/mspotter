<?php
// Filename: /module/Mspotter/src/Mspotter/Mapper/ZendDbSqlMapper.php
namespace Mspotter\Mapper;

use Mspotter\Model\AdInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements AdMapperInterface
{
    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $dbAdapter;

    /**
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \Mspotter\Model\AdInterface
     */
    protected $adPrototype;

    /**
     * @param AdapterInterface $dbAdapter
     * @param HydratorInterface $hydrator
     * @param AdInterface $adPrototype
     */
    public function __construct(AdapterInterface $dbAdapter, HydratorInterface $hydrator, AdInterface $adPrototype)
    {
        $this->dbAdapter      = $dbAdapter;
        $this->hydrator       = $hydrator;
        $this->adPrototype  = $adPrototype;
    }

    /**
     * @param int|string $id
     *
     * @return AdInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('ads');
        $select->where(array('id = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->adPrototype);
        }

        throw new \InvalidArgumentException("Mspotter with given ID:{$id} not found.");
    }

    /**
     * @return array|AdInterface[]
     */
    public function findAll()
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('ads');

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->adPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

    /**
     * @param AdInterface $adObject
     *
     * @return AdInterface
     * @throws \Exception
     */
    public function save(AdInterface $adObject)
    {
        $adData = $this->hydrator->extract($adObject);
        unset($adData['id']); // Neither Insert nor Update needs the ID in the array

        if ($adObject->getId()) {
            // ID present, it's an Update
            $action = new Update('ads');
            $action->set($adData);
            $action->where(array('id = ?' => $adObject->getId()));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('ads');
            $action->values($adData);
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $adObject->setId($newId);
            }

            return $adObject;
        }

        throw new \Exception("Database error");
    }

    /**
     * {@inheritDoc}
     */
    public function delete(AdInterface $adObject)
    {
        $action = new Delete('ads');
        $action->where(array('id = ?' => $adObject->getId()));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }
}