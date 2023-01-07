@extends('main')
@section('title', 'User')

@section('breadcrumbs')
    {!! Breadcrumbs::render('user') !!}
@endsection

@section('content')
<?php
    use App\Models\User;

    /** @var User $user */
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div>
    <span id="username">Привет, {{ Auth::user()->name }}</span>
    <button id="edit-name-button" class="btn btn-secondary">Изменить имя</button>
    <form id="edit-name-form" action="{{ route('user.update') }}" method="POST" style="display: none;">
        @csrf
        Привет, <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"> <a href="#" id="save-name">save</a>
    </form>
</div>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Выйти</button>
</form>

<script>
    $(document).ready(function() {
        let userName = $('#username');

        $('#edit-name-button').click(function() {
            userName.hide();
            $('#edit-name-button').hide();
            $('#edit-name-form').show();
        });

        $('#save-name').click(function () {
            $('#edit-name-form').trigger('submit');
        });

        $('#edit-name-form').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                success: function(result) {
                    if (result.success) {
                        userName.text(`Привет, ${result.name}`);
                        userName.show();
                        $('#edit-name-button').show();
                        $('#edit-name-form').hide();
                    } else {
                        // Обработка ошибки
                        console.log(result);
                        alert('ошибка, чек консоль');
                    }
                }
            });
        });
    });
</script>
@endsection
