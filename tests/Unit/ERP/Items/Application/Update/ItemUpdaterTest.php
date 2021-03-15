<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Update;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Items\Application\Update\ItemUpdater;
use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Entity\Item;
use Tests\TestCase;
use Tests\Unit\ERP\Items\Domain\ItemMother;

final class ItemUpdaterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_should_update_an_existing_item_and_return_null()
    {
        $item = ItemMother::random();
        $repository = $this->createMock(ItemRepository::class);
        $updater = new ItemUpdater($repository);

        $this->shouldFind($repository, $item);
        $this->shouldUpdate($repository, $item);

        $response = ($updater)(UpdateItemRequestMother::withId(
            $item->id()->value()
        ));

        $this->assertNull($response);
    }

    private function shouldFind(\PHPUnit\Framework\MockObject\MockObject $repository, Item $item): void
    {
        $repository->method('find')
            ->with($this->equalTo($item->id()))
            ->willReturn($item);
    }

    private function shouldUpdate(\PHPUnit\Framework\MockObject\MockObject $repository, Item $item): void
    {
        $repository->method('update')
            ->with($this->equalTo($item));
    }
}
