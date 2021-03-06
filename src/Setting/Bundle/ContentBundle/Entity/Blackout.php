<?php

namespace Setting\Bundle\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blackout
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\ContentBundle\Entity\BlackoutRepository")
 */
class Blackout
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
     * @ORM\OneToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="blackout")
     **/

    protected $user;


    /**
     * @var string
     *
     * @ORM\Column(name="blackoutDate", type="text")
     */
    private $blackoutDate;

    /**
     * @var text
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status = true;


    public function __construct() {

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
     * Set blackoutDate
     *
     * @param string $blackoutDate
     * @return Blackout
     */
    public function setBlackoutDate($blackoutDate)
    {
        $this->blackoutDate = $blackoutDate;

        return $this;
    }

    /**
     * Get blackoutDate
     *
     * @return string 
     */
    public function getBlackoutDate()
    {
        return $this->blackoutDate;
    }

    /**
     * Get blackoutDate
     *
     * @return string
     */
    public function getOffBlackoutDate()
    {
        return explode(',' , $this->blackoutDate);
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \Setting\Bundle\ContentBundle\Entity\text
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param \Setting\Bundle\ContentBundle\Entity\text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
