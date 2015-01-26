<?php

namespace Setting\Bundle\MediaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * PhotoGallery
 *
 * @ORM\Table(name="photo_gallery")
 * @ORM\Entity(repositoryClass="Setting\Bundle\MediaBundle\Entity\PhotoGalleryRepository")
 */
class PhotoGallery
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
     * @ORM\ManyToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="photoGalleries")
     **/

    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\MediaBundle\Entity\GalleryImage", mappedBy="photoGallery")
     */
    protected $galleryImages;


    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Page", mappedBy="photoGallery")
     */

    protected $pageGalleries;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\Event", mappedBy="photoGallery")
     */

    protected $eventGalleries;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\HomePage", mappedBy="photoGallery")
     */

    protected $homePage;

    /**
     * @ORM\OneToOne(targetEntity="Syndicate\Bundle\ComponentBundle\Entity\Education", mappedBy="gallery")
     */

    protected $education;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\ContentBundle\Entity\SyndicateContent", mappedBy="photoGallery")
     */

    protected $syndicateContent;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text" , nullable=true)
     */

    private $description;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created", type="datetime" , nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @Assert\File(maxSize="")
     */
    protected $file;



    public function __construct()
    {
        $this->galleryImages = new ArrayCollection();
        $this->pageGalleries = new ArrayCollection();

        if(!$this->getId()){
            $this->setCreated(new \DateTime());
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
     * @return PhotoGallery
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
     * @return PhotoGallery
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
     * @return PhotoGallery
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
     * @param mixed $galleryImages
     */
    public function setGalleryImages($galleryImages)
    {
        $this->galleryImages = $galleryImages;
    }

    /**
     * @return mixed
     */
    public function getGalleryImages()
    {
        return $this->galleryImages;
    }

    /**
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getPageGalleries()
    {
        return $this->pageGalleries;
    }

    /**
     * @param mixed $pageGalleries
     */
    public function setPageGalleries($pageGalleries)
    {
        $this->pageGalleries = $pageGalleries;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
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
    public function getSyndicateContent()
    {
        return $this->syndicateContent;
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
    public function getEventGalleries()
    {
        return $this->eventGalleries;
    }


}
