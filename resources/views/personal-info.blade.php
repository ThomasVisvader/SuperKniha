@extends('layout.app')
@section('main')
    <main class="container main">

        <h1 class="col-12" id="filterTitleMain">Pokladňa - Krok 3/4</h1>

        <div class="row">
            <div class="col-12">

                <form method="post" action="{{route('setPersonalInfo')}}">
                    @csrf
                    <div class="form-row pokladnaFormular">
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularMeno">Meno</label>
                            <input type="text" class="form-control" id="pokladnaFormularMeno" placeholder="napr. Jožko" maxlength="255" required name="name" @if(isset($data['name'])) value='{{$data['name']}}' @elseif(isset($user)) value='{{$user['name']}}' @endif >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularPriezvisko">Priezvisko</label>
                            <input type="text" class="form-control" id="pokladnaFormularPriezvisko" placeholder="napr. Mrkvička" maxlength="255" name="surname" required @if(isset($data['surname'])) value='{{$data['surname']}}' @elseif(isset($user)) value='{{$user['surname']}}' @endif >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularTelCislo">Telefónne číslo</label>
                            <input type="tel" class="form-control" id="pokladnaFormularTelCislo" placeholder="vo formáte +4219xxxxxxxx, bez medzier" maxlength="15" name="phone_number" pattern="([0]|\+421)[9][0-9]{8}"  required @if(isset($data['phone_number'])) value='{{$data['phone_number']}}' @elseif(isset($user)) value='{{$user['phone_number']}}' @endif >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularEmail">E-mail</label>
                            <input type="email" class="form-control" id="pokladnaFormularEmail" maxlength="255" placeholder="napr. meno@domena.sk" required name="email" @if(isset($data['email'])) value='{{$data['email']}}' @elseif(isset($user)) value='{{$user['email']}}' @endif >
                        </div>
                    </div>

                    <div class="form-row pokladnaFormular">
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularAdresa">Adresa</label>
                            <input type="text" class="form-control" id="pokladnaFormularAdresa" placeholder="napr. Zelená 15" maxlength="255" required name="address" @if(isset($data['address'])) value='{{$data['address']}}' @elseif(isset($user)) value='{{$user['address']}}' @endif >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularMesto">Mesto</label>
                            <input type="text" class="form-control" id="pokladnaFormularMesto" placeholder="napr. Bratislava" maxlength="255" required name="city" @if(isset($data['city'])) value='{{$data['city']}}' @elseif(isset($user)) value='{{$user['city']}}'  @endif >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularPSC">PSČ</label>
                            <input type="tel" class="form-control" id="pokladnaFormularPSC" placeholder="zadávajte bez medzery" maxlength="5" pattern="[0-9]{5}" required name="postal_code" @if(isset($data['postal_code'])) value='{{$data['postal_code']}}' @elseif(isset($user)) value='{{$user['postal_code']}}' @endif >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pokladnaFormularStat">Štát</label>
                            <input type="text" class="form-control" id="pokladnaFormularStat" placeholder="napr. Slovensko" maxlength="100" required name="country" @if(isset($data['country'])) value='{{$data['country']}}' @elseif(isset($user)) value='{{$user['country']}}'  @endif >
                        </div>
                    </div>

                    <div class="row justify-content-between align-items-center">
                        <div class="col-6 p-0">
                            <button class="btn" id="btnPokladnaSpat" name="Button" value="Back" type="submit" >
                                Späť
                            </button>
                        </div>
                        <div class="d-flex col-6 justify-content-end p-0">
                            <button class="btn" id="btnPokladnaPokracovat" name="Button" value="Next" type="submit">
                                Pokračovať
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>



    </main>
@endsection
