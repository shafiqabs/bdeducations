<?php

namespace Setting\Bundle\LocationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Thana
 *
 * @ORM\Table(name="thana")
 * @ORM\Entity
 */
class Thana
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
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\LocationBundle\Entity\Division", inversedBy="thanas")
     **/

    protected $division;

    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\LocationBundle\Entity\District", inversedBy="thanas")
     **/

    protected $district;

    /**
     * @ORM\OneToMany(targetEntity="Syndicate\Bundle\ComponentBundle\Entity\Education", mappedBy="thana")
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
     * @return Thana
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
     * @return Thana
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

    public function  setDistrict($district)
    {

        $this->district = $district;
    }

    public function getDistrict()
    {

        return $this->district;
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
