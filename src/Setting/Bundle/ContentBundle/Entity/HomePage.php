<?php

namespace Setting\Bundle\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * HomePage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\ContentBundle\Entity\HomePageRepository")
 */
class HomePage
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
     * @ORM\OneToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="homePage")
     **/

    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\HomeBlock", mappedBy="homePage" )
     **/

    protected $homeBlocks;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="showingListing", type="integer", nullable=true)
     */
    private $showingListing;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\MediaBundle\Entity\PhotoGallery", inversedBy="homePage")
     */
    protected $photoGallery;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\Syndicate", inversedBy="homePages")
     * @ORM\JoinTable(name="homepage_syndicate",
     *      joinColumns={@ORM\JoinColumn(name="homePage_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="syndicate_id", referencedColumnName="id")}
     * )
     */

    private $syndicates;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\Module", inversedBy="homePages")
     * @ORM\JoinTable(name="homepage_module",
     *      joinColumns={@ORM\JoinColumn(name="homePage_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="module_id", referencedColumnName="id")}
     * )
     */

    private $modules;

    /**
     * @ORM\ManyToMany(targetEntity="Setting\Bundle\ToolBundle\Entity\SyndicateModule", inversedBy="homePages")
     * @ORM\JoinTable(name="homepage_syndicatemodule",
     *      joinColumns={@ORM\JoinColumn(name="homePage_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="syndicate_module_id", referencedColumnName="id")}
     * )
     */

    private $syndicateModules;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @Assert\File(maxSize="")
     */
    protected $file;


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
     * @return HomePage
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
     * Set content
     *
     * @param string $content
     * @return HomePage
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }


     /**
     * @return mixed
     */public function getUser()
    {
        return $this->user;
    }/**
     * @param mixed $user
     */public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPhotoGallery()
    {
        return $this->photoGallery;
    }

    /**
     * @param mixed $photoGallery
     */
    public function setPhotoGallery($photoGallery)
    {
        $this->photoGallery = $photoGallery;
    }


    /**
     * Sets file.
     *
     * @param Page $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return Page
     */
    public function getFile()
    {
        return $this->file;
    }



    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/files';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @return mixed
     */
    public function getHomeBlocks()
    {
        return $this->homeBlocks;
    }

    /**
     * @param mixed $homeBlocks
     */
    public function setHomeBlocks($homeBlocks)
    {
        $this->homeBlocks = $homeBlocks;
    }

    /**
     * @return mixed
     */
    public function getSyndicates()
    {
        return $this->syndicates;
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
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @param mixed $modules
     */
    public function setModules($modules)
    {
        $this->modules = $modules;
    }

    /**
     * @return mixed
     */
    public function getSyndicateModules()
    {
        return $this->syndicateModules;
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
    public function getHomeBlock()
    {
        return $this->homeBlock;
    }

    /**
     * @param mixed $homeBlock
     */
    public function setHomeBlock($homeBlock)
    {
        $this->homeBlock = $homeBlock;
    }

    /**
     * @return int
     */
    public function getShowingListing()
    {
        return $this->showingListing;
    }

    /**
     * @param int $showingListing
     */
    public function setShowingListing($showingListing)
    {
        $this->showingListing = $showingListing;
    }


}
