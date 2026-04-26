@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- 🔔 Messages flash -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <!-- Titre -->
            <div class="text-center mb-4 fade-in">
                <h2 class="fw-bold" style="color:#2c3e50;">Inscription</h2>
                <p class="text-muted">Créez votre compte pour accéder à votre espace personnel</p>
            </div>

            <!-- Carte animée -->
            <div class="card shadow-lg border-0 rounded-4 fade-in-up">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nom complet') }}</label>
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                            <input id="password-confirm" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- Bouton -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold rounded-3">
                                {{ __('S\'inscrire') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lien connexion -->
            <div class="text-center mt-3 fade-in">
                <small class="text-muted">Vous avez déjà un compte ?</small>
                <a href="{{ route('frontend.login') }}" class="fw-bold text-decoration-none">Se connecter</a>
            </div>
        </div>
    </div>
</div>

<!-- 🎨 Animation CSS -->
<style>
    .fade-in {
        opacity: 0;
        animation: fadeIn 1s ease forwards;
    }

    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s ease forwards;
    }

    @keyframes fadeIn {
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
