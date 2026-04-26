@extends('layouts.admin')
@section('title', 'Gestion des Invités')
@section('content')

<div class="container-fluid py-4">

    {{-- ===== TITRE ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <i class="fas fa-users me-2 text-primary"></i> Gestion des Invités
        </h2>
    </div>

    {{-- ===== STATISTIQUES ===== --}}
    <div class="row mb-4 g-3">

        <div class="col-12 col-sm-4">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-success elevation-1">
                    <i class="fas fa-check-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Disponibles</span>
                    <span class="info-box-number" id="disponible-count">{{ $disponible }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-danger elevation-1">
                    <i class="fas fa-times-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Indisponibles</span>
                    <span class="info-box-number" id="indisponible-count">{{ $indisponible }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-warning elevation-1">
                    <i class="fas fa-clock"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">En attente</span>
                    <span class="info-box-number" id="attente-count">{{ $enAttente }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== ACTIONS ===== --}}
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <a href="{{ route('informaticien.gestinvites.invites.download.pdf') }}" class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> Télécharger PDF
        </a>
        <a href="{{ route('informaticien.gestinvites.invites.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Ajouter un invité
        </a>
        <button class="btn btn-warning" onclick="resetStatus()">
            <i class="fas fa-redo me-1"></i> Réinitialiser les statuts
        </button>
        <button class="btn btn-outline-danger ms-auto" onclick="deleteAll()">
            <i class="fas fa-trash-alt me-1"></i> Supprimer toutes les inscriptions
        </button>
    </div>

    {{-- ===== MESSAGES ===== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ===== TABLEAU ===== --}}
    <form id="delete-all-form" action="{{ route('informaticien.gestinvites.invites.deleteAll') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle datatable mb-0" id="invites-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Numéro</th>
                            <th>Table</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invites as $f)
                        <tr data-id="{{ $f->id }}">
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $f->nom }}</td>
                            <td>{{ $f->numero ?? '—' }}</td>
                            <td>{{ $f->numero_table ?? '—' }}</td>
                            <td class="statut-cell-td">
                                @php
                                    $badgeClass = 'badge bg-secondary';
                                    $label      = 'En attente';
                                    if($f->statut === 'disponible')   { $badgeClass = 'badge bg-success'; $label = 'Disponible'; }
                                    elseif($f->statut === 'indisponible') { $badgeClass = 'badge bg-danger';  $label = 'Indisponible'; }
                                @endphp
                                <span class="{{ $badgeClass }}">{{ $label }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('frontend.downloadCarte', $f->id) }}"
                                   class="btn btn-sm btn-success" title="Télécharger la carte d'invitation">
                                    <i class="fas fa-file-pdf"></i>
                                </a>

                                <a href="{{ route('informaticien.gestinvites.invites.edit', $f->id) }}"
                                   class="btn btn-sm btn-info" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('informaticien.gestinvites.invites.destroy', $f->id) }}"
                                      method="POST" class="d-inline btn-delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete"
                                            data-name="{{ $f->nom }}" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Aucun invité enregistré
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ===== SCRIPTS ===== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Confirmation suppression
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const nom  = this.getAttribute('data-name');
            Swal.fire({
                title: `Supprimer "${nom}" ?`,
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Suppression massive
    window.deleteAll = function() {
        Swal.fire({
            title: 'Tout supprimer ?',
            text: "Attention : vous allez supprimer l'intégralité des inscrits. Cette action est irréversible !",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#ff0000',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, TOUT supprimer !',
            cancelButtonText: 'Annuler'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('delete-all-form').submit();
            }
        });
    }

    // Réinitialisation des statuts
    window.resetStatus = function() {
        Swal.fire({
            title: 'Réinitialiser tous les statuts ?',
            text: "Tous les invités pourront à nouveau mettre à jour leur statut.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, réinitialiser !',
            cancelButtonText: 'Annuler'
        }).then(result => {
            if (result.isConfirmed) {
                fetch("{{ route('informaticien.gestinvites.invites.resetStatus') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                    // Mettre à jour visuellement tous les badges
                    document.querySelectorAll('#invites-table tbody .statut-cell-td span').forEach(badge => {
                        badge.textContent = 'En attente';
                        badge.className   = 'badge bg-secondary';
                    });

                    // Mettre à jour les compteurs
                    const dispoEl    = document.getElementById('disponible-count');
                    const indispoEl  = document.getElementById('indisponible-count');
                    const attenteEl  = document.getElementById('attente-count');
                    const total      = {{ $invites->count() }};

                    if (dispoEl)   dispoEl.textContent   = 0;
                    if (indispoEl) indispoEl.textContent  = 0;
                    if (attenteEl) attenteEl.textContent  = total;

                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: data.message,
                        timer: 2500,
                        showConfirmButton: false
                    });
                })
                .catch(() => {
                    Swal.fire('Erreur', 'Une erreur est survenue.', 'error');
                });
            }
        });
    }

});
</script>

@endsection
