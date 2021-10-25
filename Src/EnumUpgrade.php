<?php

namespace Makhnanov\PhpEnum81;

use BackedEnum;
use Error;
use JetBrains\PhpStorm\Pure;
use Stringable;
use UnitEnum;

trait EnumUpgrade
{
    #[Pure]
    public static function tryByName(string|Stringable $name): ?UnitEnum
    {
        return get_by_name(__CLASS__, $name);
    }

    /**
     * @throws Error
     */
    public static function byName(string|Stringable $name): UnitEnum
    {
        return constant(__CLASS__ . '::' . $name);
    }

    #[Pure]
    public static function exist(string|Stringable $name): bool
    {
        return is_defined(__CLASS__, $name);
    }

    #[Pure]
    public function toArray(bool $reverse = false): ?array
    {
        if (!self::isBacked()) {
            return null;
        }
        /** @noinspection PhpUndefinedFieldInspection */
        return $reverse
            ? [$this->name => $this->value]
            : [$this->value => $this->name];
    }

    public static function casesAsKeyValue(bool $reverse = false): ?array
    {
        if (!self::isBacked()) {
            return null;
        }
        return array_map(function (BackedEnum $enum) use ($reverse) {
            return $enum->toArray($reverse);
        }, self::cases());
    }

    public static function isBacked(): bool
    {
        return is_a(__CLASS__, BackedEnum::class, true);
    }
}
