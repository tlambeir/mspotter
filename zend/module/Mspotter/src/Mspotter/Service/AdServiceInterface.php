<?php
// Filename: /module/Mspotter/src/Mspotter/Service/AdServiceInterface.php
namespace Mspotter\Service;

use Mspotter\Model\AdInterface;

interface AdServiceInterface
{
    /**
     * Should return a set of all Mspotter ads that we can iterate over. Single entries of the array are supposed to be
     * implementing \Mspotter\Model\AdInterface
     *
     * @return array|AdInterface[]
     */
    public function findAllAds();

    /**
     * Should return a single Mspotter ad
     *
     * @param  int $id Identifier of the Ad that should be returned
     * @return AdInterface
     */
    public function findAd($id);

    /**
     * Should save a given implementation of the AdInterface and return it. If it is an existing Ad the Ad
     * should be updated, if it's a new Ad it should be created.
     *
     * @param  AdInterface $Mspotter
     * @return AdInterface
     */
    public function saveAd(AdInterface $Mspotter);

    /**
     * Should delete a given implementation of the AdInterface and return true if the deletion has been
     * successful or false if not.
     *
     * @param  AdInterface $Mspotter
     * @return bool
     */
    public function deleteAd(AdInterface $Mspotter);
}