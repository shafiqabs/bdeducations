<?php

namespace Syndicate\Bundle\ComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Education
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Syndicate\Bundle\ComponentBundle\Entity\EducationRepository")
 */
class Education
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
     * @var \DateTime
     *
     * @ORM\Column(name="establishment", type="date")
     */
    private $establishment;

    /**
     * @ORM\OneToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="education")
     **/

    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\LocationBundle\Entity\Thana", inversedBy="educations")
     **/

    protected $thana;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\LocationBundle\Entity\District", inversedBy="educations")
     **/

    protected $district;


    /**
     * @var string
     *
     * @ORM\Column(name="instituteCheif", type="string", length=255 , nullable = true)
     */
    private $instituteCheif;

    /**
     * @var string
     *
     * @ORM\Column(name="instituteCheifDesignation", type="string", length=255 , nullable = true)
     */
    private $instituteCheifDesignation;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text" , nullable = true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="hotline", type="string", length=255 , nullable = true)
     */
    private $hotline;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255 , nullable = true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255 , nullable = true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255 , nullable = true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="officeHour", type="string", length=255 , nullable = true)
     */
    private $officeHour;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255 , nullable = true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contactPerson", type="string", length=255 , nullable = true)
     */
    private $contactPerson;

    /**
     * @var text
     *
     * @ORM\Column(name="overview", type="text" , nullable = true)
     */
    private $overview;


    /**
     * @var string

     * @ORM\Column(name="contactPersonDesignation", type="string", length=255 , nullable = true)
     */
    private $contactPersonDesignation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

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
     * @return Education
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
     * Set establishment
     *
     * @param \DateTime $establishment
     * @return Education
     */
    public function setEstablishment($establishment)
    {
        $this->establishment = $establishment;

        return $this;
    }

    /**
     * Get establishment
     *
     * @return \DateTime
     */
    public function getEstablishment()
    {
        return $this->establishment;
    }


    /**
     * Set instituteCheif
     *
     * @param string $instituteCheif
     * @return Education
     */
    public function setInstituteCheif($instituteCheif)
    {
        $this->instituteCheif = $instituteCheif;

        return $this;
    }

    /**
     * Get instituteCheif
     *
     * @return string
     */
    public function getInstituteCheif()
    {
        return $this->instituteCheif;
    }

    /**
     * Set instituteCheifDesignation
     *
     * @param string $instituteCheifDesignation
     * @return Education
     */
    public function setInstituteCheifDesignation($instituteCheifDesignation)
    {
        $this->instituteCheifDesignation = $instituteCheifDesignation;

        return $this;
    }

    /**
     * Get instituteCheifDesignation
     *
     * @return string
     */
    public function getInstituteCheifDesignation()
    {
        return $this->instituteCheifDesignation;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Education
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set hotline
     *
     * @param string $hotline
     * @return Education
     */
    public function setHotline($hotline)
    {
        $this->hotline = $hotline;

        return $this;
    }

    /**
     * Get hotline
     *
     * @return string
     */
    public function getHotline()
    {
        return $this->hotline;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Education
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Education
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Education
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
     * Set email
     *
     * @param string $email
     * @return Education
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contactPerson
     *
     * @param string $contactPerson
     * @return Education
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set contactPersonDesignation
     *
     * @param string $contactPersonDesignation
     * @return Education
     */
    public function setContactPersonDesignation($contactPersonDesignation)
    {
        $this->contactPersonDesignation = $contactPersonDesignation;

        return $this;
    }

    /**
     * Get contactPersonDesignation
     *
     * @return string
     */
    public function getContactPersonDesignation()
    {
        return $this->contactPersonDesignation;
    }

    /**
     * @param text $overview
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
    }

    /**
     * @return text
     */
    public function getOverview()
    {
        return $this->overview;
    }


    /**
     * Set status
     *
     * @param boolean $status
     * @return Education
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

    public function  setThana($thana)
    {

        $this->thana = $thana;
    }

    public function getThana()
    {

        return $this->thana;
    }


    public function  setDistrict($district)
    {

        $this->district = $district;
    }

    public function getDistrict()
    {

        return $this->district;
    }

    /**
     * Sets file.
     *
     * @param CitizenRequest $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return CitizenRequest
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
     * @return string
     */
    public function getOfficeHour()
    {
        return $this->officeHour;
    }

    /**
     * @param string $officeHour
     */
    public function setOfficeHour($officeHour)
    {
        $this->officeHour = $officeHour;
    }


}
