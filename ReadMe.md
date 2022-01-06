![Logo](https://github.com/makhnanov/php-enum/blob/main/php-enum-logo.png?raw=true)
# Introduction
In [PHP 8.1](https://www.php.net/releases/8.1/en.php) we got [Enumeration](https://www.php.net/manual/en/language.enumerations.php). Thank you, Larry Garfield, Ilija Tovilo, for your [RFC](https://wiki.php.net/rfc/enumerations)!

You can read any overview:
- [How to Use Enums in PHP 8.1](https://www.cloudsavvyit.com/14076/how-to-use-enums-in-php-8-1/)
- [Enum в PHP 8.1 — для чего нужен enum, и как реализован в PHP](https://habr.com/ru/post/541246/)
- [Enum в PHP](https://habr.com/ru/post/314114/)
- [PHP 8.1: Enums (Перечисления)](https://sergeymukhin.com/blog/php-81-enums-perecisleniya)

But I duplicate some info in Basic Enum usage section.
# Installation
```shell
composer require makhnanov/php-enum
```

# Basic Enum usage
<details>
<summary>Show</summary>

[basic.php](https://github.com/makhnanov/php-enum/blob/main/Example/basic.php)

```php
<?php
/** @noinspection PhpUnusedMatchConditionInspection */
/** @noinspection PhpExpressionWithSameOperandsInspection */
/** @noinspection PhpConditionAlreadyCheckedInspection */

declare(strict_types=1);

# Shorten
use FoolishPureOrderStatusEnum as FoolishPureStatus;

$classObjectOne = new FoolishOrder;

echo 'Use class before declare:' . PHP_EOL;
var_dump($classObjectOne::class === 'FoolishClass'); # bool(true)

class FoolishOrder
{
    public FoolishPureStatus $status;
}

$classObjectTwo = new FoolishOrder;

echo 'Compare class object with self:' . PHP_EOL;
var_dump($classObjectOne === $classObjectOne); # bool(true)
echo 'Compare class different objects:' . PHP_EOL;
var_dump($classObjectOne === $classObjectTwo); # bool(false)

try {
    echo 'Use enum before declare:' . PHP_EOL;
    $statusOne = FoolishPureStatus::New;
} catch (Error $e) {
    echo get_class($e) . ' throw and can be caught' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL; # Class "FoolishPureStatus" not found
}

enum FoolishPureOrderStatusEnum
{
    use NextFoolishStatus;

    const CONSTANT = 'CONSTANT';

    case New;
    case ShopQuestion;
    case ClientQuestion;
    case Agreed;
    case Completed;
    case Ready;
    case Delivery;
    case Executed;
    case Returned;

    static function canExecuteStaticFunctions(): string
    {
        return 'Yes' . PHP_EOL;
    }

    static function canExecuteFunctions(): string
    {
        return 'Yes' . PHP_EOL;
    }
}

$statusOne = FoolishPureStatus::New;
$statusTwo = FoolishPureStatus::New;

echo 'Compare enum with self:' . PHP_EOL;
var_dump($statusOne === FoolishPureStatus::New); # bool(true)

echo 'Compare enum with direct case:' . PHP_EOL;
var_dump($statusOne === FoolishPureStatus::New); # bool(true)

echo 'Compare enum with another var with same case:' . PHP_EOL;
var_dump($statusOne === $statusTwo); # bool(true)

echo 'Execute function from enum:' . PHP_EOL;
echo FoolishPureStatus::canExecuteFunctions(); # Yes

echo 'Execute static function from enum:' . PHP_EOL;
echo FoolishPureStatus::canExecuteStaticFunctions(); # Yes

echo 'Execute static function from enum case:' . PHP_EOL;
echo FoolishPureStatus::New::canExecuteStaticFunctions(); # Yes

echo 'Execute good trait static function from direct enum:' . PHP_EOL;
echo FoolishPureStatus::staticTraitFunction(); # Yes

echo 'Execute good trait static function from enum case:' . PHP_EOL;
echo $statusOne::staticTraitFunction(); # Yes

echo 'Execute good trait function from enum:' . PHP_EOL;
var_dump($statusOne->getNextAvailable() === [FoolishPureStatus::ShopQuestion, FoolishPureStatus::ShopQuestion]);
# bool(true)

# ToDo: WIP reflection and compare with backed / unit / string / int

echo 'Declare enum with bad trait:' . PHP_EOL;
echo 'It is last alive message.' . PHP_EOL;

# Can't be caught
# Fatal error: Enum "FoolishFatalEnum" may not include properties in /app/Example/basic.php on line 87
try {
    enum FoolishFatalEnum
    {
        use FoolishBadTraitWithProps;
    }
} catch (Throwable) {
}
echo 'Useless never echo. Dead code' . PHP_EOL;

# Uncomment next 5 lines here without replace for never start script
//enum FoolishEnumWithProps
//{
//    public $a;
//    public static $b;
//}

trait FoolishBadTraitWithProps
{
    public string $any;
    public static string $some;
}

trait NextFoolishStatus
{
    function getNextAvailable(): ?array
    {
        return match ($this) {
            FoolishPureStatus::New => [FoolishPureStatus::ShopQuestion, FoolishPureStatus::ShopQuestion],
            FoolishPureStatus::ShopQuestion, FoolishPureStatus::ClientQuestion => [FoolishPureStatus::Agreed],
            FoolishPureStatus::Agreed => [FoolishPureStatus::Completed],
            FoolishPureStatus::Completed => [FoolishPureStatus::Ready],
            FoolishPureStatus::Ready => [FoolishPureStatus::Delivery],
            FoolishPureStatus::Delivery => [FoolishPureStatus::Executed, FoolishPureStatus::Returned],
            FoolishPureStatus::Executed, FoolishPureStatus::Returned => null,
            default => throw new TypeError('Usage of getNextAvailable allow only for NextStatus'),
        };
    }

    public static function staticTraitFunction(): string
    {
        return 'Yes' . PHP_EOL;
    }
}
```

</details>

# EnumExtension usage
WIP

# Contribution
WIP

# Gift
<details>
<summary>Kitty</summary>

[![Present][777]][777]

[777]: https://i.stack.imgur.com/AKtls.jpg

</details>
