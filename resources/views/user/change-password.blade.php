<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div class="container-fluid">
    <div class="col-md-6 offset-3 pt-4">
        <h3 class="text-center">Zmień hasło</h3>
        @if($errors->any())
        {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
        @endif
        @if(Session::get('error') && Session::get('error') != null)
        <div style="color:red">{{ Session::get('error') }}</div>
        @php
        Session::put('error', null)
        @endphp
        @endif
        @if(Session::get('success') && Session::get('success') != null)
        <div style="color:green">{{ Session::get('success') }}</div>
        @php
        Session::put('success', null)
        @endphp
        @endif
        <form class="form" action="{{ route('postChangePassword') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Aktualne hasło</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nowe hasło</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Potwierdź nowe hasło</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary text-center">Zmień</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>