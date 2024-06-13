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

    public function edit($id)
    {
        $unit  = Unit::findOrFail($id);
        return view('administrators.unit.edit', ['unit' => $unit]);
    }

    public function update(Request $request, $id)
    {
        $unit  = Unit::findOrFail($id);
        $unit->unit_name = $request->get('unit_name');
        $unit->save();

        return back()->with('success', 'Unit is updated successfully');
    }
}
