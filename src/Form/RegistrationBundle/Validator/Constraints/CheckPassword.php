<?php
namespace Form\RegistrationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


class CheckPassword extends Constraint
{

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}