<?php

namespace App\Enums;

enum ClassStatus: int
{
    case Pending = 0;
    case Waiting = 1;
    case Started = 2;
    case End = 3;

    public function showRole(): string
    {
        return match ($this){
            self::Pending => 'Chờ duyệt',
            self::Waiting => "Chưa đủ số lượng",
            self::Started => "Đã mở",
            self::End => "Kết thúc",
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
