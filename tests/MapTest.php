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

use Chevere\DataStructure\Map;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    public function testConstructEmpty(): void
    {
        $map = new Map();
        $this->assertCount(0, $map);
        $this->assertSame([], $map->toArray());
        $this->expectException(OutOfBoundsException::class);
        $map->assertHas('not-found');
    }

    public function testConstructWithArguments(): void
    {
        $arguments = [
            'test' => 123,
            'some' => 'thing',
        ];
        $map = new Map(...$arguments);
        $this->assertCount(2, $map);
        foreach ($arguments as $name => $value) {
            $this->assertSame($value, $map->get($name));
        }
        $this->assertSame($arguments, $map->toArray());
        $this->assertTrue($map->has('test', 'some'));
        $array = iterator_to_array($map->getIterator());
        $this->assertSame($arguments, $array);
    }

    public function testConstructWithRepeatedArguments(): void
    {
        $arguments = [
            'test' => 123,
            'test' => 123,
            'test' => 123,
        ];
        $map = new Map(...$arguments);
        $this->assertCount(1, $map);
        foreach ($arguments as $name => $value) {
            $this->assertSame($value, $map->get($name));
        }
        $this->assertSame($arguments, $map->toArray());
        $this->assertTrue($map->has('test'));
    }

    public function testWithPut(): void
    {
        $key = 'key';
        $value = 1234;
        $map = new Map();
        $arguments = [
            $key => $value,
        ];
        $with = $map->withPut($key, $value);
        $this->assertNotSame($map, $with);
        $this->assertNotSame($map->keys(), $with->keys());
        $this->assertSame($value, $with->get($key));
        $with->assertHas($key);
        $this->assertSame($arguments, $with->toArray());
    }

    public function testWithPutConsecutive(): void
    {
        $map = new Map();
        $with = $map
            ->withPut('a', 'a')
            ->withPut('b', 'b')
            ->withPut('a', 'a');
        $this->assertCount(2, $with);
    }

    public function testWithPutNumericVariadic(): void
    {
        $map = new Map();
        foreach ([128, 256] as $item) {
            $map = $map->withPut(strval($item), $item);
        }
        $this->assertCount(2, $map);
    }

    public function testWithout(): void
    {
        $map = (new Map())
            ->withPut('a', 'foo')
            ->withPut('b', 'bar');
        $this->assertCount(2, $map);
        $with = $map->without('a');
        $this->assertCount(1, $with);
        $this->assertNotSame($map, $with);
        $this->assertFalse($with->has('a'));
        $this->assertSame(['b'], $with->keys());
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('Key `a` not found');
        $with->without('a');
    }

    public function testArrayKeys(): void
    {
        $map = (new Map())
            ->withPut('', 'empty')
            ->withPut(0, 'zero');
        $array = [
            '' => 'empty',
            0 => 'zero',
        ];
        $this->assertSame(array_keys($array), $map->keys());
        $this->assertSame($array[''], $map->get(''));
        $this->assertSame($array[0], $map->get(0));
        $this->assertFalse($map->has('0'));
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('Key `0` not found');
        $map->get('0');
    }
}
