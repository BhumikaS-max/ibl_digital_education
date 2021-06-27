<?php

namespace App\Http\Controllers;

use App\User;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TeacherController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role','teacher')->orderBy('created_at','desc')->get();
            if ($data) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $html = '<div class="view_delete_edit">
                                    <i class="fa fa-edit edit_btn" aria-hidden="true" id="btnEdit" data-id="' . $row['id'] . '"></i>
                                 <i id="btnDelete"  data-id="' . $row['id'] . '" class="fa fa-trash delete_btn"></i>
                                 </div>';

                        return $html;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        return view('teacher');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $id = $request->get('id');

        $todayDate = date('m/d/Y');
        $rules = [
            'full_name' => 'required',
            'email' => 'required|email',
            'gender' => 'required|in:Male,Female',
            'date_of_join' => 'required|before_or_equal:'.$todayDate,
        ];
        if ($id) {
            $rules = array_merge($rules, [
                'id' => 'required|integer',
            ]);
        }
        if (empty($id)) {
            $rules = array_merge($rules, [
                'password' => 'required|min:6|max:10',
            ]);
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->respondWithError($errors[0], 200);
        }

        $requestData['unique_id'] = uniqid('teacher_');
        $requestData['role'] = 'teacher';
        if ($requestData['id']) {
            $requestData['password'] = $requestData['hide_password'];
        } else {
            $requestData['password'] = bcrypt($requestData['password']);
        }

        $dbRecord = '';
        if ($id) {
            $dbRecord = User::find($id);
        }

        if (!$dbRecord) {
            $dbRecord = new User();
        }

        $dbRecord->fill($requestData);
        $dbRecord->save();
        return $this->respondWithSuccess('Record Saved Successfully');
    }

    public function edit($id)
    {
        try {
            $dbRecord = User::find($id);
            return $dbRecord;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $dbRecord = User::find($id);
            $dbRecord->delete();
            return $this->respondWithSuccess('Record Deleted Successfully');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
