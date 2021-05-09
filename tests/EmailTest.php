<?php declare(strict_types=1);
require_once __DIR__."/../autoload.php";

use PHPUnit\Framework\TestCase;
use src\Service\EmailService;

final class EmailServiceTest extends TestCase
{
    protected $EmailService;

    /**
     * @group ignore
     */
    public function testCanBeCreatedFromValidEmailServiceAddress(): void
    {
        $this->assertInstanceOf(
            EmailService::class,
            EmailService::fromString('user@example.com')
        );
    }

    /**
     * @group ignore
     */
    public function testCannotBeCreatedFromInvalidEmailServiceAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

        EmailService::fromString('invalid');
    }

    /**
     * @group ignore
     */
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            EmailService::fromString('user@example.com')
        );
    }

    /**
     * @group ignore
     */
    public function testSetupEmailService() {

        $EmailService = new EmailService();
        $EmailService->setEmail('user@example.com');

        $this->assertEquals(
            'user@example.com',
            $EmailService->getEmail()
        );
    }
}