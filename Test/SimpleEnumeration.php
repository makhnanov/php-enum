<?php

namespace Makhnanov\PhpEnum81\Test;

use Makhnanov\PhpEnum81\UpgradeEnum;

enum SimpleEnumeration
{
    use UpgradeEnum;

    case SIMPLE_FIRST_CASE;
    case SIMPLE_SECOND_CASE;
}
