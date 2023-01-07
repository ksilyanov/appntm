<?php
use App\Models\Slot

/** @var Slot $slot */
?>

@extends('main')
@section('title', 'Show')

@section('breadcrumbs')
    {!! Breadcrumbs::render('slot.show', $slot) !!}
@endsection

@section('content')
    <div>
        {{ $slot->info->name }}
    </div>
    <div>
        {{ $slot->from }} – {{ $slot->to }}
    </div>
    <div>
        {{ $slot->info->description }}
    </div>
    <div>
        {{ __('model/slot.capacity') }}: {{ $slot->info->capacity }} / {{ __('model/slot.price') }}: {{ $slot->info->price }}
    </div>
@endsection
