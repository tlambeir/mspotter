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
            ->add('name', 'text',array('label' => 'Onderwerp'))
            ->add('category', 'select2', array(
                'data_class' => 'AppBundle\Entity\Category',
                'choices' => $categories,
            ))
            ->add('description', 'textarea',array('label' => 'Omschrijving'))
            ->add('genres', 'text',array('required' => false))
            ->add('influences', 'text',array('label' => 'Invloeden','required' => false))
            ->add('website', 'url',array('required' => false))
            ->add('facebook', 'url',array('required' => false))
            ->add('twitter', 'url',array('required' => false))
            ->add('soundCloud', 'url',array('required' => false))
            ->add('city', 'text',array('label' => 'Gemeente'))
            ->add('country', 'text',array('label' => 'Land'))
            ->add('image', 'vich_image', array(
                'label' => 'Afbeelding',
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
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