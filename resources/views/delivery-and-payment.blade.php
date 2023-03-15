@extends('layout.app')
@section('main')
    <main class="container main">

        <h1 class="col-12" id="filterTitleMain">Pokladňa - Krok 2/4</h1>

        <form method="post" action="{{route('setDeliveryPayment')}}">
            @csrf
            <h2 class="pokladnaZvolteSposobDopravy">Zvoľte spôsob dopravy</h2>
            <div class="row">
                <div class="col-12 p-0">
                    @foreach($delivery_methods as $delivery_method)
                        <div class="row">
                            <div class="col-9 col-sm-6 col-md-4">
                                <div class="form-check">
                                    <input @if($data['1'] == $delivery_method['id']) checked @endif required class="form-check-input" type="radio" name="SposobDopravy" id="SposobDopravy-{{$delivery_method['id']}}" value="{{$delivery_method['id']}}">
                                    <label class="form-check-label" for="SposobDopravy-{{$delivery_method['id']}}">
                                        {{$delivery_method['title']}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-3 p-0">
                                <div class="ZvolteSposobDopravyCena">{{$delivery_method['price']}}€</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <h2 class="pokladnaZvolteSposobPLatby">Zvoľte spôsob platby</h2>


            <div class="row">
                <div class="col-12 p-0">
                    @foreach($payment_methods as $payment_method)
                    <div class="row">
                        <div class="col-9 col-sm-6 col-md-4">
                            <div class="form-check">
                                <input @if($data['0'] == $payment_method['id']) checked @endif required class="form-check-input" type="radio" name="SposobPlatby" id="SposobPlatby-{{$payment_method['id']}}" value="{{$payment_method['id']}}">
                                <label class="form-check-label" for="SposobPlatby-{{$payment_method['id']}}">
                                    {{$payment_method['title']}}
                                </label>
                            </div>
                        </div>
                        <div class="col-3 p-0">
                            <div class="ZvolteSposobDopravyCena">{{$payment_method['price']}}€</div>
                        </div>
                    </div>
                    @endforeach
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
    </main>
@endsection

