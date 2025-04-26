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

use Chevere\DataStructure\Interfaces\MapInterface;
use Iterator;
use OutOfBoundsException;
use function Chevere\Message\message;

/**
 * @template TValue
 * @implements MapInterface<TValue>
 */
class Map implements MapInterface
{
    /**
     * @var array<mixed>
     */
    protected array $values = [];

    /**
     * @var array<string|int>
     */
    protected array $keys = [];

    /**
     * @var int<0,max>
     */
    protected int $count = 0;

    public function __construct(mixed ...$value)
    {
        foreach ($value as $key => $item) {
            $this->in($key, $item);
        }
    }

    /**
     * @return array<string|int, TValue>
     */
    public function toArray(): array
    {
        return array_combine($this->keys, $this->values);
    }

    public function keys(): array
    {
        return $this->keys;
    }

    public function count(): int
    {
        return $this->count;
    }

    #[\ReturnTypeWillChange]
    public function getIterator(): Iterator
    {
        foreach ($this->keys as $key) {
            $lookup = $this->lookupKey($key);
            yield $key => $this->values[$lookup];
        }
    }

    /**
     * @param TValue ...$value
     * @return self<TValue>
     */
    public function withPut(string|int $key, mixed $value): self
    {
        $new = clone $this;
        $new->in($key, $value);

        return $new;
    }

    /**
     * @return self<TValue>
     */
    public function without(string|int ...$key): self
    {
        $new = clone $this;
        $new->out(...$key);

        return $new;
    }

    public function has(string|int ...$key): bool
    {
        try {
            $this->assertHas(...$key);

            return true;
        } catch (OutOfBoundsException) {
            return false;
        }
    }

    /**
     * @throws OutOfBoundsException
     */
    public function assertHas(string|int ...$key): void
    {
        $missing = [];
        foreach ($key as $item) {
            if ($this->lookupKey($item) === null) {
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
    public function get(string|int $key): mixed
    {
        $lookup = $this->lookupKey($key);
        if ($lookup === null) {
            throw new OutOfBoundsException(
                (string) message(
                    'Key `%key%` not found',
                    key: strval($key)
                )
            );
        }

        return $this->values[$lookup];
    }

    public function getOrDefault(string|int $key, mixed $default = null): mixed
    {
        $lookup = $this->lookupKey($key);
        if ($lookup === null) {
            return $default;
        }

        return $this->values[$lookup];
    }

    protected function lookupKey(string|int $key): ?string
    {
        $lookup = array_search($key, $this->keys, true);

        return $lookup === false ? null : strval($lookup);
    }

    protected function in(string|int $key, mixed $value): void
    {
        $lookUp = $this->lookupKey($key);
        if ($lookUp === null) {
            $this->keys[] = $key;
            $this->values[] = $value;
            $this->count++;

            return;
        }
        $this->values[$lookUp] = $value;
    }

    protected function out(string|int ...$key): void
    {
        foreach ($key as $item) {
            $lookup = $this->lookupKey($item);
            if ($lookup === null) {
                throw new OutOfBoundsException(
                    (string) message(
                        'Key `%key%` not found',
                        key: strval($item)
                    )
                );
            }
            unset($this->keys[$lookup], $this->values[$lookup]);
            $this->count--; // @phpstan-ignore-line
        }
        $this->keys = array_values($this->keys);
        // @infection-ignore-all
        $this->values = array_values($this->values);
    }
}
