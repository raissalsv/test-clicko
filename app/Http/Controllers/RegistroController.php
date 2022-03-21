<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\BaseController as BaseController;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroPostRequest;



class RegistroController extends BaseController
{
    /**
     * Registro api
     *
     * @return \Illuminate\Http\Response
     */
    public function registro(RegistroPostRequest $request)
    {

        $request->validated();

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
            $success['token'] =  $user->createToken('Clicko')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'Login con exito');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}
