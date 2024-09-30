<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;

class classeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes=Classe::all();
        return view('classe.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classe.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_classe'=>'required|string',
            'detail_classe'=>'required|string'
        ]);
        $classe=new Classe;
        $classe->nom_classe=$request->nom_classe;
        $classe->detail_classe=$request->detail_classe;
        $classe->etat=0;
        $classe->deletable=0;

        // Créer un dossier avec le nom de la classe
        $nomDossier = $classe->nom_classe; // Utiliser le nom de la classe comme nom du dossier
        $cheminDossier = public_path('classes/' . $nomDossier); // Générer le chemin vers le dossier

        // Vérifier si le dossier n'existe pas déjà, puis le créer
        if (!file_exists($cheminDossier)) {
            mkdir($cheminDossier, 0777, true); // Créer le dossier avec les permissions 0777
        }
        $classe->save();
        return back()->with('message', 'Classe enregistré');
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
        $classe=Classe::findOrFail($id);
        return view('classe.edit', compact('classe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom_classe'=>'required|string',
            'detail_classe'=>'required|string'
        ]);
        $classe=Classe::find($id);
        $classe->nom_classe=$request->nom_classe;
        $classe->detail_classe=$request->detail_classe;
        $classe->etat=0;
        $classe->deletable=0;

        // Créer un dossier avec le nom de la classe
        $nomDossier = $classe->nom_classe; // Utiliser le nom de la classe comme nom du dossier
        $cheminDossier = public_path('classes/' . $nomDossier); // Générer le chemin vers le dossier

        // Vérifier si le dossier n'existe pas déjà, puis le créer
        if (!file_exists($cheminDossier)) {
            mkdir($cheminDossier, 0777, true); // Créer le dossier avec les permissions 0777
        }
        $classe->save();
        return back()->with('message', 'Classe modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classe=Classe::findOrFail($id);
        if($classe->etat==0){
            $classe->delete($id);
            return back()->with('message', 'Classe supprimée');
        }
        else{
            return back()->with('message', 'Impossible de supprimer cette classe');
        }
    }
}
