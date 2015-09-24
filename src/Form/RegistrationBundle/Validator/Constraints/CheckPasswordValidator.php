<?php
namespace Form\RegistrationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckPasswordValidator extends ConstraintValidator
{
    public function validate($password, Constraint $constraint)
    {
        $length = strlen($password);

        if(!preg_match('/^[a-z0-9_-]{1,18}$/', $password)){
            $constraint->message = 'Password contains invalid characters';
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }else{
        /*
         * too small password
         */
            if( ($length >= 0) && ($length <= 5) ){
                $constraint->message = 'Password too short';
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        /*
         * weak password
         */
            if( ($length >= 6) && ($length <= 8) ){
                $constraint->message = 'Weak password';
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        /*
         * good password
         */
            if( ($length >= 9) && ($length <= 15) ){
                $constraint->message = 'Good password';
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        /*
         * too many symbols
         */
            if($length >=15 ){
                $constraint->message = 'Too many symbols';
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }

    }
}