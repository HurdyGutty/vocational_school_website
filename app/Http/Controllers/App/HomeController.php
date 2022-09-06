<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Explore\ClassSearchRequest;
use App\Http\Requests\Explore\SearchRequest;
use App\Models\Admin;
use App\Models\Subject;
use App\Models\User;
use App\Services\ExploreClassesService;
use App\Services\ShowAccountService\ShowStaff;
use App\Services\ShowAccountService\ShowTeacher;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('landing.index');
    }
    public function explore(SearchRequest $request): View
    {
        $request->flash();
        $search = $request->validated();

        $majors = (new ExploreClassesService($search))->explore();

        return view('explore.explore', [
            'majors' => $majors,
        ]);
    }

    public function showClass(Subject $subject, ClassSearchRequest $request): View
    {
        $request->flash();
        $search = $request->validated();
        if (isset($search['time'])) {
            $search['time'] = ($search['time'] == 1 ? '17:00:00' : '19:00:00');
        };
        $classes = (new ExploreClassesService($search))->showClass($subject->id);
        return view('explore.showClass', [
            'classes' => $classes,
            'subject' => $subject,
        ]);
    }

    public function showTeacher(User $teacher)
    {

        try {
            $teacher = (new ShowTeacher())->show($teacher->id);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa hiện được thông tin',
            ]);
        }
        return response()->json($teacher, 200);
    }

    public function showStaff(Admin $staff)
    {

        try {
            $teacher = (new ShowStaff())->show($staff->id);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Chưa hiện được thông tin',
            ]);
        }
        return response()->json($teacher, 200);
    }
}