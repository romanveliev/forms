<?php

namespace Form\RegistrationBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Roles
 */
class Roles
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     *
     * @return Roles
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
     * Add user
     *
     * @param \Form\RegistrationBundle\Entity\Users $user
     *
     * @return Roles
     */
    public function addUser(\Form\RegistrationBundle\Entity\Users $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Form\RegistrationBundle\Entity\Users $user
     */
    public function removeUser(\Form\RegistrationBundle\Entity\Users $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
