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

use Chevere\DataStructure\Interfaces\VectorInterface;
use Iterator;
use OutOfBoundsException;
use function Chevere\Message\message;

final class Vector implements VectorInterface
{
    /**
     * @var array<mixed>
     */
    private array $values = [];

    private int $count = 0;

    public function __construct(mixed ...$value)
    {
        $this->put(...$value);
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function toArray(): array
    {
        return $this->values;
    }

    public function keys(): array
    {
        return array_keys($this->values);
    }

    public function count(): int
    {
        return $this->count;
    }

    #[\ReturnTypeWillChange]
    public function getIterator(): Iterator
    {
        foreach ($this->values as $value) {
            yield $value;
        }
    }

    public function withPush(mixed ...$value): self
    {
        $new = clone $this;
        $new->put(...$value);

        return $new;
    }

    public function withSet(int $pos, mixed $value): self
    {
        $this->assertHas($pos);
        $new = clone $this;
        $new->values[$pos] = $value;

        return $new;
    }

    public function withUnshift(mixed ...$value): self
    {
        $new = clone $this;
        array_unshift($new->values, ...$value);
        $new->count += count($value);

        return $new;
    }

    public function withInsert(int $pos, mixed ...$values): VectorInterface
    {
        $this->assertHas($pos);
        $new = clone $this;
        array_splice($new->values, $pos, 0, $values);
        $new->count += count($values);

        return $new;
    }

    public function withRemove(int ...$pos): VectorInterface
    {
        $this->assertHas(...$pos);
        $new = clone $this;
        foreach ($pos as $item) {
            unset($new->values[$item]);
            $new->count--;
        }
        $new->values = array_values($new->values);

        return $new;
    }

    public function has(int ...$pos): bool
    {
        try {
            $this->assertHas(...$pos);

            return true;
        } catch (OutOfBoundsException) {
            return false;
        }
    }

    /**
     * @throws OutOfBoundsException
     */
    public function assertHas(int ...$key): void
    {
        $missing = [];
        foreach ($key as $item) {
            if (! $this->lookupKey($item)) {
                $missing[] = strval($item);
            }
        }
        if ($missing === []) {
            return;
        }

        throw new OutOfBoundsException(
            (string) message(
                'Missing key(s) `%keys%`',
                keys: implode(', ', $missing)
            )
        );
    }

    /**
     * @throws OutOfBoundsException
     */
    public function get(int $pos): mixed
    {
        if (! $this->lookupKey($pos)) {
            throw new OutOfBoundsException(
                (string) message(
                    'Key `%key%` not found',
                    key: strval($pos)
                )
            );
        }

        return $this->values[$pos];
    }

    public function find(mixed $value): ?int
    {
        /** @var int|false $lookup */
        $lookup = array_search($value, $this->values, true);

        return $lookup === false ? null : $lookup;
    }

    public function contains(mixed ...$value): bool
    {
        foreach ($value as $item) {
            if ($this->find($item) === null) {
                return false;
            }
        }

        return true;
    }

    private function lookupKey(int $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    private function put(mixed ...$values): void
    {
        foreach ($values as $value) {
            $this->values[] = $value;
            $this->count++;
        }
    }
}
