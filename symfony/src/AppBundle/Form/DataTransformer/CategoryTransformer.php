<?php
// src/AppBundle/Form/DataTransformer/CategoryToNumberTransformer.php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CategoryTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (category) to a string (number).
     *
     * @param  Category|null $category
     * @return string
     */
    public function transform($category)
    {
        if (null === $category) {
            return '';
        }

        return $category->getId();
    }

    /**
     * Transforms a string (number) to an object (category).
     *
     * @param  string $categoryNumber
     * @return Category|null
     * @throws TransformationFailedException if object (category) is not found.
     */
    public function reverseTransform($categoryNumber)
    {
        // no category number? It's optional, so that's ok
        if (!$categoryNumber) {
            return;
        }

        $category = $this->entityManager
            ->getRepository('AppBundle:Category')
            // query for the category with this id
            ->find($categoryNumber)
        ;

        if (null === $category) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An category with number "%s" does not exist!',
                $categoryNumber
            ));
        }

        return $category;
    }
}