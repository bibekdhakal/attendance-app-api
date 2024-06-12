<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('administrators.unit.index', ['units' => $units]);
    }

    public function create()
    {
        return view('administrators.unit.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'unit_name' => 'required|string',
        ]);

        Unit::create(['unit_name' => $request->get('unit_name')]);
        return back()->with('success', 'Unit is created successfully');
    }

    public function show($id)
    {
    }
}
