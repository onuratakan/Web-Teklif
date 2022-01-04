<?php

namespace App\Http\Controllers;

use App\Models\ActivationCode;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Jetstream;

class ActivationCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activation_codes = DB::table('activation_codes')
            ->get();

     return Inertia::render('ActivationCodes/Index', [
            'activation_codes' => $activation_codes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('ActivationCodes/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $timestamp =Carbon::now()->timestamp;
        $randomword = Str::random(15);
        $randomcode = (string)$timestamp . $randomword;




        $newArray = [
            'code' => $randomcode,
            'email' => $request->email,
        ];


        Validator::make($newArray, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','unique:activation_codes'],
            'code' => ['required', 'string', 'unique:users','unique:activation_codes'],
        ])->validate();


        $data  = ActivationCode::create($newArray);
        return back()->with('success', 'Activation Code Created Successfully');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
