@extends('layouts.app')

@section('title', 'Nouveau mot de passe')

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
        padding-top: 60px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
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

    .form-group {
        margin-bottom: 20px;
        position: relative;
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
            <h2>Nouveau mot de passe</h2>
            <p>Définissez votre nouveau mot de passe sécurisé</p>
        </div>
        
        <div class="auth-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email (hidden or disabled usually, but needed for submission) --}}
                <div class="form-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" placeholder="Nouveau mot de passe" required autocomplete="new-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <i class="fas fa-check-double input-icon"></i>
                    <input id="password-confirm" type="password" class="form-control" 
                           name="password_confirmation" placeholder="Confirmer le mot de passe" required autocomplete="new-password">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-auth">
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
