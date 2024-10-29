<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;

class RegisterController extends Controller{

    public function create(){

        return view('auth.register');
    }

    public function store()
    {
        try {
            // Validar los datos recibidos
            $this->validate(request(), [
                'ci' => 'required|numeric', // Aseguramos que CI sea numérico
                'nombre' => 'required|string|max:255',
                'a_paterno' => 'required|string|max:255',
                'a_materno' => 'required|string|max:255',
                'sexo' => 'required|string|in:masculino,femenino', // Validar que el sexo sea masculino o femenino
                'telefono' => 'required|numeric|max:15',
                'direccion' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);
        
            // Transformar el valor de sexo a "f" o "m"
            $sexo = request('sexo') === 'femenino' ? 'f' : 'm';
    
            // Crear un array con todos los campos
            $data = [
                'ci' => request('ci'),
                'nombre' => request('nombre'),
                'a_paterno' => request('a_paterno'),
                'a_materno' => request('a_materno'),
                'telefono' => request('telefono'),
                'direccion' => request('direccion'),
                'sexo' => $sexo // Asignar el valor transformado de sexo
            ];
        
            // Crear el cliente con el array de datos
            $Client = Cliente::create($data);
            $Client->estado = 'h';
        
            // Crear el usuario
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')), // Asegúrate de cifrar la contraseña
            ]);
            $user->role = 'cliente';
            $Client->user_id = $user->id;
        
            // Guardar los cambios
            $user->save();
            $Client->save();
        
            return redirect()->to('/login');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    
    
    
}
