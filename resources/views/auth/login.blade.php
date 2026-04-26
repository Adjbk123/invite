@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<style>
    /* Style spécifique pour la page de connexion */
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 450px;
    }

    .login-header {
        background: linear-gradient(135deg, #1a3a8f, #0d6efd);
        padding: 40px 20px;
        text-align: center;
        color: white;
    }

    .login-header h2 {
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .login-header p {
        font-size: 14px;
        opacity: 0.8;
    }

    .login-body {
        padding: 40px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-control {
        height: 50px;
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

    .btn-login {
        height: 50px;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #1a3a8f, #0d6efd);
        border: none;
        color: white;
        width: 100%;
        transition: all 0.3s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        color: white;
    }

    .login-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 14px;
    }

    .login-footer a {
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

<div class="login-container">
    <div class="login-card fade-up">
        <div class="login-header">
            <h2>Bienvenue</h2>
            <p>Connectez-vous pour accéder à votre espace</p>
        </div>
        
        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" 
                           placeholder="Adresse e-mail"
                           required autocomplete="email" autofocus>
                    
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
                           required autocomplete="current-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember" style="font-size: 14px; color: #666;">
                            Se souvenir de moi
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    Se connecter
                </button>

                <div class="login-footer">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                    
                    @if (Route::has('register'))
                        <div class="mt-3">
                            Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
