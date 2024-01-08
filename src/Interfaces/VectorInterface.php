<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevere.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Chevere\DataStructure\Interfaces;

use Countable;

/**
 * Describes the component in charge of defining a vector interface.
 * @phpstan-ignore-next-line
 */
interface VectorInterface extends Countable, IntegerKeysInterface, GetIteratorInterface
{
    public function withPush(mixed ...$value): self;

    public function withSet(int $pos, mixed $value): self;

    public function withUnshift(mixed ...$value): self;

    public function withInsert(int $pos, mixed ...$values): self;

    public function withRemove(int ...$pos): self;

    public function has(int ...$pos): bool;

    public function get(int $pos): mixed;

    public function find(mixed $value): ?int;

    public function contains(mixed ...$value): bool;

    public function assertHas(int ...$key): void;

    /**
     * @phpstan-ignore-next-line
     */
    public function toArray(): array;
}
