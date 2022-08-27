<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Class\ClassAcceptRequest;
use App\Http\Requests\Class\DeleteSubscription;
use App\Http\Requests\Class\SubscriptionApproveRequest;
use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\Subscription;
use App\Services\CreateClassAndScheduleForAdminService;
use App\Services\GetClassAdminService;
use App\Traits\Paginatable;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ClassController extends Controller
{
    use Paginatable;
    public function awaitingClasses()
    {
        $awaiting_classes = (new GetClassAdminService)->getAwaitingClasses();
        $paginator = $this->paginate($awaiting_classes, 6);

        return view(
            'classes.create.awaiting',
            [
                'awaiting_classes' => $paginator,
            ]
        );
    }

    public function accepted(ClassAcceptRequest $request)
    {
        $accepted = $request->validated();
        $class_id = (int)$accepted['class_id'];
        $period = (int)$accepted['period'];

        try {
            DB::Transaction(function () use ($class_id, $period) {
                (new CreateClassAndScheduleForAdminService())
                    ->setCondition($class_id, $period)
                    ->updateSchedule()
                    ->updateClassStatus();
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.awaitingClasses')->with([
                'updateErrorMessage' => 'Chưa cập nhật lớp',
            ]);
        }
        return redirect()->route('admin.class.awaitingClasses')->with([
            'successMessage' => 'Thành công'
        ]);;
    }

    public function denied(DeleteSubscription $request, $class_id)
    {
        try {
            DB::Transaction(function () use ($class_id) {
                Schedule::where('class_id', $class_id)->delete();
                ClassModel::where('id', $class_id)->delete();
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.awaitingClasses')->with([
                'deleteErrorMessage' => 'Chưa xoá được lớp',
            ]);
        }

        return redirect()->route('admin.class.awaitingClasses')->with([
            'successMessage' => 'Thành công'
        ]);
    }

    public function index()
    {
        $classes = (new GetClassAdminService)->getClasses();

        $paginator = $this->paginate($classes, 6);

        return view('classes.index', [
            'classes' => $paginator,
        ]);
    }

    public function show(ClassModel $class)
    {
        $class_info = (new GetClassAdminService)->getOneClass($class);
        return view('classes.show', [
            'class_info' => $class_info,
        ]);
    }

    public function create()
    {
    }
    public function store()
    {
    }

    public function pendingSubscription()
    {
        $pending_classes = ClassModel::with(
            [
                'students' => fn ($q) => $q->select('id', 'name')
                    ->whereIn('id', fn ($q) => $q->select('student_id')->from('subscriptions')->whereNull('admin_id'))
            ]
        )->with(
            [
                'subscriptions' => fn ($q) => $q->select('class_id', 'register_time')->whereNull('admin_id')
            ]
        )
            ->whereIn('id', fn ($q) => $q->select('class_id')->from('subscriptions')->whereNull('admin_id'))
            ->paginate(15);
        return view('classes.subscription.pending', [
            'pending_classes' => $pending_classes
        ]);
    }

    public function approveSubscription(SubscriptionApproveRequest $request)
    {
        $subscription = $request->validated();
        try {
            DB::Transaction(function () use ($subscription) {
                Subscription::where('student_id', $subscription['student_id'])
                    ->where('class_id', $subscription['class_id'])
                    ->update(['admin_id' => getAccount()->id]);
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.pendingSubscription')->with([
                'updateErrorMessage' => 'Lỗi khi duyệt đơn',
            ]);
        }

        return redirect()->route('admin.class.pendingSubscription')->with([
            'successMessage' => 'Thành công'
        ]);
    }

    public function deleteSubscription(DeleteSubscription $request, $class_id, $student_id)
    {
        try {
            DB::Transaction(function () use ($class_id, $student_id) {
                Subscription::where('class_id', $class_id)->where('student_id', $student_id)->delete();
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.pendingSubscription')->with([
                'deleteErrorMessage' => 'Chưa huỷ được đơn',
            ]);
        }
        return redirect()->route('admin.class.pendingSubscription')->with([
            'successMessage' => 'Thành công'
        ]);
    }
}