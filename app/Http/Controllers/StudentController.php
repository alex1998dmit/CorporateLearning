<?php

namespace App\Http\Controllers;

use App\Participant;
use Auth;
use Validator;
use App\Course;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'messages' => $validation->errors()
            ], 400);
        }

        $participant = Participant::where('user_id', '=', Auth::id())->first();
        if (!$participant) {
            return response()->json(['message' => 'Not a participant']);
        }
        $currentStudentCourses = Student::where('participant_id', '=', $participant->id)->get();
        $isEnrolled = $currentStudentCourses->contains('id', $request->course_id);
        if (!$isEnrolled) {
            $student = Student::create([
                'participant_id' => $participant->id,
                'course_id' => $request->course_id
            ]);
            return $student;
        } else {
            return response()->json(['message' => 'Already enrolled'], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
