<?php
use App\Models\Slot

/** @var Slot $slot */
?>

@extends('main')
@section('title', 'Edit')

@section('content')

<?php dump(get_defined_vars()); ?>

{{ $slot->info->name }}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ Form::model($slot, [
    'route' => ['slot.update', $slot]
]) }}
    @method('put')
    <div>
        {{ Form::label('from', __('model/slot.from')) }}:
        {{ Form::datetimeLocal('from') }}
        {{ Form::label('to', __('model/slot.to')) }}:
        {{ Form::datetimeLocal('to') }}
    </div>
    <br>
    <div>
        {{ Form::label('info[name]', __('model/slot.name')) }}:<br>
        {{ Form::text('info[name]') }}
    </div>
    <br>
    <div>
        {{ Form::label('info[description]', __('model/slot.description')) }}:<br>
        {{ Form::textarea('info[description]') }}
    </div>
    <br>
    <div>
        {{ Form::label('info[capacity]', __('model/slot.capacity')) }}:<br>
        {{ Form::number('info[capacity]') }}<br>
        {{ Form::label('info[price]', __('model/slot.price')) }}:<br>
        {{ Form::number('info[price]') }}
    </div>
    <br>
    <div>
        {{ Form::submit('Сохранить изменения') }}
    </div>
{{ Form::close() }}
@endsection
