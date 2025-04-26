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

namespace Chevere\Tests;

use Chevere\DataStructure\MapMutable;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

final class MapMutableTest extends TestCase
{
    public function testPutGet(): void
    {
        $map = new MapMutable();
        $map->put('test', 123);
        $this->assertSame(123, $map->get('test'));
        $map->remove('test');
        $this->expectException(OutOfBoundsException::class);
        $map->get('test');
    }
}
