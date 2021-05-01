<?php declare(strict_types=1);
require_once __DIR__."/../autoload.php";

use PHPUnit\Framework\TestCase;
use src\Service\Email;

final class EmailTest extends TestCase
{
    protected $email;

    /**
     * @group ignore
     */
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            Email::class,
            Email::fromString('user@example.com')
        );
    }

    /**
     * @group ignore
     */
    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Email::fromString('invalid');
    }

    /**
     * @group ignore
     */
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            Email::fromString('user@example.com')
        );
    }

    /**
     * @group ignore
     */
    public function testSetupEmail() {

        $email = new Email();
        $email->setEmail('user@example.com');

        $this->assertEquals(
            'user@example.com',
            $email->getEmail()
        );
    }
}