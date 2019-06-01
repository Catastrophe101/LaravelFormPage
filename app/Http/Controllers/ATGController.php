<?php

namespace App\Http\Controllers;
use App\Traits\FormDataTrait;
use Illuminate\Http\Request;
class ATGController extends Controller
{
    use FormDataTrait;
    /**
     * Display a listing of the resource.
     *
     * @return view form.blade.php
     */
    public function index()
    {
        //To load the form UI
        return view('form');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view form.blade.php with validated data with either success or error message
     */
    public function store(Request $request)
    {
        //Below is the validation
        $validatorData=$this->validateData($request);
        //If error in data is found user is redirected to the form page with error message
        if ($validatorData->fails()) {
            return redirect('/form')
                ->withErrors($validatorData)
                ->withInput();
        } else {
            //No errors in validation saving data in database
            $this->storeData($request);
            //Once save is done redirecting to form page with success message
            return redirect()->route('form')->withSuccess(['Form submitted successfully!']);
        }
    }
}
