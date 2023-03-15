@extends('layout.app')

@section('main')
    <main class="container main">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <h1 class="prihlaseniePrihlasenie">Prihlásenie</h1>

                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Heslo</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div><a id="prihlasenieZabudnuteHeslo" href="#">Zabudli ste svoje heslo?</a></div>
                    </div>
                    <button type="submit" id="btnPrihlasitSa" class="btn btn-lg btn-block">Prihlásiť sa</button>
                </form>
                <a id="prihlasenieRegistracia" href="/register">Registrácia</a>
            </div>
        </div>
    </main>
@endsection
