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
 * Describes the component in charge of providing a mutable Map interface.
 *
 * @template TValue
 * @extends MapInterface<TValue>
 */
interface MapMutableInterface extends MapInterface
{
    public function put(string|int $key, mixed $value): void;

    public function remove(string|int ...$key): void;
}
