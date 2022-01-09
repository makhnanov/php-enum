<?php /** @noinspection PhpExpressionResultUnusedInspection */

declare(strict_types=1);

use Makhnanov\PhpEnum\EnumExtension;

require_once __DIR__ . '/../vendor/autoload.php';

enum FoolishStatus
{
    use EnumExtension;

    case new;
    case old;

    case in_analytics;
    case in_design;
    case in_develop;
    case in_qa;

    case finished;
}

echo 'tryByName existed' . PHP_EOL;
var_dump(FoolishStatus::tryByName('new') === FoolishStatus::new);

echo 'tryByName not existed return null' . PHP_EOL;
var_dump(is_null(FoolishStatus::tryByName('not_existed')));

echo 'byName existed' . PHP_EOL;
var_dump(FoolishStatus::byName('finished') === FoolishStatus::finished);

echo 'byName not existed throw error' . PHP_EOL;
try {
    FoolishStatus::byName('not_existed');
    die;
} catch (Error $e) {
    echo get_class($e) . ' throw and can be caught' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}

echo 'isEqual or assert alias for compare:' . PHP_EOL;
var_dump(FoolishStatus::new->isEqual(FoolishStatus::new) === true);
var_dump(FoolishStatus::new->assert(FoolishStatus::new) === true);
var_dump(FoolishStatus::new->isEqual(FoolishStatus::finished) === false);

echo 'Check existence:' . PHP_EOL;
var_dump(FoolishStatus::exist(FoolishStatus::class, 'in_develop') === true);
var_dump(FoolishStatus::exist(FoolishStatus::class, 'near_develop') === false);

echo 'For match isInArray function:' . PHP_EOL;
$enum = FoolishStatus::cases()[rand(0, FoolishStatus::casesCount() - 1)];
echo match ($enum) {
    $enum->isInArray([FoolishStatus::new, FoolishStatus::old]) => 'initial',
    $enum->isInArray([
        FoolishStatus::in_analytics,
        FoolishStatus::in_design,
        FoolishStatus::in_develop,
        FoolishStatus::in_qa,
    ]) => 'in progress',
    $enum->isInArray([FoolishStatus::finished]) => 'finished',
} . PHP_EOL;

// ToDo: other cases
