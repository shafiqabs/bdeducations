<?php

namespace Core\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="fos_user")
 * @UniqueEntity(fields="email",message="User name already existing,Please try again.")
 * @UniqueEntity(fields="username",message="Email address already existing,Please try again.")
 * @ORM\Entity(repositoryClass="Core\UserBundle\Entity\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string",  length=200 )
	 */
	 protected $name;


	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $avatar;

	/**
	 * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
	 * @ORM\JoinTable(name="user_user_group",
	 *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
	 * )
	 */
	protected $groups;


    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Page", mappedBy="user" )
     */
    protected $pages;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Branch", mappedBy="user" )
     */
    protected $branches;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\News", mappedBy="user")
     */
    protected $news;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Admission", mappedBy="user")
     */
    protected $admissions;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Event", mappedBy="user")
     */
    protected $events;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Blog", mappedBy="user")
     */
    protected $blogs;

    /**
     * @ORM\OneToOne(targetEntity="Setting\Bundle\ContentBundle\Entity\Blackout", mappedBy="user")
     */
    protected $blackout;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Testimonial", mappedBy="user")
     */
    protected $testimonials;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\NoticeBoard", mappedBy="user")
     */
    protected $noticeboards;


     /**
      * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\Menu", mappedBy="user")
      * @ORM\OrderBy({"menu" = "ASC"})
      */
      protected $menus;

    /**
     * @ORM\OneToOne(targetEntity="Syndicate\Bundle\ComponentBundle\Entity\Education", mappedBy="user")
     */
    protected $education;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\MediaBundle\Entity\PhotoGallery", mappedBy="user")
     */
    protected $photoGalleries;

    /**
     * @ORM\OneToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\SiteSetting", mappedBy="user")
     **/

    private $siteSetting;
    /**
     * @ORM\OneToOne(targetEntity="Setting\Bundle\ContentBundle\Entity\HomePage", mappedBy="user")
     **/

    private $homePage;

    /**
     * @ORM\OneToOne(targetEntity="Setting\Bundle\ContentBundle\Entity\ContactPage", mappedBy="user")
     **/

    private $contactPage;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\SyndicateContent", mappedBy="user")
     */
    protected $syndicateContents;



    /**
	 * @var boolean
	 *
	 * @ORM\Column(name="notification", type="boolean")
	 */
	protected $notification = false;


    /**
     * @ORM\OneToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\GlobalOption", mappedBy="user" , cascade={"persist"} )
     */
    protected $globalOption;

    /**
	 * @ORM\OneToOne(targetEntity="Profile", mappedBy="user", cascade={"persist"})
	 *
	 */
	protected $profile;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\MenuGrouping", mappedBy="user")
     */
    protected $menuGrouping;



    protected $role;

    public function __construct()
    {
        parent::__construct();

        $this->instititePages = new ArrayCollection();
        $this->menuGrouping = new ArrayCollection();
        $this->photoGalleries = new ArrayCollection();
        $this->pages = new ArrayCollection();
        $this->menus = new ArrayCollection();
        $this->moduleSetups = new ArrayCollection();
        $this->news = new ArrayCollection();
    }

    public function toArray($collection)
    {
        $this->setRoles($collection->toArray());
    }

    public function setRole($role)
    {
        $this->setRoles(array($role));

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        $role = $this->getRoles();

        return $role[0];
    }

    public function isGranted($role)
    {
        return in_array($role, $this->getRoles());
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }


	/**
	 * @param mixed $profile
	 */
	public function setProfile($profile)
	{
		$profile->setUser($this);
		$this->profile = $profile;
	}

	/**
	 * @return mixed
	 */
	public function getProfile()
	{
		return $this->profile;
	}

	/**
	 * get avatar image file name
	 *
	 * @return string
	 */
	public function getAvatar()
	{
		return $this->avatar;
	}

	/**
	 * set avatar image file name
	 */
	public function setAvatar($avatar)
	{
		$this->avatar = $avatar;
	}

	public function isSuperAdmin()
	{
		$groups = $this->getGroups();
		foreach ($groups as $group) {
			if ($group->hasRole('ROLE_SUPER_ADMIN')) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @return boolean
	 */
	public function getNotification()
	{
		return $this->notification;
	}

	/**
	 * @param boolean $notification
	 *
	 * @return $this
	 */
	public function setNotification($notification)
	{
		$this->notification = $notification;
		return $this;
	}


    /**
     * @param mixed $education
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param mixed $photoGalleries
     */
    public function setPhotoGalleries($photoGalleries)
    {
        $this->photoGalleries = $photoGalleries;
    }

    /**
     * @return mixed
     */
    public function getPhotoGalleries()
    {
        return $this->photoGalleries;
    }

    /**
     * @param mixed $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
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
     * @param mixed $siteSetting
     */
    public function setSiteSetting($siteSetting)
    {
        $siteSetting->setUser($this);
        $this->siteSetting = $siteSetting;
    }

    /**
     * @return mixed
     */
    public function getSiteSetting()
    {
        return $this->siteSetting;
    }

    /**
     * @return mixed
     */
    public function getBlackout()
    {
        return $this->blackout;
    }

    /**
     * @param mixed $blackout
     */
    public function setBlackout($blackout)
    {
        $this->blackout = $blackout;
    }

    /**
     * @return mixed
     */
    public function getMenuGrouping()
    {
        return $this->menuGrouping;
    }

    /**
     * @param mixed $menuGrouping
     */
    public function setMenuGrouping($menuGrouping)
    {
        $this->menuGrouping = $menuGrouping;
    }

    /**
     * @return mixed
     */
    public function getGlobalOption()
    {
        return $this->globalOption;
    }

    /**
     * @param mixed $globalOption
     */
    public function setGlobalOption($globalOption)
    {
        $globalOption->setUser($this);
        $this->globalOption = $globalOption;
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getHomePage()
    {
        return $this->homePage;
    }

    /**
     * @param mixed $homePage
     */
    public function setHomePage($homePage)
    {
        $this->homePage = $homePage;
    }

    /**
     * @return mixed
     */
    public function getContactPage()
    {
        return $this->contactPage;
    }

    /**
     * @param mixed $contactPage
     */
    public function setContactPage($contactPage)
    {
        $this->contactPage = $contactPage;
    }

    /**
     * @return mixed
     */
    public function getBranches()
    {
        return $this->branches;
    }

    /**
     * @return mixed
     */
    public function getSyndicateContents()
    {
        return $this->syndicateContents;
    }

    /**
     * @return mixed
     */
    public function getAdmissions()
    {
        return $this->admissions;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return mixed
     */
    public function getBlogs()
    {
        return $this->blogs;
    }

    /**
     * @param mixed $blogs
     */
    public function setBlogs($blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @return mixed
     */
    public function getTestimonials()
    {
        return $this->testimonials;
    }

    /**
     * @return mixed
     */
    public function getNoticeboards()
    {
        return $this->noticeboards;
    }


}