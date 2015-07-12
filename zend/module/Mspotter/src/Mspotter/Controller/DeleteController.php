<?php

namespace Mspotter\Controller;

use Mspotter\Service\AdsServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var \Mspotter\Service\AdsServiceInterface
     */
    protected $adService;

    public function __construct(AdsServiceInterface $adService)
    {
        $this->adService = $adService;
    }

    public function deleteAction()
    {
        try {
            $ad = $this->adService->findAd($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('ads');
        }

        $request = $this->getRequest();

        if ($request->isAd()) {
            $del = $request->getAd('delete_confirmation', 'no');

            if ($del === 'yes') {
                $this->adService->deleteAd($ad);
            }

            return $this->redirect()->toRoute('ads');
        }

        return new ViewModel(array(
            'ad' => $ad
        ));
    }
}