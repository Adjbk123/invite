@extends('layouts.app')
@section('title', 'Remerciement')
@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4 p-md-5 text-center remerciement-card">

        <!-- Icône check animée -->
        <div class="check-icon mb-4">
            <i class="fas fa-check-circle"></i>
        </div>

        <h2 class="text-success mb-4 fs-5 fs-md-4 fs-lg-3">
          MAFLYT vous remercie pour votre inscription !
        </h2>
        
        <!-- ID dans petit cadre bleu -->
        <div class="mb-3">
            <span class="info-id">Numéro d'enregistrement : {{ $inscription->id }}</span> 
        </div>
        
        <!-- Infos utilisateur dans card verte -->
        <div class="info-user-card mb-4 p-3">
            <p class="mb-2">Monsieur/Madame, vous serez informé après l'étude des dossiers sur :</p>
            <p class="mb-1"><strong>Adresse Mail :</strong> {{ $inscription->email }}</p> ou sur le 
            <p class="mb-0"><strong>Numéro :</strong> {{ $inscription->numero }}</p>
        </div>
       
        <a href="{{ url('/') }}" class="btn btn-success mt-3 px-4 py-2">Retour à l'accueil</a>
    </div>
</div>

<style>
/* Card principale responsive */
.remerciement-card {
    background-color: #e6f7ea; /* vert très léger */
    border-radius: 15px;
    max-width: 450px;
    width: 90%;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.remerciement-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

/* Icône check animée */
.check-icon {
    font-size: 50px;
    color: #28a745;
    animation: bounce 1s ease infinite;
}

/* Animation bounce */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Cadre ID bleu */
.info-id {
    background-color: #cce5ff;
    color: #004085;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: 600;
    display: inline-block;
}

/* Cadre infos utilisateur vert */
.info-user-card {
    background-color: #d4edda; /* vert léger */
    border: 2px solid #28a745;
    border-radius: 10px;
    text-align: left;
    font-size: 0.9rem;
}

/* Responsive pour mobile, tablette et PC */
@media (max-width: 576px) {
    .remerciement-card { padding: 20px; width: 95%; }
    .check-icon { font-size: 40px; }
    .info-user-card { font-size: 0.85rem; }
}

@media (min-width: 577px) and (max-width: 992px) {
    .remerciement-card { padding: 30px; width: 90%; }
    .check-icon { font-size: 45px; }
    .info-user-card { font-size: 0.9rem; }
}

@media (min-width: 993px) {
    .remerciement-card { padding: 40px; width: 450px; }
    .check-icon { font-size: 50px; }
    .info-user-card { font-size: 0.95rem; }
}
</style>
@endsection
