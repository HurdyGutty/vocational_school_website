<?php
 
namespace App\Enums;
 
enum AdminRoles: int
{
    case Counselor = 0;
    case Admin = 1;

    public function showRole(): string
    {
        return match ($this){
            self::Counselor => 'Tư vấn viên',
            self::Admin => "Quản lý",
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