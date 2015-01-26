<?php

namespace Setting\Bundle\ToolBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GlobalOption
 * @ORM\Entity
 * @UniqueEntity(fields="domain",message="This data is already in use.")
 * @UniqueEntity(fields="subDomain",message="This data is already in use.")
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Setting\Bundle\ToolBundle\Entity\GlobalOptionRepository")
 */
class GlobalOption
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
     * @ORM\OneToOne(targetEntity="Core\UserBundle\Entity\User", inversedBy="globalOption")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=true, onDelete="CASCADE")
     * })
     **/

    protected $user;


    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255 , unique=true , nullable=true)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="subDomain", type="string", length=255 , unique=true, nullable=true)
     */
    private $subDomain;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isMobile", type="boolean" , nullable=true)
     */
    private $isMobile;


    /**
     * @ORM\ManyToOne(targetEntity="Setting\Bundle\ToolBundle\Entity\Syndicate", inversedBy="globalOption")
     **/

    private $syndicate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="customizeDesign", type="boolean" , nullable=true)
     */
    private $customizeDesign;

    /**
     * @var boolean
     *
     * @ORM\Column(name="facebookAds", type="boolean" , nullable=true)
     */
    private $facebookAds;

    /**
     * @var boolean
     *
     * @ORM\Column(name="facebookApps", type="boolean" , nullable=true)
     */
    private $facebookApps;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookPageUrl", type="string", length=255 , nullable=true)
     */
    private $facebookPageUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="promotion", type="boolean" , nullable=true)
     */
    private $promotion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cart", type="boolean" , nullable=true)
     */
    private $cart;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isIntro", type="boolean" , nullable=true)
     */
    private $isIntro;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;


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
     * @param mixed $syndicate
     */
    public function setSyndicate($syndicate)
    {
        $this->syndicate = $syndicate;
    }

    /**
     * @return mixed
     */
    public function getSyndicate()
    {
        return $this->syndicate;
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
     * Set domain
     *
     * @param string $domain
     * @return GlobalOption
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string 
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set subDomain
     *
     * @param string $subDomain
     * @return GlobalOption
     */
    public function setSubDomain($subDomain)
    {
        $this->subDomain = $subDomain;

        return $this;
    }

    /**
     * Get subDomain
     *
     * @return string 
     */
    public function getSubDomain()
    {
        return $this->subDomain;
    }

    /**
     * Set isMobile
     *
     * @param boolean $isMobile
     * @return GlobalOption
     */
    public function setIsMobile($isMobile)
    {
        $this->isMobile = $isMobile;

        return $this;
    }

    /**
     * Get isMobile
     *
     * @return boolean 
     */
    public function getIsMobile()
    {
        return $this->isMobile;
    }

    /**
     * @param mixed $mobileTheme
     */
    public function setMobileTheme($mobileTheme)
    {
        $this->mobileTheme = $mobileTheme;

        return $this;
    }

    /**
     * @param mixed $mobileTheme
     */
    public function getMobileTheme()
    {
        return $this->mobileTheme;
    }


    /**
     * @param mixed $webTheme
     */
    public function setWebTheme($webTheme)
    {
        $this->webTheme = $webTheme;
    }

    /**
     * @return mixed
     */
    public function getWebTheme()
    {
        return $this->webTheme;
    }



    /**
     * Set customizeDesign
     *
     * @param boolean $customizeDesign
     * @return GlobalOption
     */
    public function setCustomizeDesign($customizeDesign)
    {
        $this->customizeDesign = $customizeDesign;

        return $this;
    }

    /**
     * Get customizeDesign
     *
     * @return boolean 
     */
    public function getCustomizeDesign()
    {
        return $this->customizeDesign;
    }

    /**
     * Set facebookAds
     *
     * @param boolean $facebookAds
     * @return GlobalOption
     */
    public function setFacebookAds($facebookAds)
    {
        $this->facebookAds = $facebookAds;

        return $this;
    }

    /**
     * Get facebookAds
     *
     * @return boolean 
     */
    public function getFacebookAds()
    {
        return $this->facebookAds;
    }

    /**
     * Set facebookApps
     *
     * @param boolean $facebookApps
     * @return GlobalOption
     */
    public function setFacebookApps($facebookApps)
    {
        $this->facebookApps = $facebookApps;

        return $this;
    }

    /**
     * Get facebookApps
     *
     * @return boolean 
     */
    public function getFacebookApps()
    {
        return $this->facebookApps;
    }

    /**
     * Set facebookPageUrl
     *
     * @param string $facebookPageUrl
     * @return GlobalOption
     */
    public function setFacebookPageUrl($facebookPageUrl)
    {
        $this->facebookPageUrl = $facebookPageUrl;

        return $this;
    }

    /**
     * Get facebookPageUrl
     *
     * @return string 
     */
    public function getFacebookPageUrl()
    {
        return $this->facebookPageUrl;
    }

    /**
     * Set promotion
     *
     * @param boolean $promotion
     * @return GlobalOption
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return boolean 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set cart
     *
     * @param boolean $cart
     * @return GlobalOption
     */
    public function setCart($cart)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return boolean 
     */
    public function getCart()
    {
        return $this->cart;
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

    /**
     * @return boolean
     */
    public function getIsIntro()
    {
        return $this->isIntro;
    }

    /**
     * @param boolean $isIntro
     */
    public function setIsIntro($isIntro)
    {
        $this->isIntro = $isIntro;
    }
}
