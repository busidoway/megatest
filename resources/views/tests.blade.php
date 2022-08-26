@extends('layouts.app')

@section('meta-title')Главная@endsection

@section('content')
    <h2 class="pb-2 border-bottom text-center">Тест диспетчера ЧРГСС</h2>
    <div class="mb-0 py-4 d-flex justify-content-center">
        <form action="{{ route('test_box_rand') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary text-white">Случайный билет</button>
        </form>
    </div>
    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
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
    <div class="px-3 navigation mt-4 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-center">
        {{ $tests->onEachSide(0)->links() }}
    </div>
@endsection