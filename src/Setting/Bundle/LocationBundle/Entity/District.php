<?php

namespace Setting\Bundle\LocationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * District
 *
 * @ORM\Table(name="district")
 * @ORM\Entity(repositoryClass="Setting\Bundle\LocationBundle\Entity\DistrictRepository")
 */
class District
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
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\LocationBundle\Entity\Division", inversedBy="districts")
     **/

    protected $division;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\LocationBundle\Entity\Thana", mappedBy="district")
     * @ORM\OrderBy({"name"="asc"})
     **/

    private $thanas;

    /**
     * @ORM\OneToMany(targetEntity="Syndicate\Bundle\ComponentBundle\Entity\Education", mappedBy="district")
     * @ORM\OrderBy({"name"="asc"})
     **/

    private $educations;


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

    public function __construct() {


        $this->thanas = new ArrayCollection();
        $this->institutes = new ArrayCollection();

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
     * @return District
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
     * @return District
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

    public function  setDivision($division)
    {

        $this->division = $division;
    }

    public function getDivision()
    {

        return $this->division;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getThanas()
    {
        return $this->thanas;
    }


    /**
     * @param mixed $educations
     */
    public function setEducations($educations)
    {
        $this->educations = $educations;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEducations()
    {
        return $this->educations;
    }




}
