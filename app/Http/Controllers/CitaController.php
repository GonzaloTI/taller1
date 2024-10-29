<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Disponibilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
set_time_limit(120); 
class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtiene el usuario autenticado
        $cliente = Auth::user();
    
        // Recupera las citas relacionadas con el cliente autenticado y las ordena desde la más reciente
        $citas = Cita::where('user_id_cliente', $cliente->id)
                     ->orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
                     ->paginate(10); // Cambiado a paginate() para la paginación
    
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return view('citas.index', compact('citas'));
    }
    public function recepciones()
    {
       
        // Recupera las citas relacionadas con el cliente autenticado y las ordena desde la más reciente
        $citas = Cita::orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
        ->paginate(10);
        // Retorna la vista de citas del cliente, pasando las citas recuperadas
        return view('citas.indexRecepcion', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'horadisponible' => 'required|date_format:H:i',
            'disponibilidad_id' => 'required',
        ]);
    
        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id();
                $dispid = $request->disponibilidad_id;
                $disponibilidad = Disponibilidad::where('id', $dispid)->firstOrFail();
    
                // Verificar disponibilidad de cupos
                if ($disponibilidad->libre <= 0) {
                    throw new \Exception('No hay cupos disponibles para esta cita.');
                }
    
                // Reducir el número de cupos libres
                $disponibilidad->libre -= 1;
                $disponibilidad->save();
    
                $medico = $disponibilidad->user->medico;
                $nombre = $medico->nombre . ' ' . $medico->a_paterno . ' ' . $medico->a_materno;
    
                // Crear la cita
                Cita::create([
                    'fecha' => $request->fecha,
                    'hora' => $request->horadisponible,
                    'detalles' => 'Especialista: ' . $nombre . ' Cita reservada en línea',
                    'estado' => 'confirmado',
                    'user_id_cliente' => $userId,
                    'disponibilidad_id' => $disponibilidad->id,
                ]);
            });
    
            return redirect()->back()->with('success', 'Cita reservada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'No se pudo reservar la cita: ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
  
        $cita->destroy();
    
        return redirect()->route('citas.index')->with('error', 'No se pudo cancelar la cita.');
    }

    public function cancel($id)
{
    try {
      
        $cita = Cita::findOrFail($id);

      
        if ($cita->user_id_cliente == Auth::id() ) {
            // Cambia el estado de la cita a "cancelado"
            $cita->estado = 'cancelado';
            $cita->save();
            // Retorna con mensaje de éxito
            return redirect()->route('citas.index')->with('success', 'Cita cancelada con éxito.');
        }

        // Retorna con mensaje de error si la cita no puede ser cancelada
        return redirect()->route('citas.index')->with('error', 'No se pudo cancelar la cita.');
    } catch (\Exception $e) {
        // Manejo de errores inesperados
        return redirect()->route('citas.index')->with('error', 'Ocurrió un error al intentar cancelar la cita.');
    }
}
public function finalize($id)
{
    try {
      
        $cita = Cita::findOrFail($id);

      
        if ($cita) {
            // Cambia el estado de la cita a "cancelado"
            $cita->estado = 'finalizado';
            $cita->save();
            // Retorna con mensaje de éxito
            return redirect()->route('citas.recepciones')->with('success', 'Cita finalizada con éxito.');
        }

        // Retorna con mensaje de error si la cita no puede ser cancelada
        return redirect()->route('citas.recepciones')->with('error', 'No se pudo finalizar la cita.');
    } catch (\Exception $e) {
        // Manejo de errores inesperados
        return redirect()->route('citas.recepciones')->with('error', 'Ocurrió un error al intentar finalizar la cita.');
    }
}

public function notificar($id)
{
    $cita = Cita::findOrFail($id);
 //   dd( $cita);
    $userclienttoken = $cita->cliente->tokenNotificacion;
    //dd( $userclienttoken);
    $this->sendNotification2($userclienttoken,'hola','hola');

    return redirect()->back()->with('success', 'Notificación enviada correctamente.');
}

  public function sendNotification($deviceToken, $title, $body,$rutaimagen)
    {
        $imagen =$rutaimagen;
        $serverKey = 'AAAAM-ejTlM:APA91bEqdQRAjd_2_qXK23M9c7CbbDf7SVpjas789C9xMQXtEkUNSHeT4Gj9t3nTOG_Tk6JK9C4qDD1n1r0oZeRtI9otcoi-OhPJDsw93LypxhQpHRvi9ZG9eS_WmT_fHagLHSSZubtF';
        $url = 'https://fcm.googleapis.com/fcm/send';
        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                   // 'image' => $imagen,
                ],
            ],
        ]);
       dd($response);
    }

    public function sendNotification2($deviceToken, $title, $body)
    {
            $accessToken = 'AAAAM-ejTlM:APA91bEqdQRAjd_2_qXK23M9c7CbbDf7SVpjas789C9xMQXtEkUNSHeT4Gj9t3nTOG_Tk6JK9C4qDD1n1r0oZeRtI9otcoi-OhPJDsw93LypxhQpHRvi9ZG9eS_WmT_fHagLHSSZubtF';
            $url = 'https://fcm.googleapis.com/v1/projects/parcialeventos-66383/messages:send';
        
            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'message' => [
                        'token' => $deviceToken,
                        'notification' => [
                            'title' => $title,
                            'body' => $body,
                        ],
                    ],
                ],
                'allow_redirects' => true,
                'verify' => true,
            ]);
        
            dd($response);
        }
public function cancelrecepcion($id)
{
    try {
      
        $cita = Cita::findOrFail($id);

      
        if ($cita ) {
            // Cambia el estado de la cita a "cancelado"
            $cita->estado = 'cancelado';
            $cita->save();
            // Retorna con mensaje de éxito
            return redirect()->route('citas.recepciones')->with('success', 'Cita cancelada con éxito.');
        }

        // Retorna con mensaje de error si la cita no puede ser cancelada
        return redirect()->route('citas.recepciones')->with('error', 'No se pudo cancelar la cita.');
    } catch (\Exception $e) {
        // Manejo de errores inesperados
        return redirect()->route('citas.recepciones')->with('error', 'Ocurrió un error al intentar cancelar la cita.');
    }
}
}
