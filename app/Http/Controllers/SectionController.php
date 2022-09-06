<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::get();
        return view('sections.index', compact('sections'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

        $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required'
        ], [
            'section_name.required' => 'Section name can\'t be empty',
            'section_name.unique' => 'Section name already exsist',
            'description.required' => 'Please write description for this section'
        ]);

        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::user()->name)
        ]);

        session()->flash('Add', 'Section Added Successfully');
        return redirect('/sections');

    }


    public function show(Section $section)
    {

    }


    public function edit(Section $section)
    {

    }


    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'section_name' => 'required|max:255|unique:sections,section_name,'. $id,
            'description' => 'required'
        ],[
            'section_name.required' => 'Section name can\'t be empty',
            'section_name.unique' => 'Section name already exsist',
            'description.required' => 'Please write description for this section'
        ]);

        $section = Section::findorFail($id);

        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description
        ]);

        session()->flash('Edit', 'Section Updated Successfully');
        return redirect('/sections');

    }


    public function destroy(Request $request)
    {
        $id = $request->id;

        Section::findorFail($id)->delete();

        session()->flash('Delete', 'Section Deleted');
        return redirect('/sections');
    }
}
