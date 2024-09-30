<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\Classe;

class inscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inscriptions=Inscription::all();
        return view('inscription.index', compact('inscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes  = Classe::all();
        return view('inscription.add', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'nom_etudiant' => 'required|string',
            'prenom_etudiant' => 'required|string',
            'date_de_naissance' => 'required|date',
            'lieu_de_naissance' => 'required|string',
            'annee_scolaire' => 'required|string',
            'classe_id' => 'required|integer',
        ]);

        // Créer une nouvelle instance d'inscription
        $inscription = new Inscription;
        $inscription->nom_etudiant = $request->nom_etudiant;
        $inscription->prenom_etudiant = $request->prenom_etudiant;
        $inscription->numero_piece = $request->numero_piece;
        $inscription->date_de_naissance = $request->date_de_naissance;
        $inscription->lieu_de_naissance = $request->lieu_de_naissance;
        $inscription->annee_scolaire = $request->annee_scolaire;
        $inscription->classe_id = $request->classe_id;

        // Récupérer la classe à laquelle l'étudiant est inscrit
        $classe = Classe::find($request->classe_id);

        // Créer un chemin pour le dossier de la classe
        $cheminClasse = public_path('classes/' . $classe->nom_classe);

        // Vérifier si le dossier de la classe existe, sinon le créer
        if (!file_exists($cheminClasse)) {
            mkdir($cheminClasse, 0777, true);
        }

        // Créer un fichier avec le nom et prénom de l'étudiant dans le dossier de la classe
        $nomFichier = $request->nom_etudiant . '_' . $request->prenom_etudiant . '.txt';
        $cheminFichier = $cheminClasse . '/' . $nomFichier;

        // Contenu du fichier (par exemple, les détails de l'inscription)
        $contenuFichier = "Nom : " . $request->nom_etudiant . "\n" .
                        "Prénom : " . $request->prenom_etudiant . "\n" .
                        "Date de naissance : " . $request->date_de_naissance . "\n" .
                        "Lieu de naissance : " . $request->lieu_de_naissance . "\n" .
                        "Année scolaire : " . $request->annee_scolaire;

        // Créer le fichier et y écrire les informations de l'étudiant
        file_put_contents($cheminFichier, $contenuFichier);

        $inscription->deletable = 0; // Initialiser deletable à 0
        $inscription->etat = 0; // Initialiser état à 0
        $inscription->save(); // Sauvegarder l'inscription dans la base de données

        

        // Retourner avec un message de succès
        return back()->with('message', 'Inscription enregistrée avec succès et fichier créé.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
