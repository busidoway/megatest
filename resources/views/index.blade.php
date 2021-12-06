@extends('layouts.app')

@section('meta-title')Главная@endsection

@section('content')
    <h2 class="pb-2 border-bottom text-center">Megatest</h2>
    <div class="d-flex g-4 py-5 justify-content-center">
        <a href="{{ route('tests') }}" class="btn btn-primary">Начать</a>
    </div>
@endsection