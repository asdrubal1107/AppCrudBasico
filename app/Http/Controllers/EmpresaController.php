<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresas = Empresa::all();
        return $empresas;
    }

    public function store(Request $request)
    {
        $empresas = new Empresa();
        $empresas->nit = $request->nit;
        $empresas->nombre = $request->nombre;
        $empresas->celular = $request->celular;
        $empresas->direccion = $request->direccion;
        $empresas->servicios = $request->servicios;
        $empresas->estado = '1';
        $empresas->save();
    }

    public function update(Request $request)
    {
        $empresas = Empresa::findOrFail($request->id);
        $empresas->nit = $request->nit;
        $empresas->nombre = $request->nombre;
        $empresas->celular = $request->celular;
        $empresas->direccion = $request->direccion;
        $empresas->servicios = $request->servicios;
        $empresas->estado = '1';
        $empresas->update();
    }

    public function activar(Request $request)
    {
        $empresas = Empresa::findOrFail($request->id);
        $empresas->estado = '1';
        $empresas->update();
    }

    public function desactivar(Request $request)
    {
        $empresas = Empresa::findOrFail($request->id);
        $empresas->estado = '0';
        $empresas->update();
    }
}
