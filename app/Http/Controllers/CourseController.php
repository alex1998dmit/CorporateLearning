<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Company;
use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
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
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|min:3|max:6000',
            'duration' => 'required|integer|min:1',
            'complexity' => 'required|integer|min:1|max:3',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'messages' => $validation->errors()
            ], 400);
        }

        $user = Auth::user();
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'complexity' => $request->complexity,
            'company_id' => $user->company->id
        ]);
        return $course;
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
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
