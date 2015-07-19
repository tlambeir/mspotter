<?php
// src/AppBundle/Form/Type/TaskType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\DataTransformer\CategoryTransformer;

class AdType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $repository = $this->em->getRepository('AppBundle:Category');
        //$categories = $repository->findRootCategories();
        $categories = $repository->findAll();

        $builder
            ->add('name', 'text')
            ->add('category', 'select2', array(
                'data_class' => 'AppBundle\Entity\Category',
                'choices' => $categories,
            ))
            /*
            ->add('category', 'entity', array(
                'class' => 'AppBundle:Category',
                'property' => 'name',
                'choices' => $repository->findAll()
            ))*/
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

        $builder->get('category')
            ->addModelTransformer(new CategoryTransformer($this->em));
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