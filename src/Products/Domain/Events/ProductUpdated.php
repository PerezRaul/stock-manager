<?php

declare(strict_types=1);

namespace Src\Products\Domain\Events;

use Src\Shared\Domain\Audits\Events\Auditable;
use Src\Shared\Domain\Bus\Event\DomainEvent;

final class ProductUpdated extends DomainEvent implements Auditable
{
    public function __construct(
        string $id,
        private string $name,
        private int $stock,
        private string $createdAt,
        private string $updatedAt,
        private array $changes,
        string $eventId = null,
        string $occurredAt = null,
    ) {
        parent::__construct($id, $eventId, $occurredAt);
    }

    public static function eventName(): string
    {
        return 'stock-manager.1.event.product.updated';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredAt,
    ): DomainEvent {
        return new self(
            $aggregateId,
            $body['name'],
            $body['stock'],
            $body['created_at'],
            $body['updated_at'],
            $body['changes'],
            $eventId,
            $occurredAt,
        );
    }

    public function toPrimitives(): array
    {
        return [
            'name'       => $this->name,
            'stock'      => $this->stock,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'changes'    => $this->changes,
        ];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function stock(): int
    {
        return $this->stock;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }

    public function changes(): array
    {
        return $this->changes;
    }
}
