<?php

declare(strict_types=1);

namespace Src\ProductStockMovements\Domain\Events;

use Src\Shared\Domain\Audits\Events\Auditable;
use Src\Shared\Domain\Bus\Event\DomainEvent;

final class ProductStockMovementCreated extends DomainEvent implements Auditable
{
    public function __construct(
        string $id,
        private string $productId,
        private string $type,
        private int $amount,
        private string $createdAt,
        private string $updatedAt,
        string $eventId = null,
        string $occurredAt = null,
    ) {
        parent::__construct($id, $eventId, $occurredAt);
    }

    public static function eventName(): string
    {
        return 'stock-manager.1.event.product-stock-movement.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredAt,
    ): DomainEvent {
        return new self(
            $aggregateId,
            $body['product_id'],
            $body['type'],
            $body['amount'],
            $eventId,
            $occurredAt,
        );
    }

    public function toPrimitives(): array
    {
        return [
            'product_id' => $this->productId,
            'type'       => $this->type,
            'amount'     => $this->amount,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }
}
