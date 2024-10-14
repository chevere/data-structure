# DataStructure

![Chevere](chevere.svg)

[![Build](https://img.shields.io/github/actions/workflow/status/chevere/data-structure/test.yml?branch=1.0&style=flat-square)](https://github.com/chevere/data-structure/actions)
![Code size](https://img.shields.io/github/languages/code-size/chevere/data-structure?style=flat-square)
[![Apache-2.0](https://img.shields.io/github/license/chevere/data-structure?style=flat-square)](LICENSE)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%209-blueviolet?style=flat-square)](https://phpstan.org/)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat-square&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fchevere%2Fdata-structure%2F1.0)](https://dashboard.stryker-mutator.io/reports/github.com/chevere/data-structure/1.0)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=chevere_data-structure&metric=alert_status)](https://sonarcloud.io/dashboard?id=chevere_data-structure)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_data-structure&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=chevere_data-structure)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_data-structure&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=chevere_data-structure)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=chevere_data-structure&metric=security_rating)](https://sonarcloud.io/dashboard?id=chevere_data-structure)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=chevere_data-structure&metric=coverage)](https://sonarcloud.io/dashboard?id=chevere_data-structure)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=chevere_data-structure&metric=sqale_index)](https://sonarcloud.io/dashboard?id=chevere_data-structure)
[![CodeFactor](https://www.codefactor.io/repository/github/chevere/data-structure/badge)](https://www.codefactor.io/repository/github/chevere/data-structure)

## Summary

DataStructure provides Map and Vector data structures.

## Installing

DataStructure is available through [Packagist](https://packagist.org/packages/chevere/data-structure) and the repository source is at [chevere/data-structure](https://github.com/chevere/data-structure).

```sh
composer require chevere/data-structure
```

## Map

A Map is a sequential collection of key-value pairs. Keys can be of type `integer` and `string`.

Create a Map by passing named arguments of any type.

```php
use Chevere\DataStructure\Map;

$map = new Map(foo: $foo, bar: $bar);
```

### Put Map values

The `withPut` method is used to put value(s) to the Map.

```php
$map = $map
    ->withPut(
        foo: $foo,
        bar: $bar
    );
```

### Counting Map keys

The `count` method returns the number of keys mapped.

```php
$map->count();
// 2
```

### Map keys

The `keys` method is used to retrieve the map keys as an array.

```php
$map->keys();
// ['foo', 'bar']
```

### Has Map keys

The `has` method is used to check if the Map contains the given key(s).

```php
$map->has('foo'); // true
$map->has('notFound'); // false
```

### Assert has Map keys

The `assertHas` method is used to assert if the Map contains the given key(s). It throws an exception when failing to assert.

```php
$map->assertHas('foo');
$map->assertHas('notFound');
```

### Get Map value

The `get` method is used to retrieve the Map value for the given key.

```php
$foo = $map->get('foo');
$bar = $map->get('bar');
```

## Vector

A Vector is a sequence of values of any type. Keys are of type integer.

Create a Vector by passing values.

```php
use Chevere\DataStructure\Vector;

$vector = new Vector($value1, $value2,);
```

### Counting Vector keys

The `count` method returns the number of keys in the vector.

```php
$vector->count();
// 2
```

### Vector keys

The `keys` method is used to retrieve the map keys as an array.

```php
$map->keys();
// [0, 1]
```

### Push Vector values

The `withPush` method is used to add one or more elements to the end of the sequence.

```php
$with = $vector->withPush($value,);
```

### Set Vector values

The `withSet` method is used to set the value at the given position.

```php
$with = $vector->withSet(0, $value);
```

### Unshift Vector values

The `withUnshift` method is used to prepend one or more elements at the beginning of the sequence.

```php
$with = $vector->withUnshift($value,);
```

### Insert Vector values

The `withInsert` method is used to insert values at a given position.

```php
$with = $vector->withInsert($pos, ...$values);
```

### Remove Vector values

The `withRemove` method is used to remove one or more values at a given position.

```php
$with = $vector->withRemove($pos,);
```

### Has Vector values

The `has` method is used to check if the Vector contains the given value(s).

```php
$vector->has($value); // true
$vector->has($notFound); // false
```

### Assert Vector has values

The `assertHas` method is used to assert if the Vector contains the given value(s). It throws an exception when failing to assert.

```php
$vector->assertHas($value);
```

### Get Vector value

The `get` method is used to retrieve the Vector value at the given position.

```php
$value = $vector->get($pos);
```

## Find values

The `find` method is used to find the position for the given value.

```php
$pos = $vector->find($value);
```

## Contains values

The `contains` method is used to check if the Vector contains the given value(s).

```php
$vector->contains($value); // bool
```

## Documentation

Documentation is available at [chevere.org](https://chevere.org/packages/data-structure).

## License

Copyright [Rodolfo Berrios A.](https://rodolfoberrios.com/)

Chevere is licensed under the Apache License, Version 2.0. See [LICENSE](LICENSE) for the full license text.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
