<?php

namespace Mspotter\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Mspotter\Service\AdServiceInterface;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     * @var \Mspotter\Service\AdServiceInterface
     */
    protected $adService;

    public function __construct(AdServiceInterface $adService)
    {
        $this->adService = $adService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'ads' => $this->adService->findAllAds()
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $ad = $this->adService->findAd($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('ads');
        }

        return new ViewModel(array(
            'ad' => $ad
        ));
    }
}