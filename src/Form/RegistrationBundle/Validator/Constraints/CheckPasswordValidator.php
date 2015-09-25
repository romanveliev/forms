<?php
namespace Form\RegistrationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckPasswordValidator extends ConstraintValidator
{
    public function validate($password, Constraint $constraint)
    {
        $length = strlen($password);

        if(!preg_match('/^[a-z0-9_-]{1,18}$/', $password) && $length <= 15 ){
            $constraint->message = 'Password contains invalid characters';
            $this->context->buildViolation($constraint->message)
                            ->setCode(0)
                            ->addViolation();
        }else{
        /*
         * too small password
         */
            if( ($length >= 0) && ($length <= 4) ){
                $constraint->message = 'Password too short';
                $this->context->buildViolation($constraint->message)
                             ->setCode(0)
                             ->addViolation();
            }
        /*
         * weak password
         */
            if( ($length >= 5) && ($length <= 7) ){
                $constraint->message = 'Weak password';
                $this->context->buildViolation($constraint->message)
                                ->setCode(0)
                                ->addViolation();
            }
        /*
         * good password
         */
            if( ($length >= 8) && ($length <= 15) ){
                $constraint->message = 'Good password';
                $this->context->buildViolation($constraint->message)
                                ->setCode(1)
                                ->addViolation();
            }
        /*
         * too many symbols
         */
            if($length >=15 ){
                $constraint->message = 'Too many symbols';
                $this->context->buildViolation($constraint->message)
                                ->setCode(0)
                                ->addViolation();
            }
        }

    }
}