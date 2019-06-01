<?php

namespace App\Http\Controllers;
use App\Traits\FormDataTrait;
use Illuminate\Http\Request;

class WebServicesController extends Controller
{
    use FormDataTrait;
    //
    function store(Request $request){
        $validatorData=$this->validateData($request);
        if ($validatorData->fails()) {
            return response()->json(['Status'=>0,$validatorData->messages()], 400);
        }else {
            $this->storeData($request);
            return response()->json(['Status'=>1,'Message'=>"Data save successful"], 200);
        }
    }
}
