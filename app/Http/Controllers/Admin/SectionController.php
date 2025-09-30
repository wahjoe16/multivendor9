<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function viewSections()
    {
        $data = Section::get();
        return view('admin.sections.view_sections', compact('data'));
    }

    public function createEditSection(Request $request, $id=null)
    {
        if ($id=="") {
            // Add Section
            $title = "Create New Section";
            $section = new Section;
            $message = "Section has been created successfully!";
        } else {
            // Edit Section
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Section has been updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $this->validate($request, [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
            ], [
                'name.required' => 'Section Name is required',
                'name.regex' => 'Valid Section Name is required',
            ]);
            
            $section->name = $data['name'];
            $section->status = 1;
            $section->save();

            return redirect()->route('sections.view')->with('success_message', $message);
        }

        return view('admin.sections.create_edit_section', compact('title', 'section'));
    }

    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();
        $message = "Section has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }
}
