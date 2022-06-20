<?php
 
namespace App\Enums;
 
enum UserRoles: int
{
    case Student = 0;
    case Teacher = 1;

    public function showRole(): string
    {
        return match ($this){
            self::Student => 'Học viên',
            self::Teacher => "Giáo viên",
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