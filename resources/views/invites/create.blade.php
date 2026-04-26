@extends('layouts.admin')
@section('title', 'Nouveau Participant')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4 fade-in">
                <div>
                    <h2 class="fw-bold mb-1 text-navy"><i class="fas fa-user-plus me-2"></i>Nouveau Participant</h2>
                    <p class="text-muted mb-0">Enregistrez un nouvel invité dans la base de données.</p>
                </div>
                <a href="{{ route('informaticien.gestinvites.invites.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-chevron-left me-2"></i>Retour
                </a>
            </div>

            {{-- Form Card --}}
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden slide-up">
                <div class="row g-0">
                    {{-- Left side: Info (Optional but looks professional) --}}
                    <div class="col-md-4 bg-navy d-none d-md-flex align-items-center justify-content-center text-white p-5 text-center">
                        <div>
                            <i class="fas fa-id-card-alt fa-5x mb-4 opacity-50"></i>
                            <h4 class="fw-bold">Données d'Invitation</h4>
                            <p class="small opacity-75">Ces informations seront utilisées pour générer la carte d'invitation personnalisée de l'invité.</p>
                        </div>
                    </div>

                    {{-- Right side: Form --}}
                    <div class="col-md-8 bg-white p-4 p-md-5">
                        <form action="{{ route('informaticien.gestinvites.invites.store') }}" method="POST">
                            @csrf

                            <div class="form-floating mb-4">
                                <input type="text" name="nom" class="form-control border-0 bg-light rounded-3 @error('nom') is-invalid @enderror" 
                                       id="nom" placeholder="Nom complet" value="{{ old('nom') }}" required>
                                <label for="nom"><i class="fas fa-user me-2 text-muted"></i>Nom complet de l'invité</label>
                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" name="numero" class="form-control border-0 bg-light rounded-3 @error('numero') is-invalid @enderror" 
                                               id="numero" placeholder="Numéro" value="{{ old('numero') }}">
                                        <label for="numero"><i class="fas fa-phone me-2 text-muted"></i>Téléphone</label>
                                        @error('numero') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" name="numero_table" class="form-control border-0 bg-light rounded-3 @error('numero_table') is-invalid @enderror" 
                                               id="numero_table" placeholder="Table" value="{{ old('numero_table') }}">
                                        <label for="numero_table"><i class="fas fa-chair me-2 text-muted"></i>N° de Table</label>
                                        @error('numero_table') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 opacity-25">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-navy btn-lg rounded-3 py-3 shadow-sm fw-bold">
                                    <i class="fas fa-check-circle me-2"></i>Enregistrer l'invité
                                </button>
                                <a href="{{ route('informaticien.gestinvites.invites.index') }}" class="btn btn-link text-muted text-decoration-none">
                                    Annuler l'opération
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-navy { background-color: #1a3a8f; }
    .text-navy { color: #1a3a8f; }
    .btn-navy { background-color: #1a3a8f; color: white; transition: all 0.3s ease; }
    .btn-navy:hover { background-color: #122a6b; color: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(26, 58, 143, 0.3); }
    
    .form-control:focus {
        background-color: white !important;
        box-shadow: 0 0 0 4px rgba(26, 58, 143, 0.1) !important;
        border: 1px solid #1a3a8f !important;
    }

    .form-floating > label { opacity: 0.7; }

    .fade-in { animation: fadeIn 0.6s ease-out; }
    .slide-up { animation: slideUp 0.6s ease-out; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
