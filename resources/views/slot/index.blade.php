@extends('main')
@section('title', 'List')

@section('content')
    <a href={{ route('slot.create') }}>Создать новый</a>
    <br>
    Созданные слоты:
    <?php /** @var \App\Models\Slot $slot */ ?>
    @foreach($list as $slot)
        <br>
        {{ $slot->from }} - {{ $slot->to }} - {{ $slot->info->name }} /
        <a href={{ route('slot.show', $slot) }}>Подробнее</a>
        <a href={{ route('slot.edit', $slot) }}>Редактировать</a>
    @endforeach
@endsection
