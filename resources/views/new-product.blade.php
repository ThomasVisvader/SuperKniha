@extends('layout.app')
@section('main')
    <main class="container main">

        <h1 class="col-12" id="filterTitleMain"> Pridanie nového produktu </h1>

        <form method="POST" action="{{ route('createProduct') }}" enctype="multipart/form-data">
            @csrf
            <div id="zoznamObrazkov">
                <div>
                    <label for="obrazok1" class="form-label" >Vyberte obrázok 1<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input class="form-control pridatObrazok" type="file" id="obrazok1" name="obrazok1" accept=".png, .jpeg, .jpg" onchange="addInput(this, 1)" required/>
                </div>
            </div>

            <label for="types">Vyberte kategóriu produktu:</label>
            <select id="types" name="type" onchange="hideInputs(this)">
                <option value="kniha" selected="selected">Kniha</option>
                <option value="audiokniha">Audiokniha</option>
                <option value="ekniha">E-kniha</option>
                <option value="film">Film</option>
                <option value="hudba">Hudba</option>
            </select>

            <div class="form-row novyProdukt">
                <div class="col-md-6 mb-3">
                    <label for="title">Názov produktu<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="napr. Traja mušketieri" required> <!--required-->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="author" id="authorLabel">Meno autora<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="napr. Božena Nemcová" maxlength="100" required> <!--required-->
                </div>
                <div class="col-md-6 mb-3" id="seriesDiv">
                    <label for="series">Názov série</label>
                    <input type="text" class="form-control" id="series" name="series" placeholder="napr. Harry Potter" maxlength="100">
                </div>
                <div class="col-md-6 mb-3" id="volumeDiv">
                    <label for="volume">Číslo dielu</label>
                    <input type="number" class="form-control novyProduktNumber" id="volume" name="volume" placeholder="napr. 1" min="1" max="32767">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price">Cena<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="XX,YY" pattern="^[1-9][0-9]{0,3}[,][0-9]{2}$" required> <!--required-->
                </div>
                <div class="col-md-6 mb-3">
                    <label for="discounted_price">Cena po zľave</label>
                    <input type="text" class="form-control" id="discounted_price" name="discounted_price" placeholder="XX,YY" pattern="^[1-9][0-9]{0,3}[,][0-9]{2}$">
                </div>
                <div class="col-md-6 mb-3" id="quantityDiv">
                    <label for="quantity">Počet kusov na sklade<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="number" class="form-control novyProduktNumber" id="quantity" name="quantity" placeholder="napr. 50" min="1" max="2147483647" required> <!--required-->
                </div>

                <div class="col-12 mb-3">
                    <label for="description">Obsah<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <textarea class="textArea" id="description" name="description" placeholder="Sem zadajte popis produktu (napr. obsah knihy)" maxlength="1000" required></textarea> <!-- required -->
                </div>

                <div class="col-6 mb-3">
                    <label for="language">Jazyk<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" id="language" name="language" placeholder="napr. slovenský" maxlength="50" required> <!--required-->
                </div>
                <div class="col-6 mb-3">
                    <label for="genre">Žáner<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" id="genre" name="genre" maxlength="100" placeholder="napr. sci-fi" required> <!--required-->
                </div>
                <div class="col-6 mb-3" id="formatDiv">
                    <label for="format">Formát</label>
                    <input type="text" class="form-control" id="format" name="format" placeholder="napr. pevná" maxlength="50">
                </div>
                <div class="col-6 mb-3">
                    <label for="age_group">Veková kategória</label>
                    <input type="text" class="form-control" id="age_group" name="age_group" placeholder="napr. od 6 rokov" maxlength="100">
                </div>
                <div class="col-6 mb-3" id="publisherDiv">
                    <label for="publisher">Vydavateľstvo</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" placeholder="napr. Slovart" maxlength="100">
                </div>
                <div class="col-6 mb-3" id="pageCountDiv">
                    <label for="page_count">Počet strán</label>
                    <input type="number" class="form-control novyProduktNumber" id="page_count" placeholder="napr. 500" name="page_count" min="1" max="32767">
                </div>
                <div class="col-6 mb-3 novyProduktDlzka" id="lengthDiv">
                    <label for="length">Dĺžka</label>
                    <input type="text" class="form-control" id="length" name="length" placeholder="hh:mm" pattern="^[0-9]{1,7}[:][0-9]{2}$">
                </div>
                <div class="col-6 mb-3" id="isbnDiv">
                    <label for="isbn">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="napr. 9784979695603" pattern="^[0-9]{1,25}$">
                </div>
                <div class="col-6 mb-3">
                    <label for="rating">Hodnotenie<span class="poleRequired" data-toggle='tooltip' title="Povinné pole">*</span></label>
                    <input type="text" class="form-control" id="rating" name="rating" placeholder="X,Y" pattern="^[0-4][,][0-9]$|^5,0$" required> <!-- required -->
                </div>
            </div>

            <div class="row justify-content-end align-items-center">
                <button class="btn btn-lg" id="btnNovyProdukt" type="submit">
                    Pridať nový produkt
                </button>
            </div>
        </form>
    </main>

    <script src="/js/adminProduct.js"></script>
@endsection
