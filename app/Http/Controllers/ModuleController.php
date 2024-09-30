<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules=Module::all();
        return view('module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'nom_module'=>'required|string',
            'diminutif'=>'required|string',
            'description'=>'string'
        ]);
        $module=new Module;
        $module->nom=$request->nom_module;
        $module->dimunitif=$request->diminutif;
        $module->description=$request->description;
        $module->url="/module/".$module->nom;
        $module->state=0;
        $module->save();
        return back()->with('message', 'Module enregistré');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modules=Module::findOrFail($id);
        return view('module.edit', compact('modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom_module'=>'required|string',
            'diminutif'=>'required|string',
            'description'=>'string'
        ]);
        $module=Module::find($id);
        $module->nom=$request->nom_module;
        $module->dimunitif=$request->diminutif;
        $module->description=$request->description;
        $module->url="/module/".$module->nom;
        $module->state=0;
        $module->save();
        return back()->with('message', 'Module modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $module=Module::findOrFail($id);
        if($module->state==0){
            $module->delete();
            return back()->with('message', 'Module Supprimé avec succès');
        }else{
            return back()->with('message', 'Impossible de supprimer ce module');
        };

    }

    public function state($module_id){
        $module=Module::find($module_id);
        if($module->state==0){
            $module->state=1;
            $module->save();
            return back()->with('message', 'Module activé');
        }else{
            $module->state=0;
            $module->save();
            return back()->with('message', 'Module desactivé');
        };
    }
}
