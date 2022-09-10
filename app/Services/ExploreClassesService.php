<?php

namespace App\Services;

use App\Enums\WeekdayConversion;
use App\Models\ClassModel;
use App\Models\Image;
use App\Models\Major;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExploreClassesService
{
    private array $search;
    private string $search_major_name;
    private string $search_teacher_name;
    private string $search_weekday;
    private string $search_time;

    public function __construct(array $search)
    {
        $this->search = $search;
        $this->search_major_name = $this->search['major_name'] ?? '';
        $this->search_teacher_name = $this->search['teacher_name'] ?? '';
        $this->search_weekday = $this->search['weekday'] ?? '';
        $this->search_time = $this->search['time'] ?? '';
    }

    public function explore(): Collection
    {
        return $subjects = Major::select(
            'major_id',
            'majors.name as major_name',
            'classes_count',
            'ms.subject_id',
            's.name as subject_name',
            'source as image_source',
        )
            ->when(
                !empty($this->search_major_name),
                fn ($q) => $q->where('majors.name', 'like', "%{$this->search_major_name}%")
            )
            ->join('major_subjects as ms', 'majors.id', '=', 'ms.major_id')
            ->joinSub(
                Subject::select('subjects.id', 'subjects.name', 'subjects.image_id'),
                's',
                fn ($j) => $j->on('ms.subject_id', '=', 's.id')
            )
            ->joinSub(
                ClassModel::select(
                    DB::raw("count(classes.subject_id) as classes_count"),
                    'classes.subject_id'
                )
                    ->when(
                        !empty(getName()),
                        fn ($w) => $w
                            ->whereNotExists(
                                fn ($q) =>
                                $q->select('class_id')
                                    ->from('subscriptions')
                                    ->where('student_id', getAccount()->id)
                            )
                    )
                    ->where('classes.status', '=', 1)
                    ->groupBy('classes.subject_id'),
                'classes',
                fn ($j) => $j->on('s.id', '=', 'classes.subject_id')
            )
            ->joinSub(
                Image::select('images.id', 'images.source'),
                'images',
                fn ($j) => $j->on('images.id', '=', 's.image_id')
            )
            ->orderBy('major_id')
            ->get()
            ->groupBy('major_name');
    }

    public function showClass(int $subject_id)
    {
        return ClassModel::select('class_id', 'classes.name as classes_name', 'teachers.name as teacher_name', 'teacher_id')
            ->where('subject_id', $subject_id)
            ->where('status', 1)
            ->joinSub(
                User::select('users.id', 'users.name')
                    ->when(
                        !empty($this->search_teacher_name),
                        fn ($q) => $q->where('users.name', 'like', "%{$this->search_teacher_name}%")
                    )
                    ->where('users.role', 1),
                'teachers',
                fn ($j) => $j->on('teachers.id', '=', 'classes.teacher_id')
            )
            ->joinSub(
                Schedule::select('schedule.id', 'schedule.class_id')
                    ->when(
                        ($this->search_weekday != '' && !empty($this->search_time)),
                        fn ($q) => $q->where(DB::raw('WEEKDAY(schedule.date)'), '=', $this->CarbontoMySQL($this->search_weekday))
                            ->where('schedule.start_time', '=', $this->search_time)
                    )
                    ->where('schedule.period', '=', 1),
                'schedule',
                fn ($j) => $j->on('schedule.class_id', '=', 'classes.id')
            )
            ->get();
    }

    public static function CarbontoMySQL(int $Carbon_weekday)
    {
        $ISO_weekday =  WeekdayConversion::CarbontoIso($Carbon_weekday);
        return WeekdayConversion::IsotoMySql($ISO_weekday);
    }
}