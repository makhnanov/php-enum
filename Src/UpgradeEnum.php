<?php

namespace Makhnanov\PhpEnum;

use BackedEnum;
use Error;
use JetBrains\PhpStorm\Pure;
use Stringable;
use UnitEnum;

trait UpgradeEnum
{
    public function isEqual(self $expected): bool
    {
        return $this === $expected;
    }

    #[Pure]
    public static function tryByName(null|string|Stringable $name, self $default = null): null|self
    {
        return get_by_name(__CLASS__, (string)$name) ?? $default;
    }

    /**
     * @throws Error
     */
    public static function byName(string|Stringable $name): mixed
    {
        return constant(__CLASS__ . '::' . $name);
    }

    #[Pure]
    public static function exist(string|Stringable $name): bool
    {
        return is_defined(__CLASS__, $name);
    }

    #[Pure]
    public function toArray(bool $reverse = false): array
    {
        return $reverse
            ? [$this->name => $this->value ?? null]
            : [$this->value ?? 0 => $this->name];
    }

    public static function casesAsKeyValue(bool $reverse = false): ?array
    {
        if (!static::isBackedEnum()) {
            return null;
        }
        return array_map(function (BackedEnum $enum) use ($reverse) {
            return $enum->toArray($reverse);
        }, static::cases());
    }

    public static function isBackedEnum(): bool
    {
        return is_a(__CLASS__, BackedEnum::class, true);
    }

    public static function isUnitEnum(): bool
    {
        return is_a(__CLASS__, UnitEnum::class, true);
    }

    public static function names(): array
    {
        return array_map(function (UnitEnum $enum) {
            return $enum->name;
        }, static::cases());
    }

    public static function values(): array
    {
        return array_map(function (UnitEnum $enum) {
            return $enum->value ?? null;
        }, static::cases());
    }

    public static function casesCount(): int
    {
        return count(static::cases());
    }
}
