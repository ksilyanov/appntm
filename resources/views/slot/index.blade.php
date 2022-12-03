@extends('main')
@section('title', 'List')

@section('content')
    Созданные слоты:
    <?php /** @var \App\Models\Slot $slot */ ?>
    @foreach($list as $slot)
        <br>
        {{ $slot->from }} - {{ $slot->to }}
    @endforeach
@endsection
