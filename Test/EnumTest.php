<?php

namespace Makhnanov\PhpEnum81\Test;

use Error;
use PHPUnit\Framework\TestCase;

use function Makhnanov\PhpEnum81\get_by_name;
use function Makhnanov\PhpEnum81\name;
use function Makhnanov\PhpEnum81\value;

class EnumTest extends TestCase
{
    public function testFirst()
    {
        $name = 'SIMPLE_CASE';
        $unrealName = 'unrealName';
        $first = SimpleEnumeration::SIMPLE_CASE;
        $this->assertNull($first->toArray());
        $this->assertNull($first::casesAsKeyValue());
        $this->assertFalse($first->isBacked());
        $this->assertSame($name, $first->name);
        $this->assertSame($name, name($first));
        $this->assertNull(value($first));
        $this->assertSame(
            SimpleEnumeration::SIMPLE_CASE,
            get_by_name(SimpleEnumeration::class, $name)
        );
        $this->assertNull(get_by_name(SimpleEnumeration::class, $unrealName));
        $this->assertSame(SimpleEnumeration::SIMPLE_CASE, SimpleEnumeration::tryByName($name));
        $this->assertTrue(SimpleEnumeration::exist($name));
    }

    public function testError()
    {
        $unrealName = 'unrealName';
        $this->assertFalse(SimpleEnumeration::exist($unrealName));

        $this->expectException(Error::class);

        /** @noinspection PhpExpressionResultUnusedInspection */
        SimpleEnumeration::byName($unrealName);
    }

// ToDo:
//    public function testBacked()
//    {
//    }
}
