<?php

namespace Makhnanov\PhpEnum81;

use Stringable;

interface UpgradedEnumInterface
{
    public static function tryByName(string|Stringable $name): null|int|string|static;

    public static function byName(string|Stringable $name): mixed;

    public static function exist(string|Stringable $name): bool;

    public function toArray(bool $reverse = false): ?array;

    public static function casesAsKeyValue(bool $reverse = false): ?array;

    public static function isBackedEnum(): bool;

    public static function isUnitEnum(): bool;

    public static function names(): ?array;

    public static function values(): ?array;

    public static function casesCount(): int;

    public static function casesNames(): array;

    public static function casesValues(): array;
}
