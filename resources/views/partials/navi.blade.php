<nav>
 <div>
 <ul class="menu" style="width: 1810px;">
    <li><a href="<?=config('app.url'); ?>/">Główna</a></li>
    <li><a href="<?=config('app.url'); ?>/oferty">Lista Ofert</a></li>
    <li><a href="<?=config('app.url'); ?>/ksiazki">Lista Książek</a></li>
    <li><a href="<?=config('app.url'); ?>/kontakt">Kontakt</a></li>
    @if(Auth::check())
    <li><a href="<?=config('app.url'); ?>/wyloguj">Wyloguj</a></li>
    @else
    <li><a href="<?=config('app.url'); ?>/loguj">Zarejestruj</a></li>
    @endif
</ul>
 </div>
</nav>
