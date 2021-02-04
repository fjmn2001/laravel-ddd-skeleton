<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Users\Application\Create;

use Faker\Factory;
use Medine\ERP\Shared\Domain\Exceptions\EmptyArgumentException;
use Medine\ERP\Shared\Domain\Exceptions\InvalidEmailException;
use Medine\ERP\Users\Application\UserCreator;
use Medine\ERP\Users\Application\UserCreatorRequest;
use Medine\ERP\Users\Infrastructure\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

final class UserCreatorTest extends TestCase
{
    protected $creator;
    protected $faker;

    protected function setUp(): void
    {
        $this->creator = new UserCreator(
            new InMemoryUserRepository()
        );
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_valid_user_and_return_null()
    {
        $result = ($this->creator)(new UserCreatorRequest(
            $this->faker->name,
            $this->faker->email,
            $this->faker->password
        ));

        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function it_should_throw_invalid_email_exception()
    {
        $this->expectException(InvalidEmailException::class);

        ($this->creator)(new UserCreatorRequest(
            $this->faker->name,
            '@test.net',
            $this->faker->password
        ));
    }

    /**
     * @test
     */
    public function it_should_throw_empty_argument_exception()
    {
        $this->expectException(EmptyArgumentException::class);

        $result = ($this->creator)(new UserCreatorRequest(
            '',
            $this->faker->email,
            $this->faker->password
        ));
    }
}
