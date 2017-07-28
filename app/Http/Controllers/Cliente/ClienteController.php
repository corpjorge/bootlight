<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Producto;
use App\Model\Categorias;
use App\Model\Carro;
use App\Model\Cotizaciones;
use App\Model\Clientes;

use DB;
use Carbon\Carbon;

use Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $productos = Producto::all();
      $categorias = Categorias::all();
      return view('welcome',[ 'productos' => $productos, 'categorias' => $categorias ]);
    }

    public function cart(Request $request, $id)
    {   

      if ($request->ajax()) { 

        $carro = new Carro();
      
        if ($usuario_temporal =  $request->session()->get('cart')) { 

            if (Carro::where('usuario_temporal', $usuario_temporal)->where('producto_id', $id)->first()) {

                 return response()->json([
                'total' => $total,
                 ]);

             }else{

                $carro->usuario_temporal = $usuario_temporal;
                $carro->producto_id = $request->id;
             }             
                                 
        }   
        else
        {
            $usuario_temporal = rand();
            $session = $request->session()->put('cart', $usuario_temporal);
            
            $carro->producto_id = $request->id;
            $carro->usuario_temporal = $usuario_temporal;                        
            
        }
        
        $carro->save();
        
        $total = Carro::where('usuario_temporal', $usuario_temporal )->count();
        $request->session()->put('cart_temporal', $total);  

              return response()->json([
                'total' => $total,
              ]);
        }
        else
        {
           return response()->view('adminlte::errors.404', [], 500);
        }

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        

         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Validate($request,[            
            'producto' => 'required|array',
            'cantidad' => 'required|array',
            'nombre' => 'required|',
            'correo' => 'required|email',
            'telefono' => 'required|numeric|min:1',
        ]);                       
        
        $cliente = new Clientes;       
        $cliente->nombre = $request->nombre;
        $cliente->correo  = $request->correo;
        $cliente->telefono  = $request->telefono;
        $cliente->sesion  = Session::get('cart');
        $cliente->save();
        $user_id = $cliente->id;

        $fecha_created_at = Carbon::now();

        for ($i=0; $i < count($request->producto) ; $i++) {

            if ($request->cantidad[$i] < 1) {               
                $cantidad = 1;                
            }else{
                $cantidad = $request->cantidad[$i]; 
            }

              DB::table('cotizaciones')->insert(
                  [
                    'sesion' => Session::get('cart'),
                    'producto_id' => $request->producto[$i],
                    'cliente_id' =>  $user_id,
                    'cantidad' => $cantidad,
                    'estado' =>  1,                    
                    'created_at' =>  $fecha_created_at,
                  ]
              );
        }

        $carro = Carro::where('usuario_temporal',Session::get('cart'));
        $carro->delete();

        Session::flush('cart');

        session()->flash('message', 'Su cotización fue enviada correctamente');
        return redirect('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario_temporal = Session::get('cart');
         
        $categorias = Categorias::all();        
        $carros = Carro::where('usuario_temporal', $usuario_temporal)->get();

        return view('adminlte::cart', ['categorias' => $categorias, 'carros' => $carros]);       
        
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
    public function destroy(Request $request , $id)
    {
        return $id;

        /*
       
        if ($request->ajax()) { 

            $carro = Carro::find($id);
            $carro->delete();

            $usuario_temporal = Session::get('cart');
            $total = Carro::where('usuario_temporal', $usuario_temporal )->count();

            Session::put('cart_temporal', $total);             

              return response()->json([

                'total' => $total,
                 
              ]);
        } 
        else{
            return response()->view('adminlte::errors.404', [], 500);
        }       

        */
        
    }


    public function prueba()
    {
        $usuario_temporal = Session::get('cart');
        $total = Carro::where('usuario_temporal', $usuario_temporal )->count();
        Session::put('cart_temporal', $total);

        $vv = Session::get('cart_temporal');
        echo $vv;

        /*
       
        if ($request->ajax()) { 

            $carro = Carro::find($id);
            $carro->delete();

            $usuario_temporal = Session::get('cart');
            $total = Carro::where('usuario_temporal', $usuario_temporal )->count();

            Session::put('cart_temporal', $total);             

              return response()->json([

                'total' => $total,
                 
              ]);
        } 
        else{
            return response()->view('adminlte::errors.404', [], 500);
        }     

        */    
        
    }



}
