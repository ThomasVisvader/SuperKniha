@extends('layout.app')
@section('main')
    <main class="container main">

        @if(isset($cart_size))
            <h1 class="col-12" id="filterTitleMain">Pokladňa - Krok 1/4</h1>
            <!-- Produkt -->
            @foreach($products as $product)
                <div class="col-12 justify-content-between align-items-center">

                    <div class="row produkt align-items-center">
                        <div class="col-4 col-md-3">
                            <img src="/storage/images/w-150/{{$product['product']['image']}}" alt="Obálka knihy {{$product['product']['title']}}"
                                 srcset="/storage/images/w-75/{{$product['product']['image']}} 75w, /storage/images/w-150/{{$product['product']['image']}} 150w"
                                 sizes="(min-width: 576px) 150px, 75px" class="pokladnaObrazok">
                        </div>

                        <div class="d-block d-md-flex col-8 col-md-9 align-items-center">

                            <div class="col-12 col-md-5 col-lg-4 p-0">
                                <h2 class="triBodky">
                                    <a class="produktNazov scrollbarLink" href="{{route('product', ['id' => $product['product']['product_id']])}}" data-toggle="tooltip" title='{{$product['product']['title']}}'>{{$product['product']['title']}}</a>
                                </h2>
                                <div class="triBodky" data-toggle="tooltip" title='{{$product['product']['author']}}'>{{$product['product']['author']}}</div>
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

                            <div class="d-flex col-12 col-md-7 col-lg-8 align-items-center p-0">
                                <div class="col-5 d-flex p-0">
                                    <form class="d-flex align-items-center" method="POST" action="{{ route('changeCart', ['id' => $product['product']['product_id']]) }}">
                                        @csrf
                                        <input type="hidden" name="quantity" value='-1'>
                                        <button class="btn btnMnozstvo" type="submit">-</button>
                                    </form>
                                        <span class="pokladnaMnozstvo">{{$product['quantity']}}</span>
                                    <form class="d-flex align-items-center" method="POST" action="{{ route('changeCart', ['id' => $product['product']['product_id']]) }}">
                                        @csrf
                                        <input type="hidden" name="quantity" value='1'>
                                        <button class="btn btnMnozstvo" type="submit">+</button>
                                    </form>
                                </div>

                                <div class="col-5 d-flex justify-content-center p-0">
                                    <div class="pokladnaCena">{{ str_replace('.', ',', $product['price']) }}€</div>
                                </div>

                                <form class="col-2 d-flex justify-content-center p-0" method="POST" action="{{ route('removeFromCart', ['id' => $product['product']['product_id']]) }}">
                                    @csrf
                                    <button class="btn btnPokladnaVyhodit" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x pokladnaX" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

            <div class="row justify-content-end align-items-center">
                <div class="pokladnaCelkovaCena">Celková cena: {{ str_replace('.', ',', $total_price) }}€</div>
            </div>

            <div class="row justify-content-end align-items-center p-0">
                <a class="btn" id="btnPokladnaPokracovat" href="{{route('deliveryAndPayment')}}">
                    Pokračovať
                </a>
            </div>

        @else
            <h1 class="col-12" id="filterTitleMain">Pokladňa - Váš košík je prázdny</h1>
        @endif


    </main>
@endsection

