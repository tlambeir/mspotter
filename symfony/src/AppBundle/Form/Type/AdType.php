<?php
// src/AppBundle/Form/Type/TaskType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;

class AdType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $repository = $this->em->getRepository('AppBundle:Category');
        $categories = $repository->findRootCategories();

        $builder
            ->add('name', 'text')
            ->add('category', 'text')
            ->add('category', 'select2', array(
                'choices' => $categories,
            ))
            ->add('description', 'textarea')
            ->add('genres', 'text')
            ->add('influences', 'text')
            ->add('website', 'url')
            ->add('facebook', 'url')
            ->add('twitter', 'url')
            ->add('soundCloud', 'url')
            ->add('city', 'text')
            ->add('country', 'text')
            ->add('save', 'submit', array('label' => 'Plaats advertentie'))
        ;
    }

    public function getName()
    {
        return 'ad';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ad',
        ));
    }
}