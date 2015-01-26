<?php

namespace Setting\Bundle\ToolBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * SyndicateModule
 * @UniqueEntity(fields="moduleClass",message="This data is already in use.")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\ToolBundle\Entity\SyndicateModuleRepository")
 */
class SyndicateModule
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
     * @ORM\Column(name="name", type="string", length=255)
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
     * @ORM\Column(name="menu", type="string", length=255 , nullable = true)
     */
    private $menu;


    /**
     * @var string
     *
     * @ORM\Column(name="menuSlug", type="string", length=255 , nullable = true)
     */
    private $menuSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text" , nullable = true)
     */
    private $description;


    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\Syndicate", inversedBy="syndicateModules")
     * @ORM\OrderBy({"name" = "ASC"})
     **/

    private $syndicates;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\SiteSetting", mappedBy="syndicateModules")
     **/

    private $siteSettings;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\HomePage", mappedBy="syndicateModules")
     * @ORM\OrderBy({"name" = "ASC"})
     **/

    private $homePages;


    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\Menu", mappedBy="syndicateModule")
     **/

    protected  $nav;



    public function _constructor()
    {

        $this->syndicates = new ArrayCollection();

        if(! $this ->getId()){
            $this->setStatus(true);
        }

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
     * @return SyndicateModule
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
     * Set status
     *
     * @param boolean $status
     * @return SyndicateModule
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
     * @param mixed $syndicates
     */
    public function setSyndicates($syndicates)
    {
        $this->syndicates = $syndicates;
    }

    /**
     * @return mixed
     */
    public function getSyndicates()
    {
        return $this->syndicates;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getModuleClass()
    {
        return $this->moduleClass;
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
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param string $menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return string
     */
    public function getMenuSlug()
    {
        return $this->menuSlug;
    }

    /**
     * @param string $menuSlug
     */
    public function setMenuSlug($menuSlug)
    {
        $this->menuSlug = $menuSlug;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getSiteSettings()
    {
        return $this->siteSettings;
    }

    /**
     * @return mixed
     */
    public function getHomePages()
    {
        return $this->homePages;
    }


}
