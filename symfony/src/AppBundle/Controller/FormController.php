<?php
// src/AppBundle/Controller/DefaultController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Ad;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\AdType;

class FormController extends Controller
{
    /**
     * @Route("/mspotter/plaats-advertentie.html", name="place_ad")
     */
    public function placeAdAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $ad = new Ad();

        $form = $this->createForm(
            'ad',
            $ad
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($ad);
            $em->flush();
            return $this->redirectToRoute('place_ad_success');
        }

        return $this->render(
            'AppBundle:mspotter/form:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/mspotter/plaats-advertentie-success.html", name="place_ad_success")
     */
    public function placeAdSuccessAction()
    {
        return $this->render('AppBundle:mspotter/form:success.html.twig');
    }
}