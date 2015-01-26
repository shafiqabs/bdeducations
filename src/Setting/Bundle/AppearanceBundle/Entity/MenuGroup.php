<?php

namespace Setting\Bundle\AppearanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuGroup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\AppearanceBundle\Entity\MenuGroupRepository")
 */
class MenuGroup
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
     * @var array
     *
     * @ORM\Column(name="groupType", type="array", nullable=true)
     */
    private $groupType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Setting\Bundle\AppearanceBundle\Entity\MenuGrouping", mappedBy="menuGroup")
     */
    protected $menuGrouping;




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
     * @return MenuGroup
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
     * @return MenuGroup
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
     * @return string
     */
    public function getGroupType()
    {
        return $this->groupType;
    }

    /**
     * @param string $groupType
     */
    public function setGroupType($groupType)
    {
        $this->groupType = $groupType;
    }
}
