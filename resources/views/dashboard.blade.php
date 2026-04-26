@extends('layouts.admin')
@section('title', 'Tableau de bord')
@section('content')
<div class="container py-4">
    @php
        $siteName = $parametres?->website_name ?? 'MAFLYT';
        $total = $disponible + $indisponible;
    @endphp

    <!-- Header -->
    <div class="mb-5 d-flex justify-content-between align-items-end">
        <div>
            <h1 class="fw-bold mb-0" style="color: #1a3a8f;">Vue d'ensemble</h1>
            <p class="text-muted mb-0"><i class="fas fa-calendar-check me-2"></i>Tableau de bord {{ $siteName }} — <span id="clock"></span></p>
        </div>
        <div>
             <a href="{{ route('informaticien.gestinvites.invites.index') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fas fa-users me-2"></i>Gérer les invités
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Total --}}
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary-light p-3 rounded-4 me-4">
                        <i class="fas fa-users-cog fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small fw-bold">Total Invités</h6>
                        <h2 class="fw-bold mb-0 counter" data-target="{{ $total }}">0</h2>
                    </div>
                </div>
                <div class="progress rounded-0" style="height: 5px;">
                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Disponible -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success-light p-3 rounded-4 me-4">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small fw-bold">Disponibles</h6>
                        <h2 class="fw-bold mb-0 text-success counter" data-target="{{ $disponible }}">0</h2>
                    </div>
                </div>
                <div class="progress rounded-0" style="height: 5px;">
                    <div class="progress-bar bg-success" style="width: {{ $total > 0 ? ($disponible/$total)*100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Indisponible -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-danger-light p-3 rounded-4 me-4">
                        <i class="fas fa-times-circle fa-2x text-danger"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase small fw-bold">Indisponibles</h6>
                        <h2 class="fw-bold mb-0 text-danger counter" data-target="{{ $indisponible }}">0</h2>
                    </div>
                </div>
                <div class="progress rounded-0" style="height: 5px;">
                    <div class="progress-bar bg-danger" style="width: {{ $total > 0 ? ($indisponible/$total)*100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Graphique -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0">Répartition des statuts</h5>
                </div>
                <div class="card-body p-4">
                    <div style="position: relative; height:300px;">
                        <canvas id="formateursChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Card --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-gradient-navy text-white h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                    <div class="mb-4">
                        <i class="fas fa-rocket fa-4x opacity-50"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Taux de réponse</h4>
                    <div class="display-4 fw-bold mb-3">{{ $total > 0 ? round(($disponible + $indisponible) / $total * 100) : 0 }}%</div>
                    <p class="opacity-75">Taux de confirmation des invités par rapport à la liste globale.</p>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
/* Modern Colors */
.bg-primary-light { background-color: rgba(13, 110, 253, 0.1); }
.bg-success-light { background-color: rgba(25, 135, 84, 0.1); }
.bg-danger-light { background-color: rgba(220, 53, 69, 0.1); }
.bg-gradient-navy { background: linear-gradient(135deg, #1a3a8f 0%, #0d6efd 100%); }

.card { transition: transform 0.3s ease; }
.card:hover { transform: translateY(-5px); }

/* Clock Style */
#clock { font-weight: 600; color: #1a3a8f; }
</style>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

// 🕒 Horloge temps réel
function updateClock() {
    const now = new Date();
    document.getElementById('clock').innerText =
        now.toLocaleDateString() + " — " + now.toLocaleTimeString();
}
setInterval(updateClock, 1000);
updateClock();

// 🔢 Animation compteur
document.querySelectorAll('.counter').forEach(counter => {
    const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;

        const increment = target / 50;

        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(updateCount, 20);
        } else {
            counter.innerText = target;
        }
    };

    updateCount();
});

// 📊 Graphique
const total = {{ $disponible }} + {{ $indisponible }};
const pourcentage = total > 0 ? Math.round(({{ $disponible }} / total) * 100) : 0;

const centerText = {
    id: 'centerText',
    beforeDraw(chart) {
        const { width } = chart;
        const { height } = chart;
        const ctx = chart.ctx;

        ctx.restore();
        ctx.font = "bold 18px sans-serif";
        ctx.textBaseline = "middle";

        const text = pourcentage + "% dispo";
        const textX = Math.round((width - ctx.measureText(text).width) / 2);
        const textY = height / 2;

        ctx.fillStyle = "#198754";
        ctx.fillText(text, textX, textY);
        ctx.save();
    }
};

const ctx = document.getElementById('formateursChart').getContext('2d');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Disponible', 'Indisponible'],
        datasets: [{
            data: [{{ $disponible }}, {{ $indisponible }}],
            backgroundColor: ['#198754', '#dc3545'],
            borderWidth: 0
        }]
    },
    options: {
        cutout: '70%',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    },
    plugins: [centerText]
});

</script>
@endsection
