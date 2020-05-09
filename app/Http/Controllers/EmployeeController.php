<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function showAllEmployees()
    {
        return response()->json(Employee::all());
    }

    public function showOneEmployee($id)
    {
        return response()->json(Employee::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'region' => 'required|alpha'
        ]);

        $author = Employee::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Employee::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}