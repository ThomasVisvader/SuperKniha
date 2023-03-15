@extends('layout.app')

@section('main')
    <main class="container main">
        <div class="row">
            <div class="h1 col-12" id="filterTitleMain">Profil</div>
        </div>

        <div class="row">
            <div class="col-12 justify-content-between align-items-center">

                <form method="POST" action="{{ route('update_profile', ['id' => $user['id']]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-row profil">
                        <div class="col-md-6 mb-3">
                            <label for="profilMeno">Meno</label>
                            <input type="text" class="form-control" id="profilMeno" name="name" maxlength="255" value="{{$user['name']}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profilPriezvisko">Priezvisko</label>
                            <input type="text" class="form-control" id="profilPriezvisko" name="surname" maxlength="255" value="{{$user['surname']}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profilTelCislo">Telefónne číslo</label>
                            <input type="text" class="form-control" id="profilTelCislo" name="phone_number" maxlength="15" pattern="([0]|\+421)[9][0-1][0-9]{7}" value="{{$user['phone_number']}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profilEmail">E-mail</label>
                            <input type="email" class="form-control" id="profilEmail" name="email" maxlength="255" value="{{$user['email']}}" required>
                        </div>
                    </div>
                    <div class="form-row profil">
                        <div class="col-md-6 mb-3">
                            <label for="profilAdresa">Adresa</label>
                            <input type="text" class="form-control" id="profilAdresa" name="address" maxlength="255" value="{{$user['address']}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profilMesto">Mesto</label>
                            <input type="text" class="form-control" id="profilMesto" name="city" maxlength="255" value="{{$user['city']}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profilPSC">PSČ</label>
                            <input type="text" class="form-control" id="profilPSC" name="postal_code" maxlength="5" pattern="[0-9]{5}" value="{{$user['postal_code']}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profilStat">Štát</label>
                            <input type="text" class="form-control" id="profilStat" name="country" maxlength="100" value="{{$user['country']}}">
                        </div>
                    </div>

                    <div class="row justify-content-end align-items-center">
                        <button class="btn btn-lg" id="btnProfilUlozitZmeny" type="submit">
                            Uložiť zmeny
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </main>
@endsection
