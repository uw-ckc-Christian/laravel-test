<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = Employee::with('company')->latest()->paginate(5);

        return view('employees')->with( 'employees', $employees )->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $companies = (new Company)->orderBy('name', 'ASC')->get();

        return view('dashboard.employeeCreate', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $request->validate( array(
            'first_name' => 'required', 'last_name' => 'required', 'company_id' => 'nullable',
            'email' => 'nullable|email:filter', 'phone' => 'nullable|string')
        );

        $emp = (new Employee)->create( $request->all() );

        return redirect('/employees')->with('success', 'Dodano pracownika.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $employee = (new Employee)::with('company')->get()->find( $id );

        return view('dashboard.employeeShow', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit( Employee $employee ) {
        $companies = (new Company)->orderBy('name', 'ASC')->get();

        return view('dashboard.employeeEdit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id) {
    public function update( Request $request, Employee $employee ) {
        $request->validate( array(
            'first_name' => 'required', 'last_name' => 'required', 'company_id' => 'nullable',
            'email' => 'nullable|email:filter', 'phone' => 'nullable|string')
        );

        $employee->update( $request->all() );

        return back()->with('success', 'Zapisano zmiany.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id) {
    public function destroy( Employee $employee ) {
        $employee->delete();

        return redirect('/employees')->with('success', 'Usunięto pracownika.');
    }
}
