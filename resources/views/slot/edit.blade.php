<?php
use App\Models\Slot

/** @var Slot $slot */
?>

@extends('main')
@section('title', 'Edit')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ Form::open([
    'route' => ['slot.update', $slot],
]) }}
    @method('put')
    <div>
        {{ Form::label('from', __('model/slot.from')) }}:
        {{ Form::datetimeLocal('from', $slot->from) }}
        {{ Form::label('to', __('model/slot.to')) }}:
        {{ Form::datetimeLocal('to', $slot->to) }}
    </div>
    <br>
    <div>
        {{ Form::label('info[name]', __('model/slot.name')) }}:<br>
        {{ Form::text('info[name]', $slot->info->name) }}
    </div>
    <br>
    <div>
        {{ Form::label('info[description]', __('model/slot.description')) }}:<br>
        {{ Form::textarea('info[description]', $slot->info->description) }}
    </div>
    <br>
    <div>
        {{ Form::label('info[capacity]', __('model/slot.capacity')) }}:<br>
        {{ Form::number('info[capacity]', $slot->info->capacity) }}<br>
        {{ Form::label('info[price]', __('model/slot.price')) }}:<br>
        {{ Form::number('info[price]', $slot->info->price) }}
    </div>
    <br>
    <div>
        {{ Form::submit('Сохранить изменения') }}
    </div>
{{ Form::close() }}
<div style="margin-top: 2em">
    {{ Form::open([
        'route' => ['slot.destroy', $slot]
    ]) }}
    @method('delete')
    {{ Form::submit('Удалить слот') }}
    {{ Form::close() }}
</div>
@endsection
