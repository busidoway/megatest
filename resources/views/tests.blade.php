@extends('layouts.app')

@section('meta-title')Главная@endsection

@section('content')
    <h2 class="pb-2 border-bottom text-center">Megatest</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    @foreach($tests as $test)
        <div class="col">
            <div class="card p-0">
                <h5 class="card-header">{{ $test->name }}</h5>
                <div class="card-body">
                    <p class="card-text">{{ $test->note }}</p>
                    <a href="{{ route('data-test', $test->id) }}" class="btn btn-primary text-white">Начать</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection