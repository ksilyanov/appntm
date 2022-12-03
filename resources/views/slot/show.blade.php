<?php
use App\Models\Slot

/** @var Slot $slot */
?>

@extends('main')
@section('title', 'Show')

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
        Доступно: {{ $slot->info->capacity }} / Цена: {{ $slot->info->price }}
    </div>
@endsection
