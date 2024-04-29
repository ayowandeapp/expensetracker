<?php

declare(strict_types=1);

use App\Services\ValidatorService;
use Framework\Exceptions\ValidationException;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    public function testLoginDataValidate(): void
    {
        $data = (new ValidatorService)->validateLogin(['email' => 'user@example.com', 'password' => 12345]);

        $this->assertEquals($data, null);
    }


    public function testCannotLogin(): void
    {
        $this->expectException(ValidationException::class);

        (new ValidatorService)->validateLogin(['email' => 'userexample.com', 'password' => 12345]);
    }


    public function testFailure(): void
    {
        $expected = new DateTimeImmutable('2023-02-23 01:23:45');
        $actual   = new DateTimeImmutable('2023-02-23 01:23:46');

        $this->assertEquals($expected, $actual);
    }
}
