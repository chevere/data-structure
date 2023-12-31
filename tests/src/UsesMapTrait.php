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

namespace Chevere\Tests\src;

use Chevere\DataStructure\Map;
use Chevere\DataStructure\Traits\MapTrait;

final class UsesMapTrait
{
    use MapTrait;

    public function __clone()
    {
    }

    public function withPut(string $key, object $object): static
    {
        $new = clone $this;
        $new->map = $new->map->withPut($key, $object);

        return $new;
    }

    public function map(): Map
    {
        return $this->map;
    }
}
