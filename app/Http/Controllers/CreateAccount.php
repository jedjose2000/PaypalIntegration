<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Rules\CustomValidationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Add this import statement
class CreateAccount extends Controller
{
    public function index(){
        return view('create-account');
    }

    public function create(Request $request){

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', CustomValidationRules::email()],
            'username' => ['required', CustomValidationRules::username()],
            'password' => 'required',
        ]);   
        if ($validator->fails()) {
            $errorMessages = [];

            if ($validator->errors()->has('username')) {
                $errorMessages[] = CustomValidationRules::username()->message();
            }
            
            if ($validator->errors()->has('email')) {
                $errorMessages[] = CustomValidationRules::email()->message();
            }
            
            // If there are no specific error messages, set a custom error message
            if (empty($errorMessages)) {
                $errorMessages[] = 'There was an error with your submission.';
            }
            
            return redirect()
                ->route('account')
                ->withErrors(['custom' => $errorMessages])
                ->withInput();
        } else {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $data = AccountModel::create([
                'email' => $email,
                'username' => $username,
                'password' => $hashedPass,
            ]);
            if ($data) {
                return redirect('/')->with('success', 'Account created successfully.');
            } else {
                return redirect()
                ->route('account')
                ->withErrors(['custom' => 'There was an error with your submission.'])
                ->withInput();
            }
        }
    }
    

}
