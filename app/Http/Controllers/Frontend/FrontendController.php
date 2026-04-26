<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\Parametre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // ——— Page d'accueil publique
    public function index()
    {
        return view('frontend.index');
    }

    // ——— Page de recherche (GET)
    public function searchInvitePage()
    {
        return view('frontend.index');
    }

    // ——— Recherche d'un invité (POST)
    public function searchInvite(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = trim($request->input('query'));

        $formateurs = Invite::where('nom', 'like', "%{$query}%")
            ->orWhere('numero', 'like', "%{$query}%")
            ->get();

        return view('frontend.index', compact('formateurs', 'query'));
    }

    // ——— Mise à jour du statut (POST — répond en JSON pour éviter une navigation)
    public function updateStatus(Request $request)
    {
        $request->validate([
            'formateur_id' => 'required|exists:invites,id',
            'statut'       => 'required|string|in:Disponible,Indisponible',
        ]);

        $invite = Invite::findOrFail($request->formateur_id);

        // 🚫 Déjà modifié → refus
        if ($invite->statut_modifie) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà enregistré votre statut.',
            ]);
        }

        // ✅ Enregistrement (statut stocké en minuscule)
        $invite->statut         = strtolower($request->statut);
        $invite->statut_modifie = true;
        $invite->save();

        $downloadUrl = null;
        $message     = 'Votre statut "Indisponible" a bien été enregistré. Merci !';

        if ($request->statut === 'Disponible') {
            $downloadUrl = route('frontend.downloadCarte', $invite->id);
            $message     = 'Votre statut "Disponible" a été enregistré. Votre carte d\'invitation est en cours de téléchargement !';
        }

        return response()->json([
            'success'      => true,
            'statut'       => $invite->statut,   // 'disponible' ou 'indisponible'
            'message'      => $message,
            'download_url' => $downloadUrl,
        ]);
    }

    // ——— Téléchargement de la carte d'invitation (GET)
    public function downloadCarte($id)
    {
        $invite    = Invite::findOrFail($id);
        $parametres = Parametre::first();

        $pdf = Pdf::loadView('invites.carte_invitation', compact('invite', 'parametres'))
                  ->setPaper('a5', 'landscape');

        $filename = 'carte_invitation_' . \Str::slug($invite->nom) . '.pdf';

        return $pdf->download($filename);
    }
}
