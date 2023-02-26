<div>
    <ul class="topbar" style="width: 1810px;">
        <li class="lewo">
            <a href="<?=config('app.url'); ?>">
                <img src="{{ asset('img/Pass_Book_logo.png') }}" alt="logo" class="lewo">
            </a>
        </li>
        <li>
            <form class="srodek" action ="{{ url('/oferty/search') }}" method = "GET">
                <p><input id="search_input" name="query" type="search" value="" placeholder="Wyszukaj"><button type="submit" class="btn btn-primary mb-2">Wyszukaj</button></p>
            </form>
        </li>
        <li>
            <a href="<?=config('app.url'); ?>/konto_ekran" class="prawo"><img src="{{ asset('img/user.png') }}" alt="user" class="prawo user"></a>
            <br>
            <a href="<?=config('app.url'); ?>/konto_ekran" class="prawo">Moje konto</a>
        </li>
    </ul>
</div>