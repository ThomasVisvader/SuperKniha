@extends('layout.app')
@section('main')
    <main class="container main">

        <h1 class="col-12" id="filterTitleMain"> Edit-Produkt-ID-{{$product['id']}} </h1>

        <form method="POST" action="{{ route('updateProduct', ['id' => $product['id']])}}" enctype="multipart/form-data">

            <input type="hidden" name="_method" value="PUT">
            @csrf

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3" id="zoznamObrazkovOld">
                @for($i = 0; $i < sizeof($images); $i++)
                    <div class="col-10 col-sm-6 col-md-4 mt-3 mb-3">
                        <figure>
                            <figcaption class="mb-2">Obrázok {{$i+1}}</figcaption>
                            <img src="/storage/images/w-250/{{$images[$i]['image']}}" alt="Obrázok produktu" class="detailObrazok">
                        </figure>
                        <input type="hidden" name="obrazok{{$i+1}}" value="{{$images[$i]['image']}}">
                        <button class="d-block btn btnEditObrazok" type="button" onclick="removeInput(this)">Vymazať obrázok</button>
                    </div>
                @endfor
            </div>
            <div id="zoznamObrazkov">
                <div>
                    <label for="obrazok{{sizeof($images)+1}}" class="form-label" >Vyberte obrázok {{sizeof($images)+1}}</label>
                    <input class="form-control pridatObrazok" type="file" id="obrazok{{sizeof($images)+1}}" name="obrazok{{sizeof($images)+1}}" accept=".png, .jpeg, .jpg" onchange="addInput(this, {{sizeof($images)+1}})"/>
                </div>
            </div>

            <div class="form-row novyProdukt">
                <div class="col-md-6 mb-3">
                    <label for="title">Názov produktu<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" placeholder="napr. Traja mušketieri" @if(isset($product['title'])) value="{{$product['title']}}" @endif class="form-control" id="title" name="title" maxlength="100"> <!--required-->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="author" id="authorLabel">@if($product['type'] === 'film') Meno režiséra @elseif($product['type'] === 'hudba') Meno interpreta @else Meno autora @endif<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" placeholder="napr. Božena Nemcová" @if(isset($product['author'])) value="{{$product['author']}}" @endif class="form-control" id="author" name="author" maxlength="100"> <!--required-->
                </div>
                @if($product['type'] !== 'film' && $product['type'] !== 'hudba')
                    <div class="col-md-6 mb-3">
                        <label for="series">Názov série</label>
                        <input type="text" placeholder="napr. Harry Potter" @if(isset($product['series'])) value="{{$product['series']}}" @endif  class="form-control" id="series" name="series" maxlength="100">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="volume">Číslo dielu</label>
                        <input type="number" placeholder="napr. 1" class="form-control novyProduktNumber" @if(isset($product['volume'])) value="{{$product['volume']}}" @endif id="volume" name="volume" min="1" max="32767">
                    </div>
                @endif
                <div class="col-md-6 mb-3">
                    <label for="price">Cena<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" placeholder="XX,YY" @if(isset($product['price'])) value="{{str_replace('.', ',',$product['price'])}}" @endif  class="form-control" id="price" name="price" pattern="^[1-9][0-9]{0,3}[,][0-9]{2}$"> <!--required-->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="discounted_price">Cena po zľave</label>
                    <input type="text" class="form-control" placeholder="XX,YY" @if(isset($product['discounted_price'])) value="{{str_replace('.', ',',$product['discounted_price'])}}" @endif id="discounted_price" name="discounted_price" pattern="^[1-9][0-9]{0,3}[,][0-9]{2}$">
                </div>
                @if($product['type'] !== 'audiokniha')
                    <div class="col-md-6 mb-3">
                        <label for="quantity" id="quantityLabel">Počet kusov na sklade<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                        <input type="number" placeholder="napr. 50" class="form-control novyProduktNumber" @if(isset($product['quantity'])) value="{{$product['quantity']}}" @endif id="quantity" name="quantity" min="1" max="2147483647" required> <!--required-->
                    </div>
                @endif
                <div class="col-12 mb-3">
                    <label for="description">Obsah<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <textarea class="textArea" placeholder="Sem zadajte popis produktu (napr. obsah knihy)" id="description" name="description" maxlength="1000">@if(isset($product['description'])){{$product['description']}}@endif</textarea> <!-- required -->
                </div>

                <div class="col-6 mb-3">
                    <label for="language">Jazyk<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" placeholder="napr. slovenský" @if(isset($product['language'])) value="{{$product['language']}}" @endif  id="language" name="language" maxlength="50"> <!--required-->
                </div>
                <div class="col-6 mb-3">
                    <label for="genre">Žáner<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" placeholder="napr. sci-fi" class="form-control" @if(isset($product['genre'])) value="{{$product['genre']}}" @endif  id="genre" name="genre" maxlength="100"> <!--required-->
                </div>
                @if($product['type'] === 'kniha' || $product['type'] === 'ekniha')
                    <div class="col-6 mb-3">
                        <label for="format" id="formatLabel">Formát</label>
                        <input type="text" placeholder="napr. pevná" class="form-control" @if(isset($product['format'])) value="{{$product['format']}}" @endif  id="format" name="format" maxlength="50">
                    </div>
                @endif
                <div class="col-6 mb-3">
                    <label for="age_group">Veková kategória</label>
                    <input type="text" placeholder="napr. od 6 rokov" class="form-control" @if(isset($product['age_group'])) value="{{$product['age_group']}}" @endif  id="age_group" name="age_group" maxlength="100">
                </div>
                @if($product['type'] !== 'film' && $product['type'] !== 'hudba')
                    <div class="col-6 mb-3">
                        <label for="publisher" id="publisherLabel">Vydavateľstvo</label>
                        <input type="text" placeholder="napr. Slovart"  class="form-control" @if(isset($product['publisher'])) value="{{$product['publisher']}}" @endif  id="publisher" name="publisher" maxlength="100">
                    </div>
                @endif
                @if($product['type'] === 'kniha' || $product['type'] === 'ekniha')
                    <div class="col-6 mb-3">
                        <label for="page_count" id="page_countLabel">Počet strán</label>
                        <input type="number" placeholder="napr. 500"  class="form-control novyProduktNumber" @if(isset($product['page_count'])) value="{{$product['page_count']}}" @endif  id="page_count" name="page_count" min="1" max="32767">
                    </div>
                @endif
                @if($product['type'] !== 'kniha' && $product['type'] !== 'ekniha')
                    <div class="col-6 mb-3">
                        <label for="length" id="lengthLabel">Dĺžka</label>
                        <input type="text" placeholder="hh:mm" class="form-control" @if(isset($product['length'])) value="{{$product['length']}}" @endif  id="length" name="length" pattern="^[0-9]{1,7}[:][0-9]{2}$">
                    </div>
                @endif
                @if($product['type'] === 'kniha' || $product['type'] === 'ekniha')
                    <div class="col-6 mb-3">
                        <label for="isbn" id="isbnLabel">ISBN</label>
                        <input type="text" placeholder="napr. 9784979695603" class="form-control" id="isbn" @if(isset($product['isbn'])) value="{{$product['isbn']}}" @endif  name="isbn" pattern="^[0-9]{1,25}$">
                    </div>
                @endif
                <div class="col-6 mb-3">
                    <label for="rating">Hodnotenie<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" placeholder="X,Y" class="form-control" id="rating" @if(isset($product['rating'])) value="{{str_replace('.', ',',$product['rating'])}}" @endif  name="rating" pattern="^[0-4][,][0-9]$|^5,0$"> <!-- required -->
                </div>
            </div>

            <div class="row justify-content-end align-items-center">
                <button class="btn btn-lg" id="btnNovyProdukt" type="submit">
                    Uložiť vykonané zmeny
                </button>
            </div>
        </form>
    </main>

    <script src="/js/adminProduct.js"></script>
@endsection
