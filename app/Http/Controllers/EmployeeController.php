<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Practice;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * show all employees
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        $items = $employees->getCollection();
        
        //add practice name
        foreach($items as $key => $item)
        {
            $items[$key]->practice_name = $item->practice->name;
        }
        $employees->setCollection($items);

        return Inertia::render(
            'Employee/Index',
            [
                'employees' => $employees
            ]
        );
    }


    /**
     * add new employee
     */
    public function create()
    {
        $practices = Practice::all();

        return Inertia::render(
            'Employee/Create',
            [
                'practices' => $practices
            ]
        );
    }

    /**
     * save new employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'nullable|email|unique:employees',
            'practice_id' => 'required',
        ],[
            'fname.required' => 'The first name field is required.',
            'lname.required' => 'The last name field is required.',
            'practice_id.required' => 'Practice is required.'
        ]);


        Employee::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'practice_id' => $request->practice_id,
        ]);

        return redirect()->route('employees.index');
    }

    /**
     * edit employee
     */
    public function edit(Employee $employee)
    {
        $practices = Practice::all();
        return Inertia::render(
            'Employee/Edit',
            [
                'employee' => $employee,
                'practices' => $practices,
            ]
        );
    }

    /**
     * Update the employee
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'nullable|email|unique:employees,email,'.$employee->id,
            'practice_id' => 'required',
        ]);

        $employee->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'practice_id' => $request->practice_id,
        ]);

        return redirect()->route('employees.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
