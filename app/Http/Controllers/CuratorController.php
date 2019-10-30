<?php

namespace App\Http\Controllers;

use App\Course;
use Auth;
use Validator;
use App\Curator;
use App\Student;
use Illuminate\Http\Request;

class CuratorController extends Controller
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
            'participant_id' => 'required|exists:participants,id',
            'course_id' => 'required|exists:courses,id',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'messages' => $validation->errors()
            ], 400);
        }

        $company = Auth::user()->company;
        $course = Course::find($request->course_id);
        if ($company->courses->contains('id', $request->course_id)) {
            if ($course->students->contains('id', $request->participant_id)) {
                return response()->json(['message' => 'Participant already at course as courator'], 400);
            }
            $student = Student::create([
                'participant_id' => $request->participant_id,
                'course_id' => $request->course_id
            ]);
            return $student;
        } else {
            return response()->json(['message' => 'Not from your course'], 403);
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
     * @param  \App\Curator  $curator
     * @return \Illuminate\Http\Response
     */
    public function show(Curator $curator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curator  $curator
     * @return \Illuminate\Http\Response
     */
    public function edit(Curator $curator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curator  $curator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curator $curator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curator  $curator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curator $curator)
    {
        //
    }
}
