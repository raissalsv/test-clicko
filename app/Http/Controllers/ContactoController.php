<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use App\Http\Controllers\BaseController as BaseController;
use App\Models\Contacto;
use App\Http\Resources\Contacto as ContactoResource;

use Illuminate\Support\Facades\Validator;

class ContactoController extends BaseController
{
    public function index()
    {
        $contactos = Contacto::all();

        return $this->sendResponse(ContactoResource::collection($contactos), 'Contactos encontrados con éxito.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:contactos',
            'telefono' => 'required|numeric',
            'dni' => 'required|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->all());
        }

        $post = Contacto::create($input);

        return $this->sendResponse(new ContactoResource($post), 'Usuário creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Contacto::find($id);

        if (is_null($post)) {
            return $this->sendError('Usuário no encontrado, verifique el id.');
        }

        return $this->sendResponse(new ContactoResource($post), 'Usuário encontrado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contacto = Contacto::find($id);

        if (is_null($contacto)) {
            return $this->sendError('Usuário no encontrado, verifique el id.');
        }

        $contacto->update([
            'email' => $request->get('email'),
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'telefono' => $request->get('telefono'),
            'dni' => $request->get('dni'),
        ]);

     /*    if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors()->all());
        }  */

        return $this->sendResponse(new ContactoResource($contacto), 'Usuário actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacto $post, $id)
    {
        $contacto = Contacto::find($id);

        if (is_null($contacto)) {
            return $this->sendError('Usuário no encontrado, verifique el id.');
        }
        
        $contacto->delete($id);

        return $this->sendResponse([], "Usuario borrado con exito.");
    }

}
