@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="prihlasenieErrorNadpis">
            {{ __('Vyskytla sa chyba') }}
        </div>

        <ul class="prihlasenieError">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
