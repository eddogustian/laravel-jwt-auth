<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EmployeesController extends Controller
{
    public function __construct() {
        $this->middleware('jwt-auth');
    }

    public function index() {
        $data['status'] = true;
        $data['employees'] = Employee::all();
        return response()->json(compact( 'data'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:employees',
                'phone' => 'required|numeric',
                'emp_id' => 'required|numeric',
                'company' => 'required | string',
                'location' => 'required | string',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'fail', 'message' => $validator->errors()->all()]);
            } else {
                $data = $request->All();
                Employee::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'emp_id' => $data['emp_id'],
                    'company' => $data['company'],
                    'location' => $data['location'],
                ]);
                return response()->json(array('status' => true, 'msg' => 'Successfully Created'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_create_employee'), 500);
        }
    }

    public function show($id)
    {
        try {
            $employee = Employee::where('id', $id)->first();
            if ($employee != null) {
                return response()->json(array('status' => true, 'employee' => $employee), 200);
            } else {
                return response()->json(array('message' => 'employee_not_found'), 200);
            }
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_create_employee'), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::where('id', $id)->first();
            $data = $request->All();
            if ($employee != null) {
                Employee::where('id', $id)->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'emp_id' => $data['emp_id'],
                    'company' => $data['company'],
                    'location' => $data['location'],
                ]);
            } else {
                return response()->json(array('message' => 'employee_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'updated_employee'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_update_employee'), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::where('id', $id)->first();
            if ($employee != null) {
                Employee::where('id', $id)->delete();
            } else {
                return response()->json(array('message' => 'employee_not_found'), 200);
            }
            return response()->json(array('status' => true, 'message' => 'employee_deleted'), 200);
        } catch (\Exception $e) {
            return response()->json(array('message' => 'could_not_update_employee'), 500);
        }
    }
}
