<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Application\Response;

use Illuminate\Support\Str;

final class ClientTypeResponse
{
    private $id;
    private $companyId;
    private $name;
    private $discription;
    private $state;

    public function __construct(
        string $id,
        string $companyId,
        string $name,
        string $discription,
        string $state
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->name = $name;
        $this->discription = $discription;
        $this->state = $state;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function discription(): string
    {
        return $this->discription;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function stateButton(): string
    {
        $title = Str::ucfirst($this->state);
        $class = $this->state === 'active' ? 'btn-green' : 'btn-red';

        return '<button type="button" class="btn btn-sm btn-table changeState ' . $class . '">' . $title . '</button>';
    }

}
