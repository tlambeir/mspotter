<?php
// src/AppBundle/Entity/Ad.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AdRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="mspotter_ads")
 */
class Ad
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $genres;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $influences;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $website;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $facebook;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $twitter;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $soundCloud;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\NotBlank()
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank()
     */
    protected $country;


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="ads")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Ad
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ad
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Ad
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Ad
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Ad
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set soundCloud
     *
     * @param string $soundCloud
     * @return Ad
     */
    public function setSoundCloud($soundCloud)
    {
        $this->soundCloud = $soundCloud;

        return $this;
    }

    /**
     * Get soundCloud
     *
     * @return string 
     */
    public function getSoundCloud()
    {
        return $this->soundCloud;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Ad
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Ad
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Ad
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Ad
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set genres
     *
     * @param string $genres
     * @return Ad
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Get genres
     *
     * @return string 
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set influences
     *
     * @param string $influences
     * @return Ad
     */
    public function setInfluences($influences)
    {
        $this->influences = $influences;

        return $this;
    }

    /**
     * Get influences
     *
     * @return string 
     */
    public function getInfluences()
    {
        return $this->influences;
    }
}
