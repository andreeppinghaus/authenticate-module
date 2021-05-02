<?php declare(strict_types=1);

namespace src\Service;

use InvalidArgumentException;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Responsável pelo gerenciamento de senhas
 * @author André Eppinghaus
 */
class Password implements PasswordInterface
{


    public function setPassword(string $password){

    }

    /**
     * Metodo de validação de senha conforme
     * RF-1.1
     * @link https://www.codexworld.com/how-to/validate-password-strength-in-php
     * @param string
     * @return boolean
     */
    public function validate(string $password): bool {
        
        $ok = false;

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8
            || strlen($password) >= 16 ) {
            $ok=false;
            //echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        }else{
            $ok=true;
            // echo 'Strong password.';
        }
        
        return $ok;
    }

    public function generatePassword(){
    }
    
    /**
     * Gera um novo token
     * @link https://davidwalsh.name/random_bytes
     * @return string
     */
    public function generateToken(): string{

        $token = bin2hex(random_bytes(64));
        
        return $token;
    }

}
