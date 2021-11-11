<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = [];
        if($request->session()->exists('resources')) {
            $resources = $request->session()->get('resources');
        }
        $data = [];
        $data['resources'] = $resources;
        if($request->session()->exists('message')) {
            $data['message'] = $request->session()->get('message');
            $type='success';
            if($request->session()->exists('type')){
                $type=$request->session()->get('type');
            }
        }
        return view('resource.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprise = 'Yago´s resources';
        $data = [];
        $data['enterprise'] = $enterprise;
        return view('resource.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $resources = [];//Creamos array vacio de resources
        if($request->session()->exists('resources')) {//Preguntamos si existe el array en la sesion, si existe lo cogemos, y si no lo creamos
            $resources = $request->session()->get('resources');
            $array=end($resources);//Creamos un array con las ultimas posiciones de resources
            $id=$array['id']+1;//en $id metemos las ultimas posiciones de la posicion 'id' y le sumamos una
        }else{
            $id=1;
        }
        
        
        
        //$id = $request->input('id');//Guardamos la id en un variable $id
        $name = $request->input('name');//Lo mismo pero con name
        $price = $request->input('price');
        $resource = ['id' => $id, 'name' => $name, 'price' => $price];//Como todavia no existe, lo creamos e indicamos que 'id' va a la variable $id y lo mismo con name
        if(isset($resources[$id])) {//Aqui estamos comprobando que el recurso no este ya creado, si esta creado nos devuelve a la vista anterior
            return back()->withInput();
        } else {
            $resources[$id] = $resource;//Si no esta creado, introducimos los valores dentro del array resources
        }
        $request->session()->put('resources', $resources);//Le decimos que meta en la vista 'resources' nuestro array $resource
        return redirect('resource')->with('message','Se ha insertado el elemento correctamente');//Nos redirige a la de vuelta a la vista resource, porque store no es una vista para verse
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if($request->session()->exists('resources') && isset($request->session()->get('resources')[$id])) {//Si la sesion existe y los recursos estan seteados, pues hace lo de abajo
            $resource = $request->session()->get('resources')[$id];//Mete en nuestro array $resource el parametro con el id que queremos mostrar
            $data=[];
            $data['resource'] = $resource;
            $data['enterprise'] = 'Resources Ltd.';
            return view('resource.show', $data);
        }
        return redirect('resource');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
            if($request->session()->exists('resources') && isset($request->session()->get('resources')[$id])) {
            $resource = $request->session()->get('resources')[$id];
            $data = [];
            $data['resource'] = $resource;
            $data['enterprise'] = 'Resources Ltd.';
            return view('resource.edit', $data);
            
        }
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
            if($request->session()->exists('resources')) {//miramos si la sesion existe y si existe tal
            $resources = $request->session()->get('resources');//conseguimos recursos
            
            if(isset($resources[$id])) {//Si la posicion $id??? esta dentro del array $resources????
                $resource = $resources[$id];//Metemos la posicion $id dentro de $resource
                $idInput = $request->input('id');//Guardamos las nuevas variables para poder updatear
                $nameInput = $request->input('name');
                $priceInput = $request->input('price');
                $resource['id'] = $idInput;//y las machacamos
                $resource['name'] = $nameInput;
                $resource['price'] = $priceInput;
                
                
                $resources[$idInput] = $resource;//Aqui introducimos los nuevos valores, en $resources
                
                $request->session()->put('resources', $resources);
                return redirect('resource')->with('message','Se ha insertado el elemento correctamente');
            }
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message='No se ha borrado correctamente';
        $type='danger';
      if($request->session()->exists('resources')) {
          $resources = $request->session()->get('resources');
          
          if(isset($resources[$id])) {
              unset($resources[$id]);//Lo borramos
              $request->session()->put('resources', $resources);
              $message='Se ha borrado correctamente';
              $type='success';
          }
      }
      $data=[];
      $data['message']=$message;
      $data['type']=$type;
        return redirect('resource')->with($data);
    }
    
    function flush(Request $request){
        $request->session()->flush();
        
        return redirect('resource')->with('message', 'All the data has been deleted');
    }
}
