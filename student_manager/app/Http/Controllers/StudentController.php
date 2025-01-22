<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('marks')->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        Log::info('Request data:', $request->all());
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subjects' => 'required|array',
            'subjects.*' => 'required|string|max:255',
            'marks' => 'required|array',
            'marks.*' => 'required|integer|min:0|max:100',
        ]);
    
        Log::info('Validated data:', $validated);
    
        $student = new Student();
        $student->name = $validated['name'];
        $student->save();
    
        foreach ($validated['subjects'] as $index => $subject) {
            $studentMark = new StudentMarks();
            $studentMark->student_id = $student->id;
            $studentMark->subject = $subject;
            $studentMark->marks = $validated['marks'][$index];
            $studentMark->save();
        }
    
        return redirect()->route('students.create')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('marks')->findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with('marks')->findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'subjects' => 'required|array',
        'subjects.*' => 'required|string|max:255',
        'marks' => 'required|array',
        'marks.*' => 'required|integer|min:0|max:100',
    ]);

    $student = Student::findOrFail($id);
    $student->name = $validated['name'];
    $student->save();

    StudentMarks::where('student_id', $student->id)->delete();

    foreach ($validated['subjects'] as $index => $subject) {
        $studentMark = new StudentMarks();
        $studentMark->student_id = $student->id;
        $studentMark->subject = $subject;
        $studentMark->marks = $validated['marks'][$index];
        $studentMark->save();
    }

    return redirect()->route('students.index')->with('success', 'Student updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->marks()->delete(); 
        $student->delete(); 
    
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
