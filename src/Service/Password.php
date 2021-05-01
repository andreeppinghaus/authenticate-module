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

    public function validate(string $password) {

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
