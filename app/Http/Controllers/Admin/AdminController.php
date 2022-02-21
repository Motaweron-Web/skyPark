<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{

    public function index(request $request)
    {
        if($request->ajax()) {
            $admins = Admin::latest()->get();
            return Datatables::of($admins)
                ->addColumn('action', function ($admins) {
                    return '
                            <button class="btn btn-pill btn-primary-light" data-toggle="modal" data-target="#edit_modal"
                                    data-id="' . $admins->id . '" data-name="' . $admins->name . '" data-email="' . $admins->email . '">
                                    <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $admins->id . '" data-title="' . $admins->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('created_at', function ($admins) {
                    return '' . $admins->created_at->diffForHumans();
                })
                ->editColumn('photo', function ($admins) {
                    return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="'.get_user_photo($admins->photo).'">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/admin/index');
        }
    }



    public function saveProfile(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (auth()->guard('admin')->user()->email != $request->email) {
            $data = Validator::make($request->all(), [
                'email' => ['unique:admins'],
            ]);
            if ($data->fails()) {
                return back()->with(notification('هذا البريد الإلكترونى موجود مسبقا', 'warning'));
            }
        }
        $update = Admin::find(auth()->guard('admin')->user()->id);
        $update->name = $request->name;
        $update->email = $request->email;
        if (isset($request->password)) {
            $update->password = Hash::make($request->password);
        }
        $update->save();
        return back()->with(notification('تم التعديل', 'info'));
    }

    public function myProfile()
    {
        $admin = auth()->guard('admin')->user();
        return view('Admin/admin/profile',compact('admin'));
    }
}
