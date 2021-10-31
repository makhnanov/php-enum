<?php

namespace Makhnanov\PhpEnum81\Test;

use Error;
use PHPUnit\Framework\TestCase;

use function Makhnanov\PhpEnum81\get_by_name;
use function Makhnanov\PhpEnum81\get_enum;
use function Makhnanov\PhpEnum81\name;
use function Makhnanov\PhpEnum81\value;

class EnumTest extends TestCase
{
    public function testNotBacked()
    {
        $name = 'SIMPLE_FIRST_CASE';
        $unrealName = 'unrealName';
        $first = SimpleEnumeration::SIMPLE_FIRST_CASE;
        $this->assertNull($first->toArray());
        $this->assertNull($first::casesAsKeyValue());
        $this->assertFalse($first->isBackedEnum());
        $this->assertSame($name, $first->name);
        $this->assertSame($name, name($first));
        $this->assertNull(value($first));
        $this->assertSame(
            SimpleEnumeration::SIMPLE_FIRST_CASE,
            get_by_name(SimpleEnumeration::class, $name)
        );
        $this->assertSame(
            SimpleEnumeration::SIMPLE_FIRST_CASE,
            get_enum(SimpleEnumeration::class, $name)
        );
        $this->assertNull(get_by_name(SimpleEnumeration::class, $unrealName));
        $this->assertSame(SimpleEnumeration::SIMPLE_FIRST_CASE, SimpleEnumeration::tryByName($name));
        $this->assertTrue(SimpleEnumeration::exist($name));

        $this->assertTrue(SimpleEnumeration::isUnitEnum());
        $this->assertSame([
            SimpleEnumeration::SIMPLE_FIRST_CASE->name,
            SimpleEnumeration::SIMPLE_SECOND_CASE->name
        ], SimpleEnumeration::names());
        $this->assertSame([
            SimpleEnumeration::SIMPLE_FIRST_CASE->value ?? null,
            SimpleEnumeration::SIMPLE_SECOND_CASE->value ?? null,
        ], SimpleEnumeration::values());
        $this->assertSame(2, SimpleEnumeration::casesCount());
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

// ToDo:
//    public function testCompareTraitAndInterface()
//    {
//    }

// ToDo: FixDocker add tag and readme

}
