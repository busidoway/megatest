@extends('layouts.app')

@section('meta-title')Тест диспетчера ЧРГСС@endsection

@section('content')

    @if(session()->has('student'))

    <div id="app_test">
        <tests></tests>
    </div>

    @else

    <div class="text-center fs-5">Выберите имя сотрудника <a href="{{ route('home') }}">из списка</a></div>

    @endif

@endsection