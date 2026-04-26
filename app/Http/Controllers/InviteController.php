<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\Parametre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InviteController extends Controller
{
    // ——— Liste des invités
    public function index()
    {
        $invites      = Invite::orderBy('created_at', 'desc')->get();
        $disponible   = Invite::where('statut', 'disponible')->count();
        $indisponible = Invite::where('statut', 'indisponible')->count();
        $enAttente    = Invite::whereNull('statut')->orWhere('statut', '')->count();

        return view('invites.index', compact('invites', 'disponible', 'indisponible', 'enAttente'));
    }

    // ——— Télécharger le PDF de tous les disponibles
    public function downloadPdfDisponibles()
    {
        $formateurs = Invite::where('statut', 'disponible')->get();
        $parametres = Parametre::first();

        $pdf = Pdf::loadView('invites.pdf_disponibles', compact('formateurs', 'parametres'));

        return $pdf->download('invites_disponibles_' . date('Y-m-d') . '.pdf');
    }

    // ——— Formulaire création
    public function create()
    {
        return view('invites.create');
    }

    // ——— Enregistrer un nouvel invité
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom'    => 'required|string|max:255',
            'numero' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Invite::create([
            'nom'          => $request->nom,
            'numero'       => $request->numero,
            'numero_table' => $request->numero_table,
        ]);

        return redirect()->route('informaticien.gestinvites.invites.index')
                         ->with('success', 'Invité ajouté avec succès !');
    }

    // ——— Formulaire édition
    public function edit($id)
    {
        $formateur = Invite::findOrFail($id);
        return view('invites.edit', compact('formateur'));
    }

    // ——— Mettre à jour un invité
    public function update(Request $request, $id)
    {
        $formateur = Invite::findOrFail($id);

        // Mise à jour du statut uniquement
        if ($request->filled('statut')) {
            $request->validate([
                'statut' => 'required|in:disponible,indisponible',
            ]);

            $formateur->statut        = $request->statut;
            $formateur->statut_modifie = true;
            $formateur->save();

            return redirect()->back()->with('success', 'Statut mis à jour avec succès !');
        }

        // Mise à jour des informations générales
        $request->validate([
            'nom'    => 'required|string|max:255',
            'numero' => 'nullable|string|max:20',
        ]);

        $formateur->update([
            'nom'          => $request->nom,
            'numero'       => $request->numero,
            'numero_table' => $request->numero_table,
        ]);

        return redirect()->back()->with('success', 'Informations mises à jour avec succès !');
    }

    // ——— Supprimer un invité
    public function destroy($id)
    {
        $formateur = Invite::findOrFail($id);
        $formateur->delete();

        return redirect()->route('informaticien.gestinvites.invites.index')
                         ->with('success', 'Invité supprimé avec succès !');
    }

    // ——— Réinitialiser tous les statuts
    public function resetStatus()
    {
        Invite::query()->update([
            'statut'         => null,
            'statut_modifie' => false,
        ]);

        return response()->json([
            'message' => 'Tous les statuts ont été réinitialisés avec succès !'
        ]);
    }

    // ——— Supprimer tous les invités
    public function deleteAll()
    {
        Invite::truncate();
        return redirect()->route('informaticien.gestinvites.invites.index')
                         ->with('success', 'Tous les invités ont été supprimés avec succès !');
    }
}
