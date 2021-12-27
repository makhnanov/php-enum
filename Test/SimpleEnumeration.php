<?php

namespace Makhnanov\PhpEnum\Test;

use Makhnanov\PhpEnum\EnumExtension;

enum SimpleEnumeration
{
    use EnumExtension;

    case SIMPLE_FIRST_CASE;
    case SIMPLE_SECOND_CASE;
}
