<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
<h2>Error: {{$message}}</h2>
</div>
</body>
</html>