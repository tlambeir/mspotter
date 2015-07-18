<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class Select2Type extends AbstractType
{
    private $twig;
    private $dispatcher;

    public function __construct(\Twig_Environment $twig, $dispatcher){
        $this->twig = $twig;
        $this->dispatcher = $dispatcher;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array()
        ));
    }

    public function getName()
    {
        return 'select2';
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $javascriptContent = $this->twig->render(
            'AppBundle:Form:select2.html.twig',
            array('choices'=>$this->choicesToArray($options['choices']))
        );

        $this->dispatcher->addListener('kernel.response', function($event) use ($javascriptContent) {

            $response = $event->getResponse();
            $content = $response->getContent();
            // finding position of </body> tag to add content before the end of the tag
            $pos = strripos($content, '</body>');
            $content = substr($content, 0, $pos).$javascriptContent.substr($content, $pos);

            $response->setContent($content);
            $event->setResponse($response);
        });

    }

    private function choicesToArray($choices)
    {
        $choicesArray = array();
        foreach($choices as $choice){
            $choiceArray = $this->createChoiceArray($choice);
            if(count($choice->getChildren())){
                $choiceArray['children']=array();
                foreach($choice->getChildren() as $child){
                    $choiceArray['children'][] = $this->createChoiceArray($child);
                }
            }
            $choicesArray[]= $choiceArray;
        }
        return $choicesArray;
    }

    private function createChoiceArray($choice)
    {
        $choiceArray = array(
            'id' => $choice->getId(),
            'text' => $choice->getName(),
        );
        return $choiceArray;
    }
}