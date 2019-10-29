<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Company;
use Illuminate\Http\Request;
use Validator;


class CompaniesController extends Controller
{
    /**
     * Register a company.
     *
     * @return company credentials
     */
    static function register($request, $user)
    {
        $validation =  Validator::make($request->all(), [
            'address' => 'required|string|min:3|max:255',
            'city' => 'required|min:2|max:255',
            'city' => 'required|min:2|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'messages' => $validation->errors()
            ], 400);
        }

        $company = Company::create([
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'user_id' => $user->id
        ]);

        return $company;
    }
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
    public function create()
    {
        //
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
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
