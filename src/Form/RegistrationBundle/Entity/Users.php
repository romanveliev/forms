<?php

namespace Form\RegistrationBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Users
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    private $role;

    protected $roles;

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;

        return $this;
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
     * @return Users
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
     * Set email
     *
     * @param string $email
     *
     * @return Users
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
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @var \Form\RegistrationBundle\Entity\Roles
     */


    /**
     * Set roles
     *
     * @param \Form\RegistrationBundle\Entity\Roles $roles
     *
     * @return Users
     */
//    public function setRoles(\Form\RegistrationBundle\Entity\Roles $roles = null)
//    {
//        $this->roles = $roles;
//
//        return $this;
//    }

    /**
     * Get roles
     *
     * @return \Form\RegistrationBundle\Entity\Roles
     */
//    public function getRoles()
//    {
//        return $this->roles;
//    }


////
    public function getUsername()
    {
        return $this->name;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array($this->role);
    }


    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->name,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function eraseCredentials()
    {
    }

}
