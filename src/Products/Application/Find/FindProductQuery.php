<?php

declare(strict_types=1);

namespace Src\Products\Application\Find;

use Src\Shared\Domain\Bus\Query\Query;

final class FindProductQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
