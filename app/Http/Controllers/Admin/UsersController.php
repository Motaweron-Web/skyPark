<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    use PhotoTrait;

    public function index(request $request)
    {
        if ($request->ajax()) {
            $users = User::latest()->get();
            return Datatables::of($users)
                ->addColumn('action', function ($users) {
                    return '
                            <button type="button" data-id="' . $users->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $users->id . '" data-title="' . $users->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('created_at', function ($users) {
                    return $users->created_at->diffForHumans();
                })
                ->editColumn('photo', function ($users) {
                    return '
                    <img alt="image" class="avatar avatar-md rounded-circle" src="' . get_user_photo($users->photo) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('Admin/users/index');
        }
    }


    public function delete(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        if (file_exists($users->photo)) {
            unlink($users->photo);
        }
        $users->delete();
        return response(['message' => 'Data Deleted Successfully', 'status' => 200], 200);
    }

    public function create()
    {
        return view('Admin/users.parts.create');
    }

    public function store(request $request): \Illuminate\Http\JsonResponse
    {
        $inputs = $request->validate([
            'user_name' => 'required|unique:users',
            'name'      => 'required',
            'password'  => 'required|min:6',
            'photo'     => 'nullable',
        ]);
        if ($request->has('photo')) {
            $file_name = $this->saveImage($request->photo, 'assets/uploads/users');
            $inputs['photo'] = 'assets/uploads/users/' . $file_name;
        }
        $inputs['password'] = Hash::make($request->password);
        if (User::create($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }

    public function edit(User $user)
    {
        return view('Admin/users.parts.edit', compact('user'));
    }

    public function update(request $request)
    {
        $inputs = $request->validate([
            'id'        => 'required|exists:users,id',
            'user_name' => 'required|unique:users,user_name,' . $request->id,
            'name'      => 'required',
            'password'  => 'nullable|min:6',
            'photo'     => 'nullable',
        ]);
        if ($request->has('photo')) {
            $file_name = $this->saveImage($request->photo, 'assets/uploads/users');
            $inputs['photo'] = 'assets/uploads/users/' . $file_name;
        }
        if ($request->has('password'))
            $inputs['password'] = Hash::make($request->password);
        $user = User::findOrFail($request->id);
        if ($user->update($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }
}
