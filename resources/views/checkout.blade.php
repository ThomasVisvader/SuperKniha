@extends('layout.app')
@section('main')
    <main class="container main">

        <h1 class="col-12" id="filterTitleMain">Pokladňa - Krok 4/4</h1>

        <!-- Produkt -->
        @foreach ($products as $product)
        <div class="col-12 justify-content-between align-items-center">

            <div class="row produkt align-items-center">
                <div class="col-4 col-sm-5 col-md-3">
                    <img src="/storage/images/w-150/{{$product['product']['image']}}" alt="Obálka knihy {{$product['product']['title']}}"
                         srcset="/storage/images/w-75/{{$product['product']['image']}} 75w, /storage/images/w-150/{{$product['product']['image']}} 150w"
                         sizes="(min-width: 576px) 150px, 75px" class="pokladnaObrazok">
                </div>

                <div class="d-block d-md-flex col-8 col-sm-7 col-md-9 align-items-center">

                    <div class="col-12 col-md-6 col-lg-5 p-0">
                        <h2 class="triBodky">
                            <a class="produktNazov scrollbarLink" href="{{route('product', ['id' => $product['product']['product_id']])}}" data-toggle="tooltip" title="Obálka knihy {{$product['product']['title']}}">{{$product['product']['title']}}</a>
                        </h2>
                        <div class="triBodky" data-toggle="tooltip" title="{{$product['product']['author']}}">{{$product['product']['author']}}</div>
                        @if (isset ($product['product']['discounted_price']))
                            <div>
                                <span class='produktCena'>
                                    {{ str_replace('.', ',', $product['product']['discounted_price']) }}€
                                </span>
                            </div>
                        @else
                            <div>
                                <span class='produktCena'>
                                    {{ str_replace('.', ',', $product['product']['price']) }}€
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex col-12 col-md-6 col-lg-7 align-items-center p-0">
                        <div class="col-6 d-block d-md-flex justify-content-center p-0">
                            <form class="d-flex align-items-center">
                                <input disabled type="number" class="inputMnozstvoDis" id="inputMnozstvo1" min="1" max="9" value={{$product['quantity']}}>
                            </form>
                        </div>

                        <div class="col-6 d-flex justify-content-center p-0">
                            <div class="pokladnaCena">{{ str_replace('.', ',', $product['price']) }}€</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        @endforeach


        <div class="row pokladnaDoprava">
            <div class="col-9 d-flex justify-content-start justify-content-sm-end">
                <div>Spôsob dopravy: <span class="pokladnaSposob">{{$delivery['title']}}</span></div>
            </div>
            <div class="col-3 d-flex justify-content-center p-0">
                <div>{{ str_replace('.', ',', $delivery['price']) }}€</div>
            </div>
        </div>

        <div class="row pokladnaPlatba">
            <div class="col-9 d-flex justify-content-start justify-content-sm-end">
                <div>Spôsob platby: <span class="pokladnaSposob">{{$payment['title']}}</span></div>
            </div>
            <div class="col-3 d-flex justify-content-center p-0">
                <div>
                    @if ($payment['price'] == 0)
                        zadarmo
                    @else
                        {{ str_replace('.', ',', $payment['price']) }}€
                    @endif
                </div>
            </div>
        </div>

        <div class="row pokladnaCelkovaCena">
            <div class="col-9 d-flex justify-content-start justify-content-sm-end">
                <div>Celková cena:</div>
            </div>
            <div class="col-3 d-flex justify-content-center p-0">
                <div>{{ str_replace('.', ',', $total_price) }}€</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 pokladnaTextGroup">
                <div class="pokladnaAdresa">Adresa doručenia: </div>
                <div>{{$name}} {{$surname}}</div>
                <div>{{$address}}</div>
                <div>{{$postal_code}} {{$city}}</div>
                <div>{{$country}}</div>
            </div>

            <div class="col-12 col-sm-6 pokladnaTextGroup">
                <div class="pokladnaKontakt">Kontaktné údaje: </div>
                <div><span class="pokladnaKontakt">Tel. číslo: </span>{{$phone_number}}</div>
                <div><span class="pokladnaKontakt">E-mail: </span>{{$email}}</div>
            </div>
        </div>

        <form method="POST" action="{{route('placeOrder')}}">
            @csrf
            <div class="form-check pokladnaPodmienky">
                <input class="form-check-input" type="checkbox" value="" id="pokladnaObchodnePodmienky" required>
                <label class="form-check-label" for="pokladnaObchodnePodmienky">
                    Súhlasím s obchodnými podmienkami
                </label>
            </div>

            <div class="row justify-content-between align-items-center">
                <div class="col-4 col-sm-6 p-0">
                    <a class="btn" id="btnPokladnaSpat" href="{{route('personalInfo')}}">
                        Späť
                    </a>
                </div>
                <div class="d-flex col-8 col-sm-6 justify-content-end p-0">
                    <button class="btn" id="btnPokladnaPokracovat" type="submit">
                        Dokončiť objednávku
                    </button>
                </div>
            </div>
        </form>

    </main>
@endsection
