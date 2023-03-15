@extends('layout.app')

@section('main')


<main class="container main">

    <!-- Nadpis -->
    <h1 class="col-12" id="filterTitleMain">
        @switch ($type)
            @case('kniha')
            Knihy
            @break
            @case('audiokniha')
            Audioknihy
            @break
            @case('ekniha')
            E-knihy
            @break
            @case('hudba')
            Hudba
            @break
            @case('film')
            Filmy
            @break
            @default()
            Produkty
            @break
        @endswitch
    </h1>

{{--    {{print_r($requests)}}--}}

    <div class="d-flex">

        <!-- Filtre -->
        <div class="d-none d-md-block col-md-3">
            <h2 id="filterTitleFilter">Filtre</h2>
            <form method="get" action="{{route('products')}}">
                <input type="hidden" name="type" value="{{$type}}">
                <input type="hidden" name="globalSearch" value="{{$globalSearch}}">
                <input type="hidden" name="localSearch" value="{{$localSearch}}">
                <input type="hidden" name="orderType" value="{{$orderType}}">
                <input type="hidden" name="orderBy" value="{{$orderBy}}">

                <div class="filterTitle">Žáner</div>
                @if (sizeof($genres) <= 5)
                @foreach($genres as $genre)
                    <div class="form-check">
                        <input @if(isset($requests['genre-'.$genre['genre']]) && $requests['genre-'.$genre['genre']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="genre-{{$genre['genre']}}" id="{{$genre['genre']}}">
                        <label class="form-check-label" for="{{$genre['genre']}}">
                            {{$genre['genre']}}
                        </label>
                    </div>
                @endforeach
                @else
                    @for ($i = 0; $i < 5; $i++)
                        <div class="form-check">
                            <input @if(isset($requests['genre-'.$genres[$i]['genre']]) && $requests['genre-'.$genres[$i]['genre']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="genre-{{$genres[$i]['genre']}}" id="{{$genres[$i]['genre']}}">
                            <label class="form-check-label" for="{{$genres[$i]['genre']}}">
                                {{$genres[$i]['genre']}}
                            </label>
                        </div>
                    @endfor
                    <div class='collapse' id='genreCollapse'>
                        @for ($i = 5; $i < sizeof($genres); $i++)
                            <div class="form-check">
                                <input @if(isset($requests['genre-'.$genres[$i]['genre']]) && $requests['genre-'.$genres[$i]['genre']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="genre-{{$genres[$i]['genre']}}" id="{{$genres[$i]['genre']}}">
                                <label class="form-check-label" for="{{$genres[$i]['genre']}}">
                                    {{$genres[$i]['genre']}}
                                </label>
                            </div>
                        @endfor
                    </div>
                    <button class='detailBoldText' id='filtrovanieZobrazitViac' type='button' data-toggle='collapse' data-target='#genreCollapse' onClick="showMore(this)">Zobraziť viac</button>
                @endif

                <div class="filterTitle">Cena (€)</div>

                    <div class="form-group">
                        <div class="col-6 filterCena">
                            <input type="text" class="form-control" @if(isset($requests['cenaOd']) ) value={{$requests['cenaOd']}} @endif name="cenaOd" placeholder="Od">
                        </div>
                        <div class="col-6 filterCena">
                            <input type="text" class="form-control" @if(isset($requests['cenaDo']) ) value={{$requests['cenaDo']}} @endif  name="cenaDo" placeholder="Do">
                        </div>
                    </div>


                <div class="filterTitle">Jazyk</div>
                @if (sizeof($languages) <= 5)
                    @foreach($languages as $language)
                        <div class="form-check">
                            <input @if(isset($requests['language-'.$language['language']]) && $requests['language-'.$language['language']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="language-{{$language['language']}}" id="{{$language['language']}}">
                            <label class="form-check-label" for="{{$language['language']}}">
                                {{$language['language']}}
                            </label>
                        </div>
                    @endforeach
                @else
                    @for ($i = 0; $i < 5; $i++)
                        <div class="form-check">
                            <input @if(isset($requests['language-'.$languages[$i]['language']]) && $requests['language-'.$languages[$i]['language']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="language-{{$languages[$i]['language']}}" id="{{$languages[$i]['language']}}">
                            <label class="form-check-label" for="{{$languages[$i]['language']}}">
                                {{$languages[$i]['language']}}
                            </label>
                        </div>
                    @endfor
                    <div class='collapse' id='languageCollapse'>
                        @for ($i = 5; $i < sizeof($languages); $i++)
                            <div class="form-check">
                                <input @if(isset($requests['language-'.$languages[$i]['language']]) && $requests['language-'.$languages[$i]['language']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="language-{{$languages[$i]['language']}}" id="{{$languages[$i]['language']}}">
                                <label class="form-check-label" for="{{$languages[$i]['language']}}">
                                    {{$languages[$i]['language']}}
                                </label>
                            </div>
                        @endfor
                    </div>
                    <button class='detailBoldText' id='filtrovanieZobrazitViac' type='button' data-toggle='collapse' data-target='#languageCollapse' onClick="showMore(this)">Zobraziť viac</button>
                @endif

                @if($type === 'kniha')
                    <div class="filterTitle">Väzba</div>
                    @if (sizeof($formats) <= 5)
                        @foreach($formats as $format)
                            <div class="form-check">
                                <input @if(isset($requests['format-'.$format['format']]) && $requests['format-'.$format['format']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="format-{{$format['format']}}" id="{{$format['format']}}">
                                <label class="form-check-label" for="{{$format['format']}}">
                                    {{$format['format']}}
                                </label>
                            </div>
                        @endforeach
                    @else
                        @for ($i = 0; $i < 5; $i++)
                            <div class="form-check">
                                <input @if(isset($requests['format-'.$formats[$i]['format']]) && $requests['format-'.$formats[$i]['format']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="format-{{$formats[$i]['format']}}" id="{{$formats[$i]['format']}}">
                                <label class="form-check-label" for="{{$formats[$i]['format']}}">
                                    {{$formats[$i]['format']}}
                                </label>
                            </div>
                        @endfor
                        <div class='collapse' id='formatCollapse'>
                            @for ($i = 5; $i < sizeof($formats); $i++)
                                <div class="form-check">
                                    <input @if(isset($requests['format-'.$formats[$i]['format']]) && $requests['format-'.$formats[$i]['format']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="format-{{$formats[$i]['format']}}" id="{{$formats[$i]['format']}}">
                                    <label class="form-check-label" for="{{$formats[$i]['format']}}">
                                        {{$formats[$i]['format']}}
                                    </label>
                                </div>
                            @endfor
                        </div>
                        <button class='detailBoldText' id='filtrovanieZobrazitViac' type='button' data-toggle='collapse' data-target='#formatCollapse' onClick="showMore(this)">Zobraziť viac</button>
                    @endif

                @endif


                <div class="filterTitle">Hodnotenie</div>
                <div class="form-check">
                    <input @if(isset($requests['hodnotenie'])) @if($requests['hodnotenie'] == 0) checked @endif @else checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck0" value="0">
                    <label class="form-check-label" for="hodnotenieCheck0">
                        od 0 hviezdičky
                    </label>
                </div>
                <div class="form-check">
                    <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 1) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck1" value="1">
                    <label class="form-check-label" for="hodnotenieCheck1">
                        od 1 hviezdičky
                    </label>
                </div>
                <div class="form-check">
                    <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 2) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck2" value="2">
                    <label class="form-check-label" for="hodnotenieCheck2">
                        od 2 hviezdičky
                    </label>
                </div>
                <div class="form-check">
                    <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 3) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck3" value="3">
                    <label class="form-check-label" for="hodnotenieCheck3">
                        od 3 hviezdičky
                    </label>
                </div>
                <div class="form-check">
                    <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 4) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck4" value="4">
                    <label class="form-check-label" for="hodnotenieCheck4">
                        od 4 hviezdičky
                    </label>
                </div>
                <div class="form-check">
                    <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 5) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck5" value="5">
                    <label class="form-check-label" for="hodnotenieCheck5">
                        od 5 hviezdičky
                    </label>
                </div>
                <button class="btn filterButton" type="submit">
                    Aplikovať filtre
                </button>
            </form>

        </div>

        <div class="col-12 col-md-9">

            <!-- Zoradenia + searchbar -->
            <div class="col-12 d-lg-flex justify-content-between align-items-center p-0">

                <button class="d-sm-none btn btnFiltre mb-4" type="button" data-toggle="collapse" data-target="#filtre">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-funnel filterIcon" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                    </svg>
                </button>

                <!-- Collapse -->
                <div class="d-sm-none">
                    <div class="collapse mb-4" id="filtre">
                        <form method="get" action="{{route('products')}}">
                            <input type="hidden" name="type" value="{{$type}}">
                            <input type="hidden" name="globalSearch" value="{{$globalSearch}}">
                            <input type="hidden" name="localSearch" value="{{$localSearch}}">
                            <input type="hidden" name="orderType" value="{{$orderType}}">
                            <input type="hidden" name="orderBy" value="{{$orderBy}}">

                            <div class="filterTitle">Žáner</div>
                            @if (sizeof($genres) <= 5)
                                @foreach($genres as $genre)
                                    <div class="form-check">
                                        <input @if(isset($requests['genre-'.$genre['genre']]) && $requests['genre-'.$genre['genre']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="genre-{{$genre['genre']}}" id="{{$genre['genre']}}">
                                        <label class="form-check-label" for="{{$genre['genre']}}">
                                            {{$genre['genre']}}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="form-check">
                                        <input @if(isset($requests['genre-'.$genres[$i]['genre']]) && $requests['genre-'.$genres[$i]['genre']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="genre-{{$genres[$i]['genre']}}" id="{{$genres[$i]['genre']}}">
                                        <label class="form-check-label" for="{{$genres[$i]['genre']}}">
                                            {{$genres[$i]['genre']}}
                                        </label>
                                    </div>
                                @endfor
                                <div class='collapse' id='genreCollapse'>
                                    @for ($i = 5; $i < sizeof($genres); $i++)
                                        <div class="form-check">
                                            <input @if(isset($requests['genre-'.$genres[$i]['genre']]) && $requests['genre-'.$genres[$i]['genre']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="genre-{{$genres[$i]['genre']}}" id="{{$genres[$i]['genre']}}">
                                            <label class="form-check-label" for="{{$genres[$i]['genre']}}">
                                                {{$genres[$i]['genre']}}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                                <button class='detailBoldText' id='filtrovanieZobrazitViac' type='button' data-toggle='collapse' data-target='#genreCollapse' onClick="showMore(this)">Zobraziť viac</button>
                            @endif

                            <div class="filterTitle">Cena (€)</div>

                            <div class="form-group">
                                <div class="col-6 filterCena">
                                    <input type="text" class="form-control" @if(isset($requests['cenaOd']) ) value={{$requests['cenaOd']}} @endif name="cenaOd" placeholder="Od">
                                </div>
                                <div class="col-6 filterCena">
                                    <input type="text" class="form-control" @if(isset($requests['cenaDo']) ) value={{$requests['cenaDo']}} @endif  name="cenaDo" placeholder="Do">
                                </div>
                            </div>


                            <div class="filterTitle">Jazyk</div>
                            @if (sizeof($languages) <= 5)
                                @foreach($languages as $language)
                                    <div class="form-check">
                                        <input @if(isset($requests['language-'.$language['language']]) && $requests['language-'.$language['language']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="language-{{$language['language']}}" id="{{$language['language']}}">
                                        <label class="form-check-label" for="{{$language['language']}}">
                                            {{$language['language']}}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="form-check">
                                        <input @if(isset($requests['language-'.$languages[$i]['language']]) && $requests['language-'.$languages[$i]['language']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="language-{{$languages[$i]['language']}}" id="{{$languages[$i]['language']}}">
                                        <label class="form-check-label" for="{{$languages[$i]['language']}}">
                                            {{$languages[$i]['language']}}
                                        </label>
                                    </div>
                                @endfor
                                <div class='collapse' id='languageCollapse'>
                                    @for ($i = 5; $i < sizeof($languages); $i++)
                                        <div class="form-check">
                                            <input @if(isset($requests['language-'.$languages[$i]['language']]) && $requests['language-'.$languages[$i]['language']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="language-{{$languages[$i]['language']}}" id="{{$languages[$i]['language']}}">
                                            <label class="form-check-label" for="{{$languages[$i]['language']}}">
                                                {{$languages[$i]['language']}}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                                <button class='detailBoldText' id='filtrovanieZobrazitViac' type='button' data-toggle='collapse' data-target='#languageCollapse' onClick="showMore(this)">Zobraziť viac</button>
                            @endif

                            @if($type === 'kniha')
                                <div class="filterTitle">Väzba</div>
                                @if (sizeof($formats) <= 5)
                                    @foreach($formats as $format)
                                        <div class="form-check">
                                            <input @if(isset($requests['format-'.$format['format']]) && $requests['format-'.$format['format']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="format-{{$format['format']}}" id="{{$format['format']}}">
                                            <label class="form-check-label" for="{{$format['format']}}">
                                                {{$format['format']}}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="form-check">
                                            <input @if(isset($requests['format-'.$formats[$i]['format']]) && $requests['format-'.$formats[$i]['format']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="format-{{$formats[$i]['format']}}" id="{{$formats[$i]['format']}}">
                                            <label class="form-check-label" for="{{$formats[$i]['format']}}">
                                                {{$formats[$i]['format']}}
                                            </label>
                                        </div>
                                    @endfor
                                    <div class='collapse' id='formatCollapse'>
                                        @for ($i = 5; $i < sizeof($formats); $i++)
                                            <div class="form-check">
                                                <input @if(isset($requests['format-'.$formats[$i]['format']]) && $requests['format-'.$formats[$i]['format']] == 'on' ) checked @endif class="form-check-input" type="checkbox" name="format-{{$formats[$i]['format']}}" id="{{$formats[$i]['format']}}">
                                                <label class="form-check-label" for="{{$formats[$i]['format']}}">
                                                    {{$formats[$i]['format']}}
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                    <button class='detailBoldText' id='filtrovanieZobrazitViac' type='button' data-toggle='collapse' data-target='#formatCollapse' onClick="showMore(this)">Zobraziť viac</button>
                                @endif

                            @endif


                            <div class="filterTitle">Hodnotenie</div>
                            <div class="form-check">
                                <input @if(isset($requests['hodnotenie'])) @if($requests['hodnotenie'] == 0) checked @endif @else checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck0" value="0">
                                <label class="form-check-label" for="hodnotenieCheck0">
                                    od 0 hviezdičky
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 1) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck1" value="1">
                                <label class="form-check-label" for="hodnotenieCheck1">
                                    od 1 hviezdičky
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 2) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck2" value="2">
                                <label class="form-check-label" for="hodnotenieCheck2">
                                    od 2 hviezdičky
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 3) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck3" value="3">
                                <label class="form-check-label" for="hodnotenieCheck3">
                                    od 3 hviezdičky
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 4) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck4" value="4">
                                <label class="form-check-label" for="hodnotenieCheck4">
                                    od 4 hviezdičky
                                </label>
                            </div>
                            <div class="form-check">
                                <input @if(isset($requests['hodnotenie']) && $requests['hodnotenie'] == 5) checked @endif class="form-check-input" type="radio" name="hodnotenie" id="hodnotenieCheck5" value="5">
                                <label class="form-check-label" for="hodnotenieCheck5">
                                    od 5 hviezdičky
                                </label>
                            </div>
                            <button class="btn filterButton" type="submit">
                                Aplikovať filtre
                            </button>
                        </form>

                    </div>
                </div>

                <ul class="nav nav-tabs d-flex">
                    <li class="nav-item">
                        <a class="nav-link produktFilter @if($orderBy === 'id')active @endif" href="{{route('products',array_merge($requests, ['orderBy'=>'id', 'orderType'=>'DESC'] ))}}">Najnovšie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link produktFilter @if($orderBy === 'rating')active @endif" href="{{route('products',array_merge($requests, ['orderBy'=>'rating', 'orderType'=>'DESC'] ))}}">Najlepšie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link produktFilter @if($orderBy === 'price' && $orderType === 'ASC')active @endif" href="{{route('products',array_merge($requests, ['orderBy'=>'price', 'orderType'=>'ASC'] ))}}">Najlacnejšie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link produktFilter @if($orderBy === 'price' && $orderType === 'DESC')active @endif" href="{{route('products',array_merge($requests, ['orderBy'=>'price', 'orderType'=>'DESC'] ))}}">Najdrahšie</a>
                    </li>
                </ul>

                <form class="d-inline-flex filterSearch" method="get" action="{{route('products')}}">
                    <input type="hidden" name="type" value="{{$type}}">
                    <input type="hidden" name="globalSearch" value="{{$globalSearch}}">
                    <input class="form-control" name="localSearch" id="searchBarFilter" type="search" aria-label="Search">
                    <button class="btn btn-outline-dark produktBTNLupa" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-search produktLupa" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </form>

            </div>

            <!-- Produkt -->
            @if(count($products) > 0)
                @foreach($products as $product)
                    <article class="row produkt align-items-center">
                        <div class="col-3">
                            <img src="/storage/images/w-150/{{$product['image']}}" alt="Obálka knihy {{$product['title']}}"
                                 srcset="/storage/images/w-100/{{$product['image']}} 100w, /storage/images/w-150/{{$product['image']}} 150w"
                                 sizes="(min-width: 576px) 150px, 100px" class="produktObrazok">
                        </div>
                        <div class="col-6 offset-3 offset-sm-1 offset-md-2 col-lg-8 offset-lg-1">
                            <div class="triBodky">
                                <a class="produktNazov scrollbarLink" href='{{route('product', ['id' => $product['product_id']])}}' data-toggle="tooltip" title='{{$product['title']}}'>{{$product['title']}}</a>
                            </div>
                            <div class="triBodky" data-toggle="tooltip" title='{{$product['author']}}'>{{$product['author']}}</div>
                            @if (isset ($product['discounted_price']))
                                <div>
                            <span class='povodnaCena'>
                                {{ str_replace('.', ',', $product['price']) }}€
                            </span>
                                    <span class='produktCena platnaCena'>
                                {{ str_replace('.', ',', $product['discounted_price']) }}€
                            </span>
                                </div>
                            @else
                                <div>
                            <span class='produktCena platnaCena'>
                                {{ str_replace('.', ',', $product['price']) }}€
                            </span>
                                </div>
                            @endif
                            @if($product['quantity'] > 0)
                                <div class="produktDostupnost">Dostupnosť: {{$product['quantity']}} ks</div>
                            @elseif(isset($product['quantity']))
                                <div class="produktDostupnost">Dostupnosť: nedostupné</div>
                            @endif
                            <a class="btn produktBTNDoKosika" href="{{route('product', ['id' => $product['product_id']])}}">
                                Detail produktu
                            </a>
                            @canany(['edit', 'delete'], \App\Models\Product::class)
                                <div class="d-block d-sm-flex">
                                    <a class="btn produktBTNUpravitProdukt" href="{{route('editProduct', ['id' => $product['product_id']])}}">
                                        Upraviť produkt
                                    </a>
                                    <form method="POST" action={{ route('deleteProduct', ['id' => $product['product_id']]) }}>
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn produktBTNOdstranitProdukt" name="odstranitProdukt" >
                                            Odstrániť produkt
                                        </button>
                                    </form>
                                </div>
                            @endcanany

                        </div>
                </article>
                @endforeach
            @else
                <h2 class="mt-3">Nenašli sa žiadne produkty.</h2>
            @endif


            <!-- Strankovanie -->
            <nav class="produktPagination">
                <ul class="pagination justify-content-center">

                    @if(intval($page) > 1)
                        <li class="page-item d-none d-sm-block"><a class="page-link produktPaginationText" href="{{route('products',array_merge($requests, ['page'=>(intval($page) - 1)] ))}}"><<</a></li>
                    @endif

                    @if(intval($page) > 2)
                        <li class="page-item"><a class="page-link produktPaginationText" href="{{route('products',array_merge($requests, ['page'=>1] ))}}">1</a></li>
                        <li class="page-item disabled"><a class="page-link produktPaginationText" href="#">...</a></li>
                    @endif

                    @if(intval($page) !== 1)
                        <li class="page-item"><a class="page-link produktPaginationText" href="{{route('products',array_merge($requests, ['page'=>(intval($page) - 1)] ))}}">{{ intval($page) - 1 }}</a></li>
                    @endif

                    @if(intval($maxPage) > 1)
                        <li class="page-item active"><a class="page-link produktPaginationText" href="#">{{intval($page)}}</a></li>
                    @endif

                    @if(intval($page) < intval($maxPage))
                        <li class="page-item"><a class="page-link produktPaginationText" href="{{route('products',array_merge($requests, ['page'=>(intval($page) + 1)] ))}}">{{ intval($page) + 1 }}</a></li>

                    @endif

                    @if(intval($page) < intval($maxPage) - 1)
                        <li class="page-item disabled"><a class="page-link produktPaginationText" href="#">...</a></li>
                        <li class="page-item"><a class="page-link produktPaginationText" href="{{route('products',array_merge($requests, ['page'=>$maxPage] ))}}">{{$maxPage}}</a></li>
                    @endif

                    @if(intval($page) < intval($maxPage))
                        <li class="page-item d-none d-sm-block"><a class="page-link produktPaginationText" href="{{route('products',array_merge($requests, ['page'=>(intval($page) + 1)] ))}}">>></a></li>
                    @endif
                </ul>
            </nav>

        </div>
    </div>
</main>

<script src="/js/filterShowMore.js"></script>

@endsection
