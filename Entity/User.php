<?php

namespace Coregen\AdminBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="security_user")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="log")
     */
    protected $logs;


    public function __construct()
    {
        parent::__construct();
        $this->logs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Pre persist hook
     *
     * @ORM\PrePersist
     *
     * @return void
     */
    public function prePersist()
    {
        if (!$this->getId()) {
            $this->createdAt = new \DateTime(date('Y-m-d H:m:s'));
        }
        $this->updatedAt = new \DateTime(date('Y-m-d H:m:s'));
    }

    /**
     * Pre update hook
     *
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime(date('Y-m-d H:m:s'));
    }

    /**
     * Get expiresAt
     *
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentialsExpireAt
     *
     * @return DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
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
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Add logs
     *
     * @param Coregen\AdminBundle\Entity\Log $logs
     */
    public function addLog(\Coregen\AdminBundle\Entity\Log $logs)
    {
        $this->logs[] = $logs;
    }

    /**
     * Get logs
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getLogs()
    {
        return $this->logs;
    }

}