<?php
 
namespace App\Enums;
 
enum ClassesStatus: int
{
    case Empty = 0;
    case Waiting = 1;
    case Started = 2;
    case Ended = 3;

    public function showRole(): string
    {
        return match ($this){
            self::Empty => 'Lớp trống',
            self::Waiting => "Chưa đủ số lượng",
            self::Started => "Đã mở",
            self::Ended => "Kết thúc",
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