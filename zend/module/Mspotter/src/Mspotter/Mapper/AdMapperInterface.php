<?php
// Filename: /module/Mspotter/src/Mspotter/Mapper/AdMapperInterface.php
namespace Mspotter\Mapper;

use Mspotter\Model\AdInterface;

interface AdMapperInterface
{
    /**
     * @param int|string $id
     * @return AdInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @return array|AdInterface[]
     */
    public function findAll();

    /**
     * @param AdInterface $adObject
     *
     * @param AdInterface $adObject
     * @return AdInterface
     * @throws \Exception
     */
    public function save(AdInterface $adObject);

    /**
     * @param AdInterface $adObject
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(AdInterface $adObject);

}