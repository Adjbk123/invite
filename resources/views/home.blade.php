@extends('layouts.admin')

@section('title', 'Espace Personnel')

@section('content')
<div class="container-fluid py-4">
    {{-- Hero Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden" 
                 style="background: linear-gradient(135deg, #1a3a8f 0%, #0d6efd 100%); color: white;">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h1 class="display-5 fw-bold mb-2">Ravi de vous revoir,</h1>
                            <h2 class="display-6 opacity-75 mb-4">{{ auth()->user()->name }}</h2>
                            <p class="lead mb-4">
                                Bienvenue sur votre portail de gestion {{ config('app.name') }}. 
                                Suivez vos activités et gérez vos invitations en toute simplicité.
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold">
                                    <i class="fas fa-external-link-alt me-2"></i>Voir le site
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('administrateur.dashboard') }}" class="btn btn-outline-light btn-lg rounded-pill px-4">
                                        <i class="fas fa-chart-line me-2"></i>Tableau de bord
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5 d-none d-md-block text-center">
                            <i class="fas fa-user-shield fa-10x opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats cards or Quick Actions --}}
    <div class="row g-4">
        {{-- Profile Card --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">Mon Profil</h5>
                </div>
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        <div class="bg-primary d-inline-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 80px; height: 80px; font-size: 32px; color: white;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>
                    <h4 class="fw-bold mb-1">{{ auth()->user()->name }}</h4>
                    <p class="text-muted mb-3">{{ auth()->user()->email }}</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @foreach(auth()->user()->roles as $role)
                            <span class="badge border border-primary text-primary px-3 rounded-pill">
                                {{ ucfirst($role->nom) }}
                            </span>
                        @endforeach
                    </div>
                    {{--<button class="btn btn-outline-primary btn-sm rounded-pill px-4">Éditer le profil</button>--}}
                </div>
            </div>
        </div>

        {{-- Shortcuts --}}
        <div class="col-md-8">
            <div class="row g-4">
                {{-- Invitations card --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success-light p-3 rounded-4 me-3">
                                    <i class="fas fa-id-card text-success fs-4"></i>
                                </div>
                                <h5 class="fw-bold mb-0">Gestion Invités</h5>
                            </div>
                            <p class="text-muted">Gérez la liste des invités, leurs statuts et générez leurs cartes.</p>
                            <a href="{{ route('informaticien.gestinvites.invites.index') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                {{-- Settings card --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 card-hover">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info-light p-3 rounded-4 me-3">
                                    <i class="fas fa-cogs text-info fs-4"></i>
                                </div>
                                <h5 class="fw-bold mb-0">Paramètres</h5>
                            </div>
                            <p class="text-muted">Configurez les informations du site, les logos et les détails de l'événement.</p>
                            <a href="{{ route('administrateur.gestparametres.parametres.index') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                {{-- Help Card --}}
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 bg-light">
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="me-4 text-warning">
                                <i class="fas fa-lightbulb fa-3x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Besoin d'aide ?</h5>
                                <p class="mb-0 text-muted">Consultez la documentation ou contactez le support technique pour toute question sur l'utilisation de la plateforme.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-light { background-color: rgba(40, 167, 69, 0.1); }
    .bg-info-light { background-color: rgba(23, 162, 184, 0.1); }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
    
    .card-hover {
        transition: all 0.3s ease;
        border: 1px solid transparent !important;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        border-color: rgba(0,0,0,0.05) !important;
    }
    
    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: "";
    }
</style>
@endsection
