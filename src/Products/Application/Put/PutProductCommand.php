<?php

declare(strict_types=1);

namespace Src\Products\Application\Put;

use Src\Shared\Domain\Bus\Command\Command;

final class PutProductCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
