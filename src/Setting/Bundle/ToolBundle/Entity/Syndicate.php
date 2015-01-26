<?php

namespace Setting\Bundle\ToolBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Syndicate
 * @ORM\Entity
 * @UniqueEntity(fields="name",message="This data is already in use.")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\ToolBundle\Entity\SyndicateRepository")
 */
class Syndicate
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
     * @ORM\ManyToOne(targetEntity="Syndicate", inversedBy="children", cascade={"detach","merge"})
     * @ORM\JoinColumn(name="parent", referencedColumnName="id", onDelete="SET NULL" , nullable = true)
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Syndicate" , mappedBy="parent")
     * @ORM\OrderBy({"name" = "ASC"})
     **/
    private $children;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique = true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="entityName", type="string", length=255)
     */
    private $entityName;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="uniqueCode", type="string", length=255)
     */
    private $uniqueCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isParent", type="boolean")
     */
    private $isParent;


    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\GlobalOption", mappedBy="syndicate")
     */
    protected $globalOption;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\MobileTheme", mappedBy="syndicates")
     */
    protected $mobileThemes;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\WebTheme", mappedBy="syndicates")
     */
    protected $webThemes;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\SyndicateModule", mappedBy="syndicates")
     */
    protected $syndicateModules;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\SiteSetting", mappedBy="syndicates")
     */
    protected $siteSettings;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\HomePage", mappedBy="syndicates")
     */
    protected $homePages;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\Menu", mappedBy="syndicate")
     */
    protected $nav;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\SyndicateContent", mappedBy="syndicate")
     */
    protected $syndicateContent;


    public function __construct() {

        if(!$this->getId()){

            $this->setStatus(true);

            $passcode =substr(str_shuffle(str_repeat('0123456789',5)),0,4);
            $t = microtime(true);
            $micro = ($passcode + floor($t));
            $this->uniqueCode = $micro;
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
     * @return Syndicate
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
     * Set slug
     *
     * @param string $slug
     * @return Syndicate
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set uniqueCode
     *
     * @param string $uniqueCode
     * @return Syndicate
     */
    public function setUniqueCode($uniqueCode)
    {
        $this->uniqueCode = $uniqueCode;

        return $this;
    }

    /**
     * Get uniqueCode
     *
     * @return string 
     */
    public function getUniqueCode()
    {
        return $this->uniqueCode;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Syndicate
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
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param boolean $isParent
     */
    public function setIsParent($isParent)
    {
        $this->isParent = $isParent;
    }

    /**
     * @return boolean
     */
    public function getIsParent()
    {
        return $this->isParent;
    }


    /**
     * @param mixed $menus
     */
    public function setMenus($menus)
    {
        $this->menus = $menus;
    }

    /**
     * @return mixed
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * @param mixed $globalOption
     */
    public function setGlobalOption($globalOption)
    {
        $this->globalOption = $globalOption;
    }

    /**
     * @return mixed
     */
    public function getGlobalOption()
    {
        return $this->globalOption;
    }


    /**
     * @param mixed $syndicateModules
     */
    public function setSyndicateModules($syndicateModules)
    {
        $this->syndicateModules = $syndicateModules;
    }

    /**
     * @return mixed
     */
    public function getSyndicateModules()
    {
        return $this->syndicateModules;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
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

    /**
     * @return mixed
     */
    public function getMobileThemes()
    {
        return $this->mobileThemes;
    }

    /**
     * @return mixed
     */
    public function getWebThemes()
    {
        return $this->webThemes;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return mixed
     */
    public function getSyndicateContent()
    {
        return $this->syndicateContent;
    }

}
