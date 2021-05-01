<?php declare(strict_types=1);
require_once __DIR__."/../autoload.php";

use PHPUnit\Framework\TestCase;
use src\Service\Email;
use src\Service\Password;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;

final class PasswordTest extends TestCase
{

    protected $password;

    protected function setUp(): void
    {
        $this->password = new Password();
    }

    /**
     * Verificar se o token é diferente
     * a cada novo pedido
     */
    public function testGeracaoToken(): void
    {
       $tokenInitial = $this->password->generateToken();
       $tokenFinal = $this->password->generateToken();
       assertNotEquals($tokenInitial, $tokenFinal);
    }

    /**
     * A senha deve ser alfanumérico com pelo menos um caracter especial, 
     * com maiuscula e minúscula com minimo de 9 e máximo de 16 caracteres.
     * 
     * https://www.codexworld.com/how-to/validate-password-strength-in-php/
     * 
     */
    public function testValidacaoSenha(): void
    {
        // $this->assertInstanceOf(
        //     Email::class,
        //     Email::fromString('user@example.com')
        // );
    }

    /**
     * Após gerar a senha, testar se ela 
     * esta identica a palavra original
     */
    public function testGeracaodeSenha(): void
    {
        // $this->assertInstanceOf(
        //     Email::class,
        //     Email::fromString('user@example.com')
        // );
    }


}