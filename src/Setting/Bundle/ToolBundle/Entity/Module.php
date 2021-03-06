<?php

namespace Setting\Bundle\ToolBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="moduleClass",message="This data is already in use.")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\ToolBundle\Entity\ModuleRepository")
 */
class Module
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255 , unique=true)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="moduleClass", type="string", length=255 , unique=true)
     */
    private $moduleClass;

    /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=255)
     */
    private $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="menuSlug", type="string", length=255)
     */
    private $menuSlug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text" , nullable = true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\SiteSetting", mappedBy="modules")
     **/

    private $siteSettings;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\HomePage", mappedBy="modules")
     * @ORM\OrderBy({"name" = "ASC"})
     **/

    private $homePages;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\Menu", mappedBy="module")
     **/

    protected  $nav;


    public function __construct() {

        if(!$this->getId()){

            $this->setStatus(true);
        }

        $this->setSiteSetting = new ArrayCollection();
        $this->nav = new ArrayCollection();


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
     * @return Module
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
     * Set menu
     *
     * @param string $menu
     * @return Module
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return string 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set menuSlug
     *
     * @param string $menuSlug
     * @return Module
     */
    public function setMenuSlug($menuSlug)
    {
        $this->menuSlug = $menuSlug;

        return $this;
    }

    /**
     * Get menuSlug
     *
     * @return string 
     */
    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Module
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Module
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
     * @param mixed $siteSetting
     */
    public function setSiteSetting($siteSetting)
    {
        $this->siteSetting = $siteSetting;
    }

    /**
     * @return mixed
     */
    public function getSiteSettings()
    {
        return $this->siteSettings;
    }

    /**
     * @param string $moduleClass
     */
    public function setModuleClass($moduleClass)
    {
        $this->moduleClass = $moduleClass;
    }

    /**
     * @return string
     */
    public function getModuleClass()
    {
        return $this->moduleClass;
    }

    /**
     * @return mixed
     */
    public function getNav()
    {
        return $this->nav;
    }

    /**
     * @param mixed $nav
     */
    public function setNav($nav)
    {
        $this->nav = $nav;
    }

    /**
     * @return mixed
     */
    public function getHomePages()
    {
        return $this->homePages;
    }





}
