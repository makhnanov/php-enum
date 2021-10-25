<?php

namespace Makhnanov\PhpEnum81\Test;

use Makhnanov\PhpEnum81\EnumUpgrade;

enum SimpleEnumeration
{
    use EnumUpgrade;

    case SIMPLE_CASE;
}
