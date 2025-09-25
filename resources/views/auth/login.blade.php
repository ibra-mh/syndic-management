
<style>
    html, body {
        min-height: 100vh;
        height: 100%;
        margin: 0;
        padding: 0;
        background: #f5f6fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .syndic-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 400px;
        width: 100%;
        margin: 2rem auto;
        text-align: center;
    }
    .syndic-logo {
        font-size: 2.5rem;
        color: #7c3aed;
        margin-bottom: 0.5rem;
    }
    .syndic-title {
        font-size: 2rem;
        font-weight: 700;
        color: #7c3aed;
        margin-bottom: 0.5rem;
    }
    .syndic-subtitle {
        color: #6b7280;
        margin-bottom: 2rem;
    }
    .syndic-btn {
        background: #7c3aed;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.2s;
        margin-top: 1rem;
        cursor: pointer;
    }
    .syndic-btn:hover {
        background: #5b21b6;
    }
    .syndic-link {
        color: #7c3aed;
        text-decoration: underline;
        font-size: 0.95rem;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.25rem;
        display: block;
        text-align: left;
    }
    .form-control {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        margin-bottom: 0.5rem;
        font-size: 1rem;
        box-sizing: border-box;
    }
    .form-check-input {
        margin-right: 0.5rem;
    }
    .form-check-label {
        font-size: 0.97rem;
    }
    .invalid-feedback {
        color: #e53e3e;
        font-size: 0.95rem;
        text-align: left;
        margin-bottom: 0.5rem;
    }
</style>

<div class="syndic-card">
    <div class="syndic-logo">
        <i class="fas fa-building"></i>
    </div>
    <div class="syndic-title">Syndic Pro</div>
    <div class="syndic-subtitle">Connexion à votre espace</div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" style="text-align:left;">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Se souvenir de moi</label>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="syndic-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            @endif
            <button type="submit" class="syndic-btn">Connexion</button>
        </div>
    </form>
    <div class="mt-3">
        <span>Pas encore de compte ? </span>
        <a href="{{ route('register') }}" class="syndic-link">Inscription</a>
    </div>
</div>
