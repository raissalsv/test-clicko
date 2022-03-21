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
        // Creating Users
        $email = time().'@hotmail.com';
        User::create([
            'name' => 'Test',
            'email'=> $email,
            'password' =>  bcrypt('1234')
        ]);

        // Simulated landing
        $response = $this->json('POST','/api/login',[
            'email' => $email,
            'password' => 1234,
        ]);

        
        // Determine whether the login is successful and receive token 
        
        $response->assertStatus(200)->assertJson([
            'success' => true,
        ]);
        //$this->assertArrayHasKey('token',$response->json());

        // Delete users
        User::where('email','test@gmail.com')->delete();
    } 

}

