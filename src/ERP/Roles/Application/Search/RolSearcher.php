<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Search;

use Medine\ERP\Roles\Application\RolesResponse;
use Medine\ERP\Roles\Application\RolResponse;
use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class RolSearcher
{
    private $repository;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RolSearcherRequest $request): RolesResponse
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->limit(),
            $request->offset()
        );

        return new RolesResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return static function (Rol $rol) {
            return new RolResponse(
                $rol->id()->value(),
                $rol->name()->value(),
                $rol->description()->value(),
                $rol->superuser()->value(),
                $rol->state()->value()
            );
        };
    }
}
