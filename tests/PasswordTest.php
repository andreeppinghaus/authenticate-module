<?php declare(strict_types=1);
require_once __DIR__."/../autoload.php";

use PHPUnit\Framework\TestCase;
use src\Service\Email;
use src\Service\Password;
use src\Service\PasswordService;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;

final class PasswordTest extends TestCase
{

    protected $password;

    protected function setUp(): void
    {
        $this->password = new PasswordService();
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
     * @dataProvider passwordProvider
     */
    public function testValidacaoSenha($password, $expected): void
    {
       assertEquals($expected, $this->password->validate($password));
    }

    public function passwordProvider()
    {
        return [
            ["0",false],
            ["12345678910",false],
            ["12345678910A",false],
            ["12345678910Ab",false],
            ["12345678910111213451516Ab_",false],
            ["12345678910Ab@",true],
        ];
    }

    /**
     * Após validar a senha, vai gerar um hash e logo depois irá testá-la 
     * constatando que é idêntica a palavra original
     */
    public function testGeracaodeSenha(): void
    {
        $password = "12345678910Ab@";
        $this->password->validate($password);
        $this->password->generatePassword();
        
        assertEquals(true, $this->password->authenticate($email="emailvalido", $password));

        assertNotEquals(true, $this->password->authenticate($email="emailvalido","senha_diferente"));
    }


}