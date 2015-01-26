<?php

namespace Setting\Bundle\AppearanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\AppearanceBundle\Entity\MenuRepository")
 */
class Menu
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
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="menus")
     **/

    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="uniqueCode", type="string", length=255 , nullable = true)
     */
    private $uniqueCode;


    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\MenuGrouping", mappedBy="menu" , cascade={"persist", "remove"})
     */
    protected $menuGrouping;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\Module", inversedBy="nav")
     */
    protected $module;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\SyndicateModule", inversedBy="nav")
     */
    protected $syndicateModule;

    /**
     * @ORM\OneToOne(targetEntity="Setting\Bundle\ContentBundle\Entity\Page", inversedBy="nav")
     */
    protected $page;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\Syndicate", inversedBy="nav")
     */
    protected $syndicate;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\SiteSetting", inversedBy="nav")
     */
    protected $siteSetting;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\HomeBlock", mappedBy="menu" , cascade={"persist", "remove"})
     **/

    protected $homeBlock;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultMenu", type="boolean")
     */

    private $defaultMenu = false ;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */

    private $status;

    public function __construct()
    {
        if(!$this->getId()){
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
     * Set menu
     *
     * @param string $menu
     * @return Menu
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
     * @return Menu
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
     * @return Menu
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
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $uniqueCode
     */
    public function setUniqueCode($uniqueCode)
    {
        $this->uniqueCode = $uniqueCode;
    }

    /**
     * @return string
     */
    public function getUniqueCode()
    {
        return $this->uniqueCode;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }


    /**
     * @return mixed
     */
    public function getSyndicateModule()
    {
        return $this->syndicateModule;
    }

    /**
     * @param mixed $syndicateModule
     */
    public function setSyndicateModule($syndicateModule)
    {
        $this->syndicateModule = $syndicateModule;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getSyndicate()
    {
        return $this->syndicate;
    }

    /**
     * @param mixed $syndicate
     */
    public function setSyndicate($syndicate)
    {
        $this->syndicate = $syndicate;
    }

    /**
     * @return mixed
     */
    public function getSiteSetting()
    {
        return $this->siteSetting;
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
    public function getHomeBlocks()
    {
        return $this->homeBlocks;
    }

    /**
     * @return mixed
     */
    public function getHomeBlock()
    {
        return $this->homeBlock;
    }

    /**
     * @return boolean
     */
    public function getDefaultMenu()
    {
        return $this->defaultMenu;
    }

    /**
     * @param boolean $defaultMenu
     */
    public function setDefaultMenu($defaultMenu)
    {
        $this->defaultMenu = $defaultMenu;
    }


}
