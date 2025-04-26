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

namespace Chevere\DataStructure;

use Chevere\DataStructure\Interfaces\MapMutableInterface;

/**
 * @template TValue
 * @extends Map<TValue>
 * @implements MapMutableInterface<TValue>
 */
class MapMutable extends Map implements MapMutableInterface
{
    public function put(string|int $key, mixed $value): void
    {
        $this->in($key, $value);
    }

    public function remove(string|int ...$key): void
    {
        $this->out(...$key);
    }
}
