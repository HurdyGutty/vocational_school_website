<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Class\ClassAcceptRequest;
use App\Http\Requests\Class\DeleteSubscription;
use App\Http\Requests\Class\RestoreSubscriptionRequest;
use App\Http\Requests\Class\SubscriptionApproveRequest;
use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\Subscription;
use App\Services\CheckScheduleService;
use App\Services\CreateClassAndScheduleForAdminService;
use App\Services\GetClassAdminService;
use App\Traits\Paginatable;
use Exception;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    use Paginatable;

    public function awaitingClasses()
    {
        $awaiting_classes = (new GetClassAdminService())->getAwaitingClasses();
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
        $class_id = (int) $accepted['class_id'];
        $period = (int) $accepted['period'];

        try {
            DB::Transaction(function () use ($class_id, $period) {
                (new CreateClassAndScheduleForAdminService())
                    ->setCondition($class_id, $period)
                    ->updateSchedule()
                    ->updateClassStatus()
                    ->updateClassDate();
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.awaitingClasses')->with([
                'updateErrorMessage' => 'Chưa cập nhật lớp',
            ]);
        }

        return redirect()->route('admin.class.awaitingClasses')->with([
            'successMessage' => 'Thành công',
        ]);
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
            'successMessage' => 'Thành công',
        ]);
    }

    public function index()
    {
        $classes = (new GetClassAdminService())->getClasses();

        $paginator = $this->paginate($classes, 6);

        return view('classes.index', [
            'classes' => $paginator,
        ]);
    }

    public function show(ClassModel $class)
    {
        $class_info = (new GetClassAdminService())->getOneClass($class);

        return view('classes.show', [
            'class_info' => $class_info,
        ]);
    }

    public function pendingSubscription()
    {
        $pending_classes = ClassModel::with(
            [
                'students' => fn ($q) => $q->select('id', 'name')
                    ->whereIn('id', fn ($q) => $q->select('student_id')->from('subscriptions')->whereNull('admin_id')),
            ]
        )->with(
            [
                'subscriptions' => fn ($q) => $q->select('class_id', 'register_time')->whereNull('admin_id'),
            ]
        )
            ->whereIn('id', fn ($q) => $q->select('class_id')->from('subscriptions')->whereNull('admin_id'))
            ->paginate(15);

        return view('classes.subscription.pending', [
            'pending_classes' => $pending_classes,
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
            'successMessage' => 'Thành công',
        ]);
    }

    public function deleteSubscription(DeleteSubscription $request, $class_id, $student_id)
    {
        try {
            DB::Transaction(function () use ($class_id, $student_id) {
                $subscription = Subscription::where('class_id', $class_id)->where('student_id', $student_id);
                $subscription->update(['admin_id' => getAccount()->id]);
                $subscription->delete();
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.pendingSubscription')->with([
                'deleteErrorMessage' => 'Chưa huỷ được đơn',
            ]);
        }

        return redirect()->route('admin.class.pendingSubscription')->with([
            'successMessage' => 'Thành công',
        ]);
    }

    public function subscriptionsHistory()
    {
        $subscriptions = Subscription::withTrashed()->whereNot([
            ['admin_id', null], ['deleted_at', null],
        ])
            ->when(
                getAccount()->is_admin && 0 == getAccount()->role,
                fn ($q) => $q->where('admin_id', getAccount()->id)
            )
            ->with(['class:id,name,date_start', 'student:id,name', 'admin:id,name'])
            ->paginate(15);

        return view('classes.subscription.history', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function restoreSubscription(RestoreSubscriptionRequest $request)
    {
        $validated = $request->validated();
        $class_id = $validated['class_id'];
        $student_id = $validated['student_id'];

        try {
            DB::Transaction(function () use ($class_id, $student_id) {
                $subscription = Subscription::where('class_id', $class_id)->where('student_id', $student_id);
                $subscription->update(['admin_id' => getAccount()->id]);
                $subscription->restore();
            });
        } catch (\Exception $ex) {
            return redirect()->route('admin.class.pendingSubscription')->with([
                'restoreErrorMessage' => 'Chưa khôi phục được đơn',
            ]);
        }

        return redirect()->route('admin.class.subscriptionsHistory')->with([
            'successMessage' => 'Thành công',
        ]);
    }

    public function checkSchedule(int $class_id, int $user_id, int $is_teacher)
    {
        try {
            $check = DB::Transaction(function () use ($class_id, $user_id, $is_teacher) {
                if ($is_teacher) {
                    return (new CheckScheduleService($class_id, $user_id))->checkTeacher();
                } else {
                    return (new CheckScheduleService($class_id, $user_id))->checkStudent();
                }
            });
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi kiểm tra',
            ], 400);
        }

        $checked = $check ? "Không trùng lịch" : "Trùng lịch";

        return response()->json([
            'status' => true,
            'checked' => $checked,
        ], 200);
    }
}