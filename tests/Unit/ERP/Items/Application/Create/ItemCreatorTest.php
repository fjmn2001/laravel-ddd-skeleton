<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Create;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Items\Application\Create\ItemCreator;
use Medine\ERP\Shared\Domain\Exceptions\InvalidUuidException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ERP\Items\Infrastructure\InMemoryItemRepository;

final class ItemCreatorTest extends TestCase
{
    use DatabaseTransactions;

    protected $creator;

    protected function setUp(): void
    {
        $this->creator = new ItemCreator(
            new InMemoryItemRepository()
        );

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_valid_item_and_return_null()
    {
        $response = ($this->creator)(CreateItemRequestMother::random());

        $this->assertNull($response);
    }

    /**
     * @test
     */
    public function it_should_throw_invalid_uuid_exception()
    {
        $this->expectException(InvalidUuidException::class);

        $response = ($this->creator)(CreateItemRequestMother::withId('wrong'));

        $this->assertNull($response);
    }
}
