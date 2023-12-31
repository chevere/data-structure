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

/**
 * Describes the component in charge of providing a Map interface.
 *
 * @template TValue
 * @extends StringIntMappedInterface<TValue>
 */
interface MapInterface extends StringIntMappedInterface
{
    /**
     * @param TValue ...$value
     * @return self<TValue>
     */
    public function withPut(string|int $key, mixed $value): self;

    /**
     * @return self<TValue>
     */
    public function without(string|int ...$key): self;

    public function has(string|int ...$key): bool;

    public function assertHas(string|int ...$key): void;

    /**
     * @return TValue
     */
    public function get(string|int $key): mixed;

    /**
     * @return array<int|string, TValue>
     */
    public function toArray(): array;
}
