<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){
        $productos = Producto::all();
        return view('productos.index',[ 'productos' => $productos  ]);
    }

    public function create(){
        return view('productos.create');
    }

    public function store(Request $request){
        try {
            $producto= new Producto();
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->save();

            return redirect(route('producto.create'))->with('success', 'producto registrado con exito!');

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function edit($id){
        $producto = Producto::where('id' , $id)->first();
        return view('productos.edit', ['producto' => $producto]);
    }

    public function update(Request $request, $id){
        try {
            $producto= Producto::where('id', $id)->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
            ]);
            if($producto){
                return redirect(route('producto.index'))->with('success', 'producto actualizado con exito!');
            }

            return redirect(route('producto.index'))->with('success', 'producto no actualizado :(');

        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete($id){
        try {
            $producto= Producto::where('id', $id)->delete();
            if($producto){
                return redirect(route('producto.index'))->with('success', 'producto eliminado con exito!');
            }

            return redirect(route('producto.index'))->with('success', 'producto no eliminado :(');


        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

}
