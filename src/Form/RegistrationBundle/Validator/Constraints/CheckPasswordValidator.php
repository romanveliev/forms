<?php
namespace Form\RegistrationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckPasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {

            die('it works');

    }
}