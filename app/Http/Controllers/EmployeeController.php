<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::latest();

        if (request('search')) {
            $employee->where('name', 'like', '%' . request('search') . '%')
                ->orwhere('email', 'like', '%' . request('search') . '%');
        }

        return view('dashboard.employee', [
            "title" => "Employee",
            "active" => "employee",
            "employee" => $employee->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/employee_insert', [
            'title' => 'Employee',
            'company' => Company::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email:rfc,dns'],
        ]);

        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->company_id = $request->input('company');

        $employee->save();
        return redirect('/employee');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('/dashboard/employee_edit', [
            "title" => "title",
            "company" => Company::all()
        ], compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('employees')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'company_id' => $request->company
            ]
        );
        
        return redirect('/employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('employees')->where('id', '=', $id)->delete();
        return redirect('/employee');
    }
}
