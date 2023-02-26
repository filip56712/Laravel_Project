<div>
    <ul class="topbar" style="width: 1810px;">
        <li class="lewo">
            <a href="./">
                <img src="{{ asset('img/Pass_Book_logo.png') }}" alt="logo" class="lewo">
            </a>
        </li>
        <li>
            @if(Auth::check())
            <a href="<?=config('app.url'); ?>/konto_ekran" class="prawo"><img src="{{ asset('img/user.png') }}" alt="user" class="prawo user"></a>
            <br>
            <a href="<?=config('app.url'); ?>/konto_ekran" class="prawo">Moje konto</a>
            @else
            <a href="<?=config('app.url'); ?>/loguj" class="prawo"><img src="{{ asset('img/user.png') }}" alt="user" class="prawo user"></a>
            <br>
            <a href="<?=config('app.url'); ?>/loguj" class="prawo">Moje konto</a>
            @endif
        </li>
    </ul>
</div>