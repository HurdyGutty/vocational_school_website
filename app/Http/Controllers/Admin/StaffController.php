<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\AccountService\StaffAccount;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    protected $accountService;
    protected $is_admin;
    protected $role;

    public function __construct()
    {
        $this->is_admin = true;
        $this->role = 0;
        $this->accountService = new StaffAccount($this->is_admin, $this->role);
    }

    public function index()
    {
        $staffs = $this->accountService->getAccounts();

        return view('account.staff', [
            'staffs' => $staffs,
        ]);
    }

    public function show(int $staff)
    {
        try {
            DB::transaction(function () use (&$staff) {
                $staff = $this->accountService->getOneAccount($staff)->toArray();
            });
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy tài khoản',
            ]);
        }
        return response()->json($staff, 200);
    }



    public function create()
    {
    }

    public function store()
    {
    }

    public function lock(Admin $staff)
    {
        try {
            DB::transaction(function () use ($staff) {
                $this->accountService->lockAccount($staff);
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

    public function unlock(Admin $staff)
    {
        try {
            DB::transaction(function () use ($staff) {
                $this->accountService->unlockAccount($staff);
            });
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi khoá tài khoản',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tài khoản đã mở',
        ]);
    }
}