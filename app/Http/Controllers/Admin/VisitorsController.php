<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShiftDetails;
use App\Models\Shifts;
use App\Models\VisitorTypes;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VisitorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminPermission:Master');
    }

    use PhotoTrait;
    public function index(request $request)
    {
        if($request->ajax()) {
            $visitors = VisitorTypes::latest()->get();
            return Datatables::of($visitors)
                ->addColumn('action', function ($visitors) {
                    return '
                            <button type="button" data-id="' . $visitors->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $visitors->id . '" data-title="' . $visitors->title . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('photo', function ($visitors) {
                    return '
                    <img alt="Visitor" onclick="window.open(this.src)" style="cursor:pointer" class="avatar avatar-lg bradius cover-image" src="'.get_user_photo($visitors->photo).'">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('Admin/visitors/index');
        }
    }


    public function create()
    {
        $shifts = Shifts::all();
        return view('Admin/visitors.parts.create',compact('shifts'));
    }

    public function store(request $request)
    {
        $inputs = $request->validate([
            'photo'      => 'required|mimes:jpeg,jpg,png,gif',
            'title'      => 'required|max:255',
        ]);
        if($request->has('photo')){
            $file_name = $this->saveImage($request->photo,'assets/uploads/visitors');
            $inputs['photo'] = 'assets/uploads/visitors/'.$file_name;
        }
        $visitor = VisitorTypes::create($inputs);
        if($visitor){
            for($i = 0 ; $i < count($request->shifts_id); $i++){
                ShiftDetails::create([
                    'visitor_type_id' => $visitor->id,
                    'shift_id' => $request->shifts_id[$i],
                    'price'    => $request->price[$i],
                ]);
            }
            return response()->json(['status'=>200]);
        }
        else
            return response()->json(['status'=>405]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $visitor = VisitorTypes::findOrFail($id);
        $details = ShiftDetails::where('visitor_type_id',$id)->get();
        return view('Admin/visitors.parts.edit',compact('visitor','details'));
    }



    public function update(Request $request)
    {
        $inputs = $request->validate([
            'id'         => 'required',
            'photo'      => 'nullable|mimes:jpeg,jpg,png,gif',
            'title'      => 'required|max:255',
        ]);
        if($request->has('photo') && $request->photo != null){
            $file_name = $this->saveImage($request->photo,'assets/uploads/visitors');
            $inputs['photo'] = 'assets/uploads/visitors/'.$file_name;
        }
        $visitor = VisitorTypes::findOrFail($request->id);
        if($visitor->update($inputs)){
            for($i = 0 ; $i < count($request->details_id); $i++){
                $shift_details = ShiftDetails::findOrFail($request->details_id[$i]);
                $shift_details->price = $request->price[$i];
                $shift_details->save();
            }
            return response()->json(['status'=>200]);
        }
        else
            return response()->json(['status'=>405]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(request $request)
    {
        $visitor = VisitorTypes::findOrFail($request->id);
        if(VisitorTypes::all()->count() > 1){
            if (file_exists($visitor->photo)) {
                unlink($visitor->photo);
            }
            $visitor->delete();
            return response(['message' => 'Data Deleted Successfully', 'status' => 200], 200);
        }else
            return response(['message' => 'At Least 1 Type Should Be Exist', 'status' => 405], 200);
    }
}
