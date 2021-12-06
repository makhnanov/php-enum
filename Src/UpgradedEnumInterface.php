<?php

namespace Makhnanov\PhpEnum81;

use Stringable;

interface UpgradedEnumInterface
{
    public function isEqual(self $expected): bool;

    public static function tryByName(null|string|Stringable $name, self $default): null|self;

    public static function byName(string|Stringable $name): mixed;

    public static function exist(string|Stringable $name): bool;

    public function toArray(bool $reverse = false): ?array;

    public static function casesAsKeyValue(bool $reverse = false): ?array;

    public static function isBackedEnum(): bool;

    public static function isUnitEnum(): bool;

    public static function names(): array;

    public static function values(): array;

    public static function casesCount(): int;
}
