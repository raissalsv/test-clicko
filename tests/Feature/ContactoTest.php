<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ContactoTest extends TestCase
{

    use RefreshDatabase;

    public function autenticar()
    {
    
        $user = User::create([
            'name' => 'test',
            'email' => time().'test@gmail.com',
            'password' => bcrypt('1234')
        ]);
      
        if (!Auth::attempt(['email'=>$user->email, 'password'=>'1234'])) {
            return response(['message' => 'Login credentials are invaild']);
        }
        $userAuth = Auth::user(); 
       
        return $userAuth->createToken('Clicko')->plainTextToken; 
    } 

    public function test_crear_contacto()
    {
        $token = $this->autenticar();
       
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST', '/api/contactos', [
            'nombre'  =>  'Test',
            'apellido'  => 'Prueba',
            'email'  => rand(12,67910).'@gmail.com',
            'telefono'  => '665444444',
            'dni'=> '33969805R'
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true,
        ]);
    }

    public function test_buscar_todos_contactos()
    {
        $token = $this->autenticar();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/contactos');

        $response->assertStatus(200)->assertJson([
            'success' => true,
        ]);
    }

    public function test_crear_user_metodo_no_permitido()
    {
        //intento de crear un usuario con metodo Put
        $token = $this->autenticar();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT','api/contactos');

        $response->assertStatus(405);
    }

    public function test_borrar_usuario_inexistente()
    {
        //intento de borrar un usuario que no existe
        $token = $this->autenticar();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE','api/contactos/10000');

        $response->assertStatus(404);
    }
  

    
}
