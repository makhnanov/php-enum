<?php

declare(strict_types=1);

use Makhnanov\PhpEnum\EnumExtension;

require_once join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'vendor', 'autoload.php']);

enum TestEnum: string
{
    use EnumExtension;

    case a = 'a';
    case b = 'b';
    case c = 'c';

    public function toInt(): int
    {
        return match ($this) {
            self::a => 1,
            self::b => 22,
            self::c => 3,
        };
    }

    public static function allToInt(): array
    {
        return self::mapInternalCallback(self::values(), 'toInt');
    }
}

dump(TestEnum::allToInt());
dd(TestEnum::casesAsKeyValue());

/**
php Example/debug.php
 */