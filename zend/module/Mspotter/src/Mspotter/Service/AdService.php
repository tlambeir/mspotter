<?php
// Filename: /module/Mspotter/src/Mspotter/Service/AdService.php
namespace Mspotter\Service;

use Mspotter\Mapper\AdMapperInterface;
use Mspotter\Model\AdInterface;

class AdService implements AdServiceInterface
{
    /**
     * @var \Mspotter\Mapper\AdMapperInterface
     */
    protected $adMapper;
    /**
     * @param AdMapperInterface $adMapper
     */
    public function __construct(AdMapperInterface $adMapper)
    {
        $this->adMapper = $adMapper;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllAds()
    {
        return $this->adMapper->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findAd($id)
    {
        return $this->adMapper->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function saveAd(AdInterface $ad)
    {
        return $this->adMapper->save($ad);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteAd(AdInterface $ad)
    {
        return $this->adMapper->delete($ad);
    }
}