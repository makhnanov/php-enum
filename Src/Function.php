<?php

namespace Makhnanov\PhpEnum;

use JetBrains\PhpStorm\Pure;
use Stringable;
use UnitEnum;

function name(UnitEnum $enum): string
{
    return $enum->name;
}

function value(UnitEnum $enum): null|int|string
{
    return $enum->value ?? null;
}

function is_defined(string|Stringable $enumClass, string|Stringable $enumName): bool
{
    return defined($enumClass . '::' . $enumName);
}

#[Pure]
function get_by_name(string|Stringable $enumClass, string|Stringable $enumName): mixed
{
    return is_defined($enumClass, $enumName)
        ? constant($enumClass . '::' . $enumName)
        : null;
}

/**
 * Alias for get_by_name
 */
#[Pure] function get_enum(string|Stringable $enumClass, string|Stringable $enumName): mixed
{
    return get_by_name($enumClass, $enumName);
}
