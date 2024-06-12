<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::all();
        return view('administrators.campus.index', ['campuses' => $campuses]);
    }

    public function create()
    {
        return view('administrators.campus.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'campus_name' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        Campus::create([
            'campus_name' => $request->get('campus_name'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude')
        ]);
        return back()->with('success', 'Campus is created successfully');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $campus = Campus::findOrFail($id);
        return view('administrators.campus.edit', ['campus' => $campus]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'campus_name' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $campus = Campus::findOrFail($id);
        $campus->campus_name = $request->get('campus_name');
        $campus->latitude = $request->get('latitude');
        $campus->longitude = $request->get('longitude');
        $campus->save();

        return back()->with('success', 'Campus is updated successfully');
    }
}
