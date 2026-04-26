@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .auth-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 80px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 450px;
    }

    .auth-header {
        background: linear-gradient(135deg, #1a3a8f, #0d6efd);
        padding: 40px 20px;
        text-align: center;
        color: white;
    }

    .auth-header h2 {
        font-weight: 700;
        margin-bottom: 10px;
    }

    .auth-body {
        padding: 40px;
    }

    .form-control {
        height: 50px;
        border-radius: 12px;
        padding-left: 45px;
        border: 1px solid #ddd;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 16px;
        color: #adb5bd;
    }

    .btn-auth {
        height: 50px;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #1a3a8f, #0d6efd);
        border: none;
        color: white;
        transition: all 0.3s;
    }

    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        color: white;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Récupération</h2>
            <p>Saisissez votre e-mail pour réinitialiser votre mot de passe</p>
        </div>
        
        <div class="auth-body">
            @if (session('status'))
                <div class="alert alert-success mb-4 text-center rounded-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4 position-relative">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" placeholder="Votre adresse e-mail" required autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-auth">
                        Envoyer le lien de réinitialisation
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none small fw-bold">Retour à la connexion</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
