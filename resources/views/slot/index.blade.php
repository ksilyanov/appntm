@extends('main')
@section('title', 'List')

@section('breadcrumbs')
    {!! Breadcrumbs::render('slot') !!}
@endsection

@section('content')
    @auth
    <a href={{ route('slot.create') }}>Создать новый</a>
    @endauth
    <br>
    Созданные слоты:
    <?php /** @var \App\Models\Slot $slot */ ?>
    @foreach($list as $slot)
        <br>
        {{ $slot->from }} - {{ $slot->to }} - {{ $slot->info->name }} /
        <a href={{ route('slot.show', $slot) }}>Подробнее</a>
        <a href={{ route('slot.edit', $slot) }}>Редактировать</a>
        {{ $slot->users }}
    @endforeach
@endsection
