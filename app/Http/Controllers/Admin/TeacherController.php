<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interface\AccountInterface;
use App\Models\User;
use App\Services\AccountService\TeacherAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TeacherController extends Controller
{

    protected $accountService;
    protected $is_admin;
    protected $role;
    public function __construct()
    {
        $this->is_admin = false;
        $this->role = 1;
        $this->accountService = new TeacherAccount($this->is_admin, $this->role);
    }

    public function index()
    {
        $teachers = $this->accountService->getAccounts();

        return view('account.teacher', [
            'teachers' => $teachers,
        ]);
    }

    public function show(int $teacher)
    {
        try {
            DB::transaction(function () use (&$teacher) {
                $teacher = $this->accountService->getOneAccount($teacher)->toArray();
            });
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tài khoản',
            ]);
        }
        return response()->json($teacher, 200);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function lock(User $teacher)
    {
        try {
            DB::transaction(function () use ($teacher) {
                $this->accountService->lockAccount($teacher);
            });
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi khoá tài khoản',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tài khoản đã khoá',
        ]);
    }

    public function unlock(User $teacher)
    {
        try {
            DB::transaction(function () use ($teacher) {
                $this->accountService->unlockAccount($teacher);
            });
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi mở tài khoản',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tài khoản đã mở',
        ]);
    }
}