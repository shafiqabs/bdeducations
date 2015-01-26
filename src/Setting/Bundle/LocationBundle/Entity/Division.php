<?php

namespace Setting\Bundle\LocationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="division")
 * @ORM\Entity(repositoryClass="Setting\Bundle\LocationBundle\Entity\DivisionRepository")
 */
class Division
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
     * @ORM\OneToMany(targetEntity="Setting\Bundle\LocationBundle\Entity\District", mappedBy="division")
     * @ORM\OrderBy({"name"="asc"})
     **/

    private $districts;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\LocationBundle\Entity\Thana", mappedBy="division")
     * @ORM\OrderBy({"name"="asc"})
     **/

    private $thanas;




    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;


    public function __construct() {

        $this->districts = new ArrayCollection();
        $this->thanas = new ArrayCollection();

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
     * @return Division
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
     * @return Division
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
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getDistricts()
    {
        return $this->districts;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getThanas()
    {
        return $this->thanas;
    }

}
