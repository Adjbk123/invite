@extends('layouts.app')
@section('title','Portail des Formateurs')

@section('content')

{{-- Hero Section --}}
<section class="hero-section py-5 d-flex align-items-center">
    <div class="container py-lg-4 text-center">
        <div class="row justify-content-center fade-in">
            <div class="col-lg-8">
                <span class="badge bg-light text-primary px-3 py-2 rounded-pill mb-3 fw-bold border shadow-sm">
                    <i class="fas fa-calendar-check me-2"></i>Confirmation de Présence
                </span>
                <h1 class="display-4 fw-bold text-white mb-3 tracking-tight">
                    Votre participation compte
                </h1>
                <p class="lead text-white opacity-90 mb-0 mx-auto px-4" style="max-width: 650px; font-size: 1.1rem;">
                    Recherchez votre profil à l'aide de votre nom ou numéro de téléphone pour confirmer votre disponibilité et obtenir votre invitation.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Main Search Container --}}
<div class="container py-5 mt-n5 position-relative z-index-10">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">

            {{-- Card Recherche --}}
            <div class="search-container card shadow-2xl border-0 rounded-5 overflow-hidden slide-up">
                <div class="card-body p-4 p-md-5">
                    <form id="searchForm" action="{{ route('frontend.searchInvite') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-9">
                                <div class="input-modern-group">
                                    <i class="fas fa-search input-search-icon"></i>
                                    <input type="text"
                                           name="query"
                                           class="form-control form-control-xl input-modern"
                                           placeholder="Votre nom complet ou N° de téléphone..."
                                           value="{{ $query ?? '' }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button id="searchBtn" type="submit" class="btn btn-primary btn-xl w-100 rounded-4 shadow-lg btn-animate">
                                    <span class="btn-text">Rechercher</span>
                                    <span class="spinner-border spinner-border-sm ms-2 d-none"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Alert --}}
            <div class="mt-5 text-center fade-in delay-1">
                <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-pill bg-white shadow-sm border px-4">
                    <div class="info-pulse me-3"></div>
                    <span class="text-muted small fw-medium">
                        Indiquez votre statut : <strong>Disponible</strong> pour télécharger votre carte.
                    </span>
                </div>
            </div>

            {{-- Résultats --}}
            @isset($formateurs)
                <div class="mt-5 slide-up">
                    @if($formateurs->count() > 0)
                        <div class="results-header d-flex align-items-center justify-content-between mb-4">
                            <h4 class="fw-bold mb-0 text-navy">Résultats trouvés</h4>
                            <span class="text-muted small">{{ $formateurs->count() }} résultat(s) correspondant(s)</span>
                        </div>

                        <div class="row g-4">
                            @foreach($formateurs as $formateur)
                                <div class="col-12">
                                    <div class="card card-result border-0 shadow-sm rounded-4 overflow-hidden">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-circle me-3">
                                                            {{ strtoupper(substr($formateur->nom, 0, 1)) }}
                                                        </div>
                                                        <div>
                                                            <h5 class="fw-bold mb-1">{{ $formateur->nom }}</h5>
                                                            <p class="text-muted small mb-0"><i class="fas fa-phone-alt me-1"></i> {{ $formateur->numero ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-7 text-md-end mt-3 mt-md-0">
                                                    @if($formateur->statut_modifie)
                                                        @if(strtolower($formateur->statut) === 'disponible')
                                                            <div class="status-badge status-dispo">
                                                                <i class="fas fa-check-circle me-2"></i>Disponible — Carte Générée
                                                            </div>
                                                        @else
                                                            <div class="status-badge status-indispo">
                                                                <i class="fas fa-times-circle me-2"></i>Indisponible
                                                            </div>
                                                        @endif
                                                    @else
                                                        <form action="{{ route('frontend.updateStatus') }}" method="POST" class="statut-form">
                                                            @csrf
                                                            <input type="hidden" name="formateur_id" value="{{ $formateur->id }}">
                                                            <div class="d-flex gap-2 justify-content-md-end">
                                                                <button type="button" class="btn btn-outline-success rounded-pill px-4 btn-statut" onclick="confirmStatut(this, 'Disponible')">
                                                                    <i class="fas fa-check me-1"></i> Disponible
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger rounded-pill px-4 btn-statut" onclick="confirmStatut(this, 'Indisponible')">
                                                                    <i class="fas fa-times me-1"></i> Indisponible
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-results shadow-sm border-0 rounded-5 p-5 text-center bg-white">
                            <div class="mb-4">
                                <i class="far fa-frown fa-4x text-muted opacity-25"></i>
                            </div>
                            <h4 class="fw-bold text-navy">Aucun résultat trouvé</h4>
                            <p class="text-muted">Nous n'avons trouvé aucun invité correspondant à votre recherche.</p>
                            <a href="{{ url('/') }}" class="btn btn-link text-primary mt-2">Réinitialiser la recherche</a>
                        </div>
                    @endif
                </div>
            @endisset
        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

    :root {
        --primary-color: #0d6efd;
        --navy-color: #1a3a8f;
        --soft-bg: #f8fafc;
    }

    body {
        font-family: 'Outfit', sans-serif;
        background-color: var(--soft-bg);
        color: #334155;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--navy-color) 0%, #2563eb 100%);
        min-height: 40vh;
        border-radius: 0 0 50px 50px;
        position: relative;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
        pointer-events: none;
    }

    .text-navy { color: var(--navy-color); }
    .mt-n5 { margin-top: -80px !important; }
    .z-index-10 { z-index: 10; }

    /* Inputs */
    .input-modern-group {
        position: relative;
    }

    .input-modern {
        height: 60px;
        padding-left: 55px;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .input-modern:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .input-search-icon {
        position: absolute;
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.2rem;
    }

    .btn-xl {
        height: 60px;
        font-weight: 700;
        font-size: 1.1rem;
    }

    /* Cards */
    .card-result {
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .card-result:hover {
        transform: scale(1.01);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
    }

    .avatar-circle {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color), var(--navy-color));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }

    /* Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .status-dispo {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .status-indispo {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    /* Animations */
    .fade-in { animation: fadeIn 0.8s ease-out; }
    .slide-up { animation: slideUp 0.8s ease-out; }
    .delay-1 { animation-delay: 0.2s; animation-fill-mode: both; }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .info-pulse {
        width: 10px;
        height: 10px;
        background-color: var(--primary-color);
        border-radius: 50%;
        box-shadow: 0 0 0 rgba(13, 110, 253, 0.4);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
    }
</style>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
document.getElementById('searchForm').addEventListener('submit', function() {
    let btn = document.getElementById('searchBtn');
    btn.querySelector('.btn-text').textContent = "Traitement...";
    btn.querySelector('.spinner-border').classList.remove('d-none');
    btn.disabled = true;
});

function confirmStatut(btn, statut) {
    const row = btn.closest('.card-result');
    const nom = row.querySelector('h5').textContent;
    const formateurId = btn.closest('.statut-form').querySelector('input[name="formateur_id"]').value;

    Swal.fire({
        title: `Bonjour ${nom.split(' ')[0]} !`,
        html: statut === 'Disponible'
            ? `Confirmez-vous être <b>DISPONIBLE</b> ? <br><small class='text-muted'>Votre carte d'invitation sera prête immédiatement.</small>`
            : `Confirmez-vous être <b>INDISPONIBLE</b> ?`,
        icon: statut === 'Disponible' ? 'success' : 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, confirmer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: statut === 'Disponible' ? '#22c55e' : '#ef4444',
        borderRadius: '20px'
    }).then((result) => {
        if (result.isConfirmed) {
            handleAjaxUpdate(formateurId, statut, row);
        }
    });
}

function handleAjaxUpdate(id, statut, cardEl) {
    fetch("{{ route('frontend.updateStatus') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ formateur_id: id, statut: statut }),
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            updateUICard(cardEl, data.statut);
            if (data.statut === 'disponible') {
                confetti({ particleCount: 150, spread: 70, origin: { y: 0.6 } });
                setTimeout(() => downloadFile(data.download_url), 800);
            }
            Swal.fire({ icon: 'success', title: 'Confirmé !', text: data.message, timer: 3000, showConfirmButton: false });
        } else {
            Swal.fire({ icon: 'error', title: 'Erreur', text: data.message });
        }
    })
    .catch(() => {
        Swal.fire({ icon: 'error', title: 'Oups !', text: 'Une erreur réseau est survenue.' });
    });
}

function updateUICard(cardEl, statut) {
    const actionArea = cardEl.querySelector('.col-md-7');
    if (statut === 'disponible') {
        actionArea.innerHTML = `<div class="status-badge status-dispo"><i class="fas fa-check-circle me-2"></i>Disponible — Carte Générée</div>`;
    } else {
        actionArea.innerHTML = `<div class="status-badge status-indispo"><i class="fas fa-times-circle me-2"></i>Indisponible</div>`;
    }
}

function downloadFile(url) {
    const link = document.createElement('a');
    link.href = url;
    link.download = '';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

@endsection
