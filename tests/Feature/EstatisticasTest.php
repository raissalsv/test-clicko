<?php

namespace Tests\Feature;

use App\Http\Resources\Contacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

use Tests\Feature\ContactoTest;

class EstatisticasTest extends TestCase
{
   // use RefreshDatabase;

   public function test_respuesta_estadisticas()
   {
       $contacto = new ContactoTest();
       $contactoAuth = $contacto->autenticar();
       
       $response = $this->withHeaders([
           'Authorization' => 'Bearer '. $contactoAuth,
       ])->json('GET','api/estadisticas');

       $response->assertStatus(200)->assertJson([
           'success' => true,
       ]);
   }
   
}

