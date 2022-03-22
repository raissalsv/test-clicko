<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegistroTest extends TestCase
{
   // use RefreshDatabase;

    public function testRegister()
    {
        $response = $this->json('POST', '/api/registro', [
            'name'  =>  'Test',
            'email'  => time().'test@globo.com',
            'password'  => '1234',
            'c_password'  => '1234',
        ]);

        // Nuevo usuario recibe el token para hacer peticiones
        $response->assertStatus(200)->assertJson([
            'success' => true,
        ]);
    }


    public function testLogin()
    {
        // Creando permiso para logar
        $email = time().'@hotmail.com';
        User::create([
            'name' => 'Test',
            'email'=> $email,
            'password' =>  bcrypt('1234')
        ]);

        $response = $this->json('POST','/api/login',[
            'email' => $email,
            'password' => 1234,
        ]);

    
        $response->assertStatus(200)->assertJson([
            'success' => true,
        ]);

        User::where('email','test@gmail.com')->delete();
    } 

}

