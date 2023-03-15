@extends('layout.app')

@section('main')
    <main class='container main'>

        @if(isset($order_id))
            <h1 id="filterTitleMain"> Vaša objednávka č. {{$order_id}} bola úspešne prijatá. </h1>
        @endif

        <!-- Novinky -->
        <h2 class='title'>Novinky</h2>

        <div class='row flex-row flex-nowrap overflow-auto align-items-center border scrollbar'>

            <!-- Kniha -->
            @foreach($new_products as $product)
                <div class='col-auto homepageProdukt'>
                    <div><img src='/storage/images/w-150/{{$product['image']}}' alt='Obálka knihy {{$product['title']}}' class='homePageObrazok'></div>
                    <div class='triBodky'>
                        <a class='scrollbarLink' href='{{route('product', ['id' => $product['product_id']])}}' data-toggle='tooltip' title='{{$product['title']}}'>{{$product['title']}}</a>
                    </div>
                    <div class='triBodky' data-toggle='tooltip' title='{{$product['author']}}'>{{$product['author']}}</div>
                    @if (isset ($product['discounted_price']))
                        <div>
                    <span class='povodnaCena'>
                        {{ str_replace('.', ',', $product['price']) }}€
                    </span>
                            <span class='platnaCena'>
                        {{ str_replace('.', ',', $product['discounted_price']) }}€
                    </span>
                        </div>
                    @else
                        <div>
                    <span class='platnaCena'>
                        {{ str_replace('.', ',', $product['price']) }}€
                    </span>
                        </div>
                    @endif
                </div>
            @endforeach

        </div>

        <!-- Zlavy -->
        <h2 class='title'>Zľavy</h2>

        <div class='row flex-row flex-nowrap overflow-auto align-items-center border scrollbar'>

            <!-- Kniha -->
            @foreach($disc_products as $product)
                <div class='col-auto homepageProdukt'>
                    <div><img src='/storage/images/w-150/{{$product['image']}}' alt='Obálka knihy {{$product['title']}}' class='homePageObrazok'></div>
                    <div class='triBodky'>
                        <a class='scrollbarLink' href='{{route('product', ['id' => $product['product_id']])}}' data-toggle='tooltip' title='{{$product['title']}}'>{{$product['title']}}</a>
                    </div>
                    <div class='triBodky' data-toggle='tooltip' title='{{$product['author']}}'>{{$product['author']}}</div>
                    <div>
                        <span class='povodnaCena'>
                            {{ str_replace('.', ',', $product['price']) }}€
                        </span>
                        <span class='platnaCena'>
                            {{ str_replace('.', ',', $product['discounted_price']) }}€
                        </span>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Najpredavanejsie -->
        <h2 class='title'>Najlepšie hodnotené</h2>

        <div class='row flex-row flex-nowrap overflow-auto align-items-center border scrollbar'>

            <!-- Kniha -->
            @foreach($popular_products as $product)
                <div class='col-auto homepageProdukt'>
                    <div><img src='/storage/images/w-150/{{$product['image']}}' alt='Obálka knihy {{$product['title']}}' class='homePageObrazok'></div>
                    <div class='triBodky'>
                        <a class='scrollbarLink' href='{{route('product', ['id' => $product['product_id']])}}' data-toggle='tooltip' title='{{$product['title']}}'>{{$product['title']}}</a>
                    </div>
                    <div class='triBodky' data-toggle='tooltip' title='{{$product['author']}}'>{{$product['author']}}</div>
                    @if (isset ($product['discounted_price']))
                        <div>
                    <span class='povodnaCena'>
                        {{ str_replace('.', ',', $product['price']) }}€
                    </span>
                            <span class='platnaCena'>
                        {{ str_replace('.', ',', $product['discounted_price']) }}€
                    </span>
                        </div>
                    @else
                        <div>
                    <span class='platnaCena'>
                        {{ str_replace('.', ',', $product['price']) }}€
                    </span>
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </main>
@endsection
