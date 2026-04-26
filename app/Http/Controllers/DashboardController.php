<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Models\Invite;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Compter lesInvites disponibles et indisponibles
        $disponible =Invite::where('statut', 'disponible')->count();
        $indisponible =Invite::where('statut', 'indisponible')->count();

        return view('dashboard', compact('disponible', 'indisponible'));
    }
}
