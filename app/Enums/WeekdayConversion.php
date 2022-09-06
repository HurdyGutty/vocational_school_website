<?php

namespace App\Enums;

enum WeekdayConversion: int
{
        //ISO Weekday
    case Monday = 1;
    case Tuesday = 2;
    case Wednesday = 3;
    case Thursday = 4;
    case Friday = 5;
    case Saturday = 6;
    case Sunday = 7;

    public function showIsoWeekday(): string
    {
        return match ($this) {
            self::Monday => 'Thứ hai',
            self::Tuesday => "Thứ ba",
            self::Wednesday => "Thứ tư",
            self::Thursday => "Thứ năm",
            self::Friday => "Thứ sáu",
            self::Saturday => "Thứ bảy",
            self::Sunday => "Chủ nhật",
        };
    }

    public static function MySQLtoIso(int $weekday): int
    {
        return $weekday + 1;
    }
    public static function IsotoMySQL(int $weekday): int
    {
        return $weekday - 1;
    }

    public static function CarbontoIso(int $weekday): int
    {
        return ($weekday == 0 ? 7 : $weekday);
    }

    public static function IsotoCarbon(int $weekday): int
    {
        return ($weekday == 7 ? 0 : $weekday);
    }

    public static function showValue()
    {
        $arr = [];
        foreach (self::cases() as $case) {
            $arr[] = $case->value;
        }
        return $arr;
    }
}