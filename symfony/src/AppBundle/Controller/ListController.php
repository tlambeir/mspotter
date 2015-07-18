<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Ad;
use Symfony\Component\HttpFoundation\Response;

class ListController extends Controller
{
    /**
     * @Route("/mspotter", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Category');
        $categories = $repository->findRootCategories();

        return $this->render(
            'AppBundle:mspotter:list.html.twig',
            array('categories' => $categories)
        );
    }

    /**
     * @Route("/mspotter/add")
     */
    public function createAction()
    {
        $ad = new Ad();
        $ad->setName('A Foo Bar');
        $ad->setPrice('19.99');
        $ad->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();

        $em->persist($ad);
        $em->flush();

        return new Response('Created ad id '.$ad->getId());
    }

    /**
     * @Route("/mspotter/addwithcategory")
     */
    public function createAdAction()
    {
        $category = new Category();
        $category->setName('Main Ads');

        $ad = new Ad();
        $ad->setName('Foo');
        $ad->setPrice(19.99);
        $ad->setDescription('Lorem ipsum dolor');
        // relate this ad to the category
        $ad->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($ad);
        $em->flush();

        return new Response(
            'Created ad id: '.$ad->getId()
            .' and category id: '.$category->getId()
        );
    }

    /**
     * @Route("/mspotter/{id}",requirements={"id": "\d+"}, name="detail")
     */
    public function showAction($id)
    {
        $ad = $this->getDoctrine()
            ->getRepository('AppBundle:Ad')
            ->find($id);

        if (!$ad) {
            throw $this->createNotFoundException(
                'No ad found for id '.$id
            );
        }

        return $this->render(
            'AppBundle:mspotter:detail.html.twig',
            array('name' => $ad->getName())
        );
    }
}
