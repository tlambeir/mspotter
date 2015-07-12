<?php

namespace Mspotter\Controller;

use Mspotter\Service\AdServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    protected $adService;

    protected $adForm;

    public function __construct(
        AdServiceInterface $adService,
        FormInterface $adForm
    ) {
        $this->adService = $adService;
        $this->adForm    = $adForm;
    }

    public function addAction()
    {
        $request = $this->getRequest();

        if ($request->isAd()) {
            $this->adForm->setData($request->getAd());

            if ($this->adForm->isValid()) {
                try {
                    $this->adService->saveAd($this->adForm->getData());

                    return $this->redirect()->toRoute('ads');
                } catch (\Exception $e) {
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->adForm
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $ad    = $this->adService->findAd($this->params('id'));

        $this->adForm->bind($ad);

        if ($request->isAd()) {
            $this->adForm->setData($request->getAd());

            if ($this->adForm->isValid()) {
                try {
                    $this->adService->saveAd($ad);

                    return $this->redirect()->toRoute('ads');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->adForm
        ));
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