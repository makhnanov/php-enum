<?php

declare(strict_types=1);

use Makhnanov\PhpEnum\EnumExtension;

require_once join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'vendor', 'autoload.php']);

enum TestEnum: string
{
    use EnumExtension;

    case a = 'b';
    case c = 'd';
}

dd(TestEnum::casesAsKeyValue());