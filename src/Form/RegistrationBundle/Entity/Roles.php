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
    private $role;

    protected $users;

    public function __construct(){
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
     * Set role
     *
     * @param string $role
     *
     * @return Roles
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add user
     *
     * @param \Form\RegistrationBundle\Entity\User $user
     *
     * @return Roles
     */
    public function addUser(\Form\RegistrationBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Form\RegistrationBundle\Entity\User $user
     */
    public function removeUser(\Form\RegistrationBundle\Entity\User $user)
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
