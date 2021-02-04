<?php
declare(strict_types=1);

namespace Medine\ERP\Users\Application\Update;

final class UserRenamerRequest
{
    private $email;
    private $name;

    public function __construct(
        string $email,
        string $name

    )
    {
        $this->email = $email;
        $this->name = $name;
    }


    public function email(): string
    {
        return $this->email;
    }

    public function name(): string
    {
        return $this->name;
    }
}
