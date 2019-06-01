<?php
namespace App\Traits;

use App\FormData;
use App\Rules\EmailValidation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

trait FormDataTrait
{
    public function validateData($request)
    {
        $validatorData = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:form_data',new EmailValidation()],
            'pincode' => ['required', 'integer', 'digits:6'],
        ]);
        return $validatorData;
    }

    public function storeData($request)
    {
        $formData = new FormData();
        $formData->name = $request->input('name');
        $formData->email = $request->input('email');
        $formData->pincode = $request->input('pincode');

        $Data=array('email' => $request->input('email'),
            'pincode' => $request->input('pincode'),
            'name'=>$request->input('name'));
        try {
            Mail::send('emails.welcomeEmail', $Data, function ($message) use ($Data) {
                $message->from('from@example.com');
                $message->to($Data['email']);
                $message->subject("Welcome message");
            });
            app('log')->info('Email sent successful to '.$formData->email);
        }catch( Exception $ex){
            if (count(Mail::failures()) > 0) {
                app('log')->info('Email sent unsuccessful to'.$formData->email);
            }
        }

        $formData->save();
    }
}