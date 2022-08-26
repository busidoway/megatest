@extends('layouts.app')

@section('meta-title')Главная@endsection

@php //session()->forget('student'); @endphp

@section('content')
    <h2 class="pb-2 border-bottom text-center">Тест диспетчера ЧРГСС</h2>
    <div class="d-flex g-4 py-5 justify-content-center">
        <form action="{{ route('select_student') }}" method="post" class="col-lg-3 row justify-content-center">
            @csrf
            <div class="row mb-2">
                Выберите имя сотрудника:
            </div>
            <div class="row mb-5">
                <select class="form-select" name="student_select">
                    <option>---------</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row col-lg-6">
                <button type="submit" class="btn btn-primary">Начать</button>
            </div>
        </form>
    </div>
@endsection