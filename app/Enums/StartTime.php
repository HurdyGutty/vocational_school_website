<?php
 
namespace App\Enums;
 
enum StartTime: int
{
    case firstSlot = 1;
    case secondSlot = 2;

    public function showRole(): string
    {
        return match ($this){
            self::firstSlot => '17:00:00',
            self::secondSlot => "19:00:00",
        };
    }
    public static function showValue()
    {
        $arr = [];
        foreach(self::cases() as $case)
        {
            $arr[] = $case->value;
        }
        return $arr;
    }
}