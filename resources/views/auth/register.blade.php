
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
    <div class="syndic-subtitle">Créer un compte</div>

    <form method="POST" action="{{ route('register') }}" style="text-align:left;">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('login') }}" class="syndic-link">Déjà inscrit ?</a>
            <button type="submit" class="syndic-btn">Inscription</button>
        </div>
    </form>
</div>
