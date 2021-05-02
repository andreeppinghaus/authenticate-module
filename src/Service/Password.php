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

    /**
     * Senha do usuario
     * @var string
     */
    private $password;

    /**
     * Hash de senha do usuário
     * @var string
     */
    private $hash;

    /**
     *  Método de autenticação de senha
     * @param string $password
     * @return boolean
     */
    public function authenticate(string $password): bool{
        $auth = false;

        //obs: buscar o usuario no banco de dados com o hash da senha. (provisorio)
        $hash = $this->hash; 

        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }

        return $auth;
    }

    /**
     * Metodo de validação de senha conforme
     * RF-1.1
     * @link https://www.codexworld.com/how-to/validate-password-strength-in-php
     * @param string $password
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
            $this->password = $password;
            $ok=true;
            // echo 'Strong password.';
        }
        
        return $ok;
    }

    /**
     * Geração de senha com metodo de autenticação bcrypt
     * @link https://www.php.net/manual/pt_BR/function.password-hash.php
     * 
     * @return string $hash
     */
    public function generatePassword():string {
        
        if (empty($this->password)) {
            return null;
        }

        $this->hash = password_hash($this->password, PASSWORD_DEFAULT);

        return $this->hash;
    }
    
    /**
     * Gera um novo token
     * @link https://davidwalsh.name/random_bytes
     * @return string $token
     */
    public function generateToken(): string{

        $token = bin2hex(random_bytes(64));
        
        return $token;
    }

}
