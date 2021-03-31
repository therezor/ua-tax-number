<?php

declare(strict_types=1);

namespace TheRezor\UaTaxNumber;

use DateTime;

class Decoder
{
    public const INN_PATTERN = '/^\d{10}$/';
    public const INN_MIN_DATE = '1900-01-01';
    public const INN_MULTIPLIERS = [
        -1,
        5,
        7,
        9,
        4,
        6,
        10,
        5,
        7,
    ];
    public const INN_GENDER_MALE = 'male';
    public const INN_GENDER_FEMALE = 'female';

    public static function isValid(string $inn): bool
    {
        return static::isMatch($inn) && static::isValidChecksum($inn);
    }

    public static function gender(string $inn): string
    {
        if (!static::isMatch($inn)) {
            throw new InvalidInnException("Inn is not parsable");
        }

        return ($inn[8] % 2)
            ? static::INN_GENDER_MALE
            : static::INN_GENDER_FEMALE;
    }

    public static function birthDate(string $inn): DateTime
    {
        if (!static::isMatch($inn)) {
            throw new InvalidInnException("Inn is not parsable");
        }

        $days = substr($inn, 0, 5) - 1;

        return (new DateTime(static::INN_MIN_DATE))->modify("+{$days} days");
    }

    public static function age(string $inn): int
    {
        $from = static::birthDate($inn);
        $to = new DateTime('today');

        return $from->diff($to)->y;
    }

    protected static function isMatch(string $inn): bool
    {
        return (bool)preg_match(static::INN_PATTERN, $inn);
    }

    protected static function isValidChecksum(string $inn): bool
    {
        $count = count(static::INN_MULTIPLIERS);

        for ($i = 0, $controlSum = 0; $i < $count; $i++) {
            $controlSum += $inn[$i] * static::INN_MULTIPLIERS[$i];
        }

        $control = substr((string)($controlSum - (11 * (int)($controlSum / 11))), -1);

        return $control === $inn[9];
    }
}