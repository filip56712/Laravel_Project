<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <ul style="width: 100%;">
        <li><a href="./change-password">Zmień hasło</a></li>
    </ul>
    <p><a href="<?=config('app.url'); ?>/konto_ekran">Powrót</a></p>
</div>
</body>
</html>