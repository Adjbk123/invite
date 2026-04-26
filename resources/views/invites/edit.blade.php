@extends('layouts.admin')
@section('title', 'Modifier Participant')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4 fade-in">
                <div>
                    <h2 class="fw-bold mb-1 text-navy"><i class="fas fa-edit me-2"></i>Modifier le Participant</h2>
                    <p class="text-muted mb-0">Mettez à jour les informations et le statut de <strong>{{ $formateur->nom }}</strong>.</p>
                </div>
                <a href="{{ route('informaticien.gestinvites.invites.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-chevron-left me-2"></i>Retour
                </a>
            </div>

            <div class="row g-4">
                {{-- Left Side: Infos Générales --}}
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100 slide-up">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                            <h5 class="fw-bold text-navy mb-0"><i class="fas fa-info-circle me-2"></i>Informations générales</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('informaticien.gestinvites.invites.update', $formateur->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label class="form-label text-muted small fw-bold">NOM COMPLET</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="fas fa-user text-muted"></i></span>
                                        <input type="text" name="nom" class="form-control bg-light border-0 @error('nom') is-invalid @enderror" 
                                               value="{{ old('nom', $formateur->nom) }}" required>
                                    </div>
                                    @error('nom') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label text-muted small fw-bold">TÉLÉPHONE</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-muted"></i></span>
                                        <input type="text" name="numero" class="form-control bg-light border-0 @error('numero') is-invalid @enderror" 
                                               value="{{ old('numero', $formateur->numero) }}">
                                    </div>
                                    @error('numero') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label text-muted small fw-bold">NUMÉRO DE TABLE</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="fas fa-chair text-muted"></i></span>
                                        <input type="text" name="numero_table" class="form-control bg-light border-0 @error('numero_table') is-invalid @enderror" 
                                               value="{{ old('numero_table', $formateur->numero_table) }}">
                                    </div>
                                    @error('numero_table') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-navy py-3 fw-bold rounded-3">
                                        <i class="fas fa-save me-2"></i>Sauvegarder les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Statut & Quick Actions --}}
                <div class="col-md-5">
                    {{-- Status Card --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4 slide-up delay-1">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                            <h5 class="fw-bold text-navy mb-0"><i class="fas fa-toggle-on me-2"></i>Statut de présence</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4 p-3 rounded-4 bg-light border">
                                @if($formateur->statut === 'disponible')
                                    <div class="display-6 text-success"><i class="fas fa-check-circle"></i></div>
                                    <div class="fw-bold text-success text-uppercase">Disponible</div>
                                @elseif($formateur->statut === 'indisponible')
                                    <div class="display-6 text-danger"><i class="fas fa-times-circle"></i></div>
                                    <div class="fw-bold text-danger text-uppercase">Indisponible</div>
                                @else
                                    <div class="display-6 text-warning"><i class="fas fa-clock"></i></div>
                                    <div class="fw-bold text-warning text-uppercase">En attente</div>
                                @endif
                            </div>

                            <form action="{{ route('informaticien.gestinvites.invites.update', $formateur->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <select name="statut" class="form-select bg-light border-0 py-3 rounded-3 fw-bold" required>
                                        <option value="">— Modifier le statut —</option>
                                        <option value="disponible" {{ $formateur->statut === 'disponible' ? 'selected' : '' }}>✅ Disponible</option>
                                        <option value="indisponible" {{ $formateur->statut === 'indisponible' ? 'selected' : '' }}>❌ Indisponible</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-navy-outline w-100 py-3 fw-bold rounded-3">
                                    Valider le nouveau statut
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Help/Info --}}
                    <div class="card border-0 shadow-sm rounded-4 bg-navy text-white slide-up delay-2">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-2">Note sur le statut</h6>
                            <p class="small opacity-75 mb-0">Modifier le statut en "Disponible" permet immédiatement à l'invité de télécharger sa carte personnalisée.</p>
                        </div>
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
    .btn-navy:hover { background-color: #122a6b; color: white; }
    
    .btn-navy-outline { border: 2px solid #1a3a8f; color: #1a3a8f; background: transparent; transition: all 0.3s ease; }
    .btn-navy-outline:hover { background-color: #1a3a8f; color: white; }

    .input-group-text { border: none; }
    .form-control:focus, .form-select:focus {
        background-color: white !important;
        box-shadow: 0 0 0 4px rgba(26, 58, 143, 0.1) !important;
        border: 1px solid #1a3a8f !important;
    }

    .fade-in { animation: fadeIn 0.6s ease-out; }
    .slide-up { animation: slideUp 0.6s ease-out; }
    .delay-1 { animation-delay: 0.1s; animation-fill-mode: both; }
    .delay-2 { animation-delay: 0.2s; animation-fill-mode: both; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
