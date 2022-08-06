<?php

namespace App\Contracts;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Collection;

interface GetClassesInterface
{
    public function getClasses(): Collection;

    public function getOneClass(int|ClassModel $class_id): ClassModel;
}