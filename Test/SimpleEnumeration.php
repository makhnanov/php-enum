<?php

namespace Makhnanov\PhpEnum\Test;

use Makhnanov\PhpEnum\UpgradeEnum;

enum SimpleEnumeration
{
    use UpgradeEnum;

    case SIMPLE_FIRST_CASE;
    case SIMPLE_SECOND_CASE;
}
