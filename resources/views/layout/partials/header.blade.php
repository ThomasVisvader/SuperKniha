<header class='fixed-top header'>

    <div class='container'>
        <div class='d-flex justify-content-between align-items-center'>

            <!-- Logo -->
            <a href='{{route('index')}}' id='homePageTitle' class='btn'>SuperKniha</a>

            <!-- Searchbar + search button -->
            <form class='d-none d-md-flex col-md-6 searchBar' action='{{route('products')}}'>
                <input class='form-control' type='search' name="globalSearch" placeholder='Zadajte názov knihy, autora...' aria-label='Search'>
                <button class='btn btn-outline-dark btnHeader' type='submit'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-search headerLupa' viewBox='0 0 16 16'>
                        <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
                    </svg>
                </button>
            </form>

            <div class='d-inline-flex align-items-center'>

                <!-- Search collapse -->
                <button class='d-none d-sm-block d-md-none btn btnHeader' type='button' data-toggle='collapse' data-target='#menu'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-search headerLupa' viewBox='0 0 16 16'>
                        <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
                    </svg>
                </button>

                <!-- Login -->
                @if (isset($user))
                    <div class="dropdown d-block">
                        <button class="btn btnHeader btnUser dropdown-toggle" type="button" id="profilDropdown" data-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-lg-inline-flex">Profil</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person headerPrihlasenie" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </button>
                            <div class="dropdown-menu" aria-labelledby="profilDropdown">
                                <a class="dropdown-item" href="{{ route('profile', ['id' => $user['id']]) }}">Zobraziť profil</a>
                                @can('create', App\Models\Product::class)
                                <a class="dropdown-item" href="{{ route('newProduct') }}">Pridať produkt</a>
                                @endcan
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Odhlásiť sa</button>
                                </form>
                            </div>
                    </div>
                @else
                    <a href='{{route('login')}}' class='btn btnHeader d-block'>
                        <span class='d-none d-lg-inline-flex'>Prihlásenie</span>
                        <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-person headerPrihlasenie' viewBox='0 0 16 16'>
                            <path d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/>
                        </svg>
                    </a>
                @endif

                <!-- Kosik -->
                <a href="{{route('cart')}}" class="btn btnHeader btnKosik d-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-cart3 headerKosik" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    @if (isset ($cart_size))
                        <span class="badge kosikCount">
                            @if ($cart_size <= 9)
                                {{$cart_size}}
                            @else
                                9+
                            @endif
                        </span>
                    @endif
                </a>

                <!-- Hamburger -->
                <button class='d-sm-none btn btnHeader' type='button' data-toggle='collapse' data-target='#menu'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-list headerMenu' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z'/>
                    </svg>
                </button>

            </div>

        </div>

        <!-- Menu -->
        <nav class='d-md-none'>
            <div class='collapse' id='menu'>

                <!-- Searchbar -->
                <form class='d-flex searchBar' action='{{route('products')}}'>
                    <input class='form-control' name="globalSearch" type='search' placeholder='Zadajte názov knihy, autora...' aria-label='Search'>
                    <button class='btn btn-outline-dark btnHeader' type='submit'>
                        <svg xmlns='http://www.w3.org/2000/svg' class='bi bi-search headerLupa' viewBox='0 0 16 16'>
                            <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/>
                        </svg>
                    </button>
                </form>

                <div>

                    <!-- Kategorie -->
                    <ul class='d-sm-none'>
                        <li>
                            <a href='{{route('products',['type'=>'kniha'])}}' class='btn btnHeader'>Knihy</a>
                        </li>
                        <li>
                            <a href='{{route('products',['type'=>'audiokniha'])}}' class='btn btnHeader'>Audioknihy</a>
                        </li>
                        <li>
                            <a href='{{route('products',['type'=>'ekniha'])}}' class='btn btnHeader'>E-knihy</a>
                        </li>
                        <li>
                            <a href='{{route('products',['type'=>'film'])}}' class='btn btnHeader'>Filmy</a>
                        </li>
                        <li>
                            <a href='{{route('products',['type'=>'hudba'])}}' class='btn btnHeader'>Hudba</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <!-- Kategorie -->
        <nav class='d-none d-sm-flex'>
            <a href='{{route('products',['type'=>'kniha'])}}' class='btn btnHeader'>Knihy</a>
            <a href='{{route('products',['type'=>'audiokniha'])}}' class='btn btnHeader'>Audioknihy</a>
            <a href='{{route('products',['type'=>'ekniha'])}}' class='btn btnHeader'>E-knihy</a>
            <a href='{{route('products',['type'=>'film'])}}' class='btn btnHeader'>Filmy</a>
            <a href='{{route('products',['type'=>'hudba'])}}' class='btn btnHeader'>Hudba</a>
        </nav>

    </div>
</header>
