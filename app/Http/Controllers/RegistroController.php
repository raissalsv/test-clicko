<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\BaseController as BaseController;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class RegistroController extends BaseController
{
    /**
     * Registro api
     *
     * @return \Illuminate\Http\Response
     */
    public function registro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:20', 
            'c_password' => 'required|same:password' 
        ]);
 
        if ($validator->fails()) {
            return $this->sendError('Error de validación.', $validator->errors()->all());
        }

        $input = $request->all();
       
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);
        $success['token'] =  $user->createToken('clicko')->plainTextToken;
   
        return $this->sendResponse($success, 'Registrado con éxito');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'Login exitoso');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}
