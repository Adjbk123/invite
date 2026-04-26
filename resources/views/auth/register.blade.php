@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<style>
    /* Style spécifique pour la page d'inscription */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .register-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .register-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
    }

    .register-header {
        background: linear-gradient(135deg, #1a3a8f, #0d6efd);
        padding: 40px 20px;
        text-align: center;
        color: white;
    }

    .register-header h2 {
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .register-header p {
        font-size: 14px;
        opacity: 0.8;
    }

    .register-body {
        padding: 40px;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-control {
        height: 48px;
        border-radius: 12px;
        padding-left: 45px;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 15px;
        color: #adb5bd;
        font-size: 18px;
    }

    .btn-register {
        height: 50px;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #1a3a8f, #0d6efd);
        border: none;
        color: white;
        width: 100%;
        margin-top: 10px;
        transition: all 0.3s;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        color: white;
    }

    .register-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 14px;
    }

    .register-footer a {
        color: #0d6efd;
        text-decoration: none;
        font-weight: 600;
    }

    .invalid-feedback {
        font-size: 12px;
        margin-left: 5px;
    }

    /* Animation */
    .fade-up {
        animation: fadeUp 0.6s ease-out;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="register-container">
    <div class="register-card fade-up">
        <div class="register-header">
            <h2>Créer un compte</h2>
            <p>Inscrivez-vous pour rejoindre l'aventure</p>
        </div>
        
        <div class="register-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <i class="fas fa-user input-icon"></i>
                    <input id="name" type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" 
                           placeholder="Nom complet"
                           required autocomplete="name" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" 
                           placeholder="Adresse e-mail"
                           required autocomplete="email">
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" 
                           placeholder="Mot de passe"
                           required autocomplete="new-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <i class="fas fa-check-circle input-icon"></i>
                    <input id="password-confirm" type="password" 
                           class="form-control" 
                           name="password_confirmation" 
                           placeholder="Confirmer le mot de passe"
                           required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-register">
                    S'inscrire
                </button>

                <div class="register-footer">
                    Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
