@extends('layout.app')

@section('main')

    <main class='container main'>
        <div class='row justify-content-center'>

            <!-- Obrazky -->
            <div class='col-7 col-sm-5 col-md-4 justify-content-center'>
                <div id='detailCarousel' class='carousel slide' data-ride='carousel' data-interval='false'>
                    <ol class='carousel-indicators'>
                        @for ($i = 0; $i < sizeof($images); $i++)
                            <li data-target='#detailCarousel' data-slide-to='{{$i}}' @if ($i === 0) class='active' @endif></li>
                        @endfor
                    </ol>
                    <div class='carousel-inner'>
                        @for ($i = 0; $i < sizeof($images); $i++)
                            <div @if ($i === 0) class='carousel-item active' @else class='carousel-item' @endif>
                                <img src="/storage/images/w-250/{{$images[$i]['image']}}" alt="Obálka knihy {{$product['title']}}"
                                     srcset="/storage/images/w-150/{{$images[$i]['image']}} 150w, /storage/images/w-250/{{$images[$i]['image']}} 250w"
                                     sizes="(min-width: 400px) 250px, 150px" class="d-block detailObrazok">
                            </div>
                        @endfor
                    </div>
                    <a class='carousel-control-prev' href='#detailCarousel' role='button' data-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Previous</span>
                    </a>
                    <a class='carousel-control-next' href='#detailCarousel' role='button' data-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                        <span class='sr-only'>Next</span>
                    </a>
                </div>
            </div>

            <!-- Produkt -->
            <div class='col-5 col-sm-7 col-md-6 pt-2'>
                <h1 class='detailNazovProduktu'>{{$product['title']}}</h1>
                @if (isset ($product['series']))
                    <div class='detailSeria'>{{$product['series']}}  {{$product['volume']}}</div>
                @endif
                <div class='detailAutor'>{{$product['author']}}</div>
                <div class='detailCena'>
                    @if (isset ($product['discounted_price']))
                    <span class='povodnaCena'>
                        {{ str_replace('.', ',', $product['price']) }}€
                    </span>
                        {{ str_replace('.', ',', $product['discounted_price']) }}€
                    @else
                        {{ str_replace('.', ',', $product['price']) }}€
                    @endif
                </div>
                @if (isset ($available))
                    @if ($available > 0)
                        <div class='detailDostupnost'>
                            Dostupnosť: na sklade
                        </div>
                        <form class='d-none d-mn-block d-md-flex align-items-center' method="POST" action="{{route('add_to_cart', ['id' => $product['id']])}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">

                            <label for='inputMnozstvo' class='detailMnozstvo'>Množstvo:</label>
                            <input type='number' class='inputMnozstvo' id='inputMnozstvo' name="quantity" min='1' max='{{$available}}' value='1' >
                            <button class='btn produktBTNDoKosika' id='detailBTNDoKosika' type='submit'>Vložiť do košíka</button>
                        </form>
                    @else
                        <div class='detailDostupnost'>
                            Dostupnosť: nedostupné
                        </div>
                    @endif
                @else
                    <form class='d-none d-mn-block d-md-flex align-items-center' method="POST" action="{{ route('add_to_cart', ['id' => $product['id']]) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <label for='inputMnozstvo' class='detailMnozstvo'>Množstvo:</label>
                        <input type='number' class='inputMnozstvo' id='inputMnozstvo' name="quantity" min='1' max='9' value='1' >
                        <button class='btn produktBTNDoKosika' id='detailBTNDoKosika' type='submit'>Vložiť do košíka</button>
                    </form>
                @endif
                @canany(['edit', 'delete'], \App\Models\Product::class)
                    <div class="d-none d-mn-flex">
                        <a class="btn produktBTNUpravitProdukt" href="{{route('editProduct', ['id' => $product['id']])}}">
                            Upraviť produkt
                        </a>
                        <form method="POST" action={{ route('deleteProduct', ['id' => $product['id']]) }}>
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn produktBTNOdstranitProdukt" name="odstranitProdukt" >
                                Odstrániť produkt
                            </button>
                        </form>
                    </div>
                @endcanany
            </div>
        </div>

        <!-- Mini -->
        <div class="d-flex">
            @if (isset ($available))
                @if ($available > 0)
                    <form class='d-block d-mn-none col-6 pt-3' method="POST" action="{{ route('add_to_cart', ['id' => $product['id']]) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div>
                            <label for='inputMnozstvo' class='detailMnozstvo'>Množstvo:</label>
                            <input type='number' class='inputMnozstvo' id='inputMnozstvo' name="quantity" min='1' max='{{$available}}' value='1' >
                        </div>
                        <div>
                            <button class='btn produktBTNDoKosika' id='detailBTNDoKosika' type='submit'>Vložiť do košíka</button>
                        </div>
                    </form>
                @endif
            @else
                <form class='d-block d-mn-none col-6 pt-3' method="POST" action="{{ route('add_to_cart', ['id' => $product['id']]) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <label for='inputMnozstvo' class='detailMnozstvo'>Množstvo:</label>
                    <input type='number' class='inputMnozstvo' id='inputMnozstvo' name="quantity" min='1' max='9' value='1' >
                    <button class='btn produktBTNDoKosika' id='detailBTNDoKosika' type='submit'>Vložiť do košíka</button>
                </form>
            @endif
            @canany(['edit', 'delete'], \App\Models\Product::class)
                <div class="d-block d-mn-none col-6 pt-3">
                    <a class="btn produktBTNUpravitProdukt" href="{{route('editProduct', ['id' => $product['id']])}}">
                        Upraviť produkt
                    </a>
                    <form method="POST" action={{ route('deleteProduct', ['id' => $product['id']]) }}>
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn produktBTNOdstranitProdukt" name="odstranitProdukt" >
                            Odstrániť produkt
                        </button>
                    </form>
                </div>
            @endcanany
        </div>

        <!--- Obsah -->
        <div class='row justify-content-center pt-5' >
            <div class='col-12 col-md-10'>
                <h2 class='detailPodnadpis'>Obsah:</h2>
                @if (strlen($product['description']) > 500)
                    <p class='detailText detailLimitedText' id='detailObsahCast'>{{ mb_substr($product['description'], 0, 500, 'UTF-8')}}...</p>
                    <p class='detailText detailLimitedText detailTextNone' id='detailObsahCely'>{{$product['description']}}</p>
                    <button class="detailBoldText" id="detailZobrazitViac" onclick="showMore()">Zobraziť viac</button>
                @else
                    <p class='detailText detailLimitedText detailTextNone' id='detailObsahCast'>{{ mb_substr($product['description'], 0, 500, 'UTF-8')}}</p>
                    <p class='detailText detailLimitedText' id='detailObsahCely'>{{$product['description']}}</p>
                @endif
            </div>
        </div>

        <div class='row justify-content-center mt-5'>

            <!-- Podrobnosti -->
            <div class='col-12 col-sm-6 col-md-5'>
                <h2 class='detailPodnadpis'>Podrobnosti:</h2>

                <table class="table">
                    <tbody><tr>
                        <th scope="row">
                            @switch ($product['type'])
                                @case('kniha')
                                    Názov knihy
                                    @break
                                @case('audiokniha')
                                    Názov audioknihy
                                    @break
                                @case('ekniha')
                                    Názov e-knihy
                                    @break
                                @case('hudba')
                                    Názov albumu
                                    @break
                                @case('film')
                                    Názov filmu
                                    @break
                            @endswitch
                        </th>
                        <td>{{$product['title']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">
                            @if ($product['type'] == 'kniha' || $product['type'] == 'audiokniha' || $product['type'] == 'ekniha')
                                Meno autora
                            @elseif ($product['type'] == 'hudba')
                                Meno interpreta
                            @else
                                Meno režiséra
                            @endif
                        </th>
                        <td>{{$product['author']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jazyk</th>
                        <td>{{$product['language']}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Žáner</th>
                        <td>{{$product['genre']}}</td>
                    </tr>
                    @if ($product['type'] == 'kniha')
                        <tr>
                            <th scope="row">Väzba</th>
                            <td>{{$product['format']}}</td>
                        </tr>
                    @endif
                    @if (isset ($product['age_group']))
                        <tr>
                            <th scope="row">Veková kategória</th>
                            <td>{{$product['age_group']}}</td>
                        </tr>
                    @endif
                    @if ($product['type'] == 'kniha' || $product['type'] == 'audiokniha' || $product['type'] == 'ekniha')
                        <tr>
                            <th scope="row">Vydavateľstvo</th>
                            <td>{{$product['publisher']}}</td>
                        </tr>
                    @endif
                    @if ($product['type'] == 'kniha' || $product['type'] == 'ekniha')
                        <tr>
                            <th scope="row">Počet strán</th>
                            <td>{{$product['page_count']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">ISBN</th>
                            <td>{{$product['isbn']}}</td>
                        </tr>
                    @endif
                    @if ($product['type'] == 'audiokniha' || $product['type'] == 'film' || $product['type'] == 'hudba')
                        <tr>
                            <th scope="row">Dĺžka</th>
                            <td>{{$product['length']}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>

            <!-- Hodnotenie -->
            <div class='col-12 col-sm-6 col-md-5'>
                <div><h2 class='detailPodnadpis'>Hodnotenie:</h2></div>
                <div class='detailHodnotenie'>{{ str_replace('.', ',', $product['rating'] )}}/5</div>
            </div>
        </div>
    </main>

    <script src="/js/showMore.js"></script>

@endsection
