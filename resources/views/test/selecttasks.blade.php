@extends('layouts.master-teacher')

@section('title')
    Bobrovo - výber úloh do testu
@endsection

@section('content')
<div class="container">

    <div class="row">
        <!-- Main content -->
        <div class="col-md-12">
            <h1>Vytvoriť test {{$test->name}} (výber otázok) </h1>
            <h2>Filter úloh</h2>
        </div>
    </div>

    <form method="POST" action="">
        @csrf

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="category">Kategória</label>
                <select name="category" id="category" class="custom-select" size="3" multiple>

                    @foreach ($categories as $category)
                        <option value="">{{ $category->name }} ({{ $category->class }} )</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="topic">Téma</label>
                <select name="topic" id="topic" class="custom-select" size="3" multiple>
                    @foreach ($topics as $topic)
                        <option value="">{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <p>Typ úloh</p>

            @foreach (['všetky','interaktívne','neinteraktívne'] as $type)
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="{{ $type }}" name="type" value="{{ $type }}" {{ old('type') == $type ? "checked" : ''}}>
                    <label class="custom-control-label" for="{{ $type}}">{{ $type }}</label>
                </div>
            @endforeach
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Aplikuj filter TO DO</button>
        </div>

    </div>
    </form>

    <div class="row">
        <div class="col-md-6">
            <h2>Dostupné úlohy</h2>
            <p>...</p>
            <button class="btn btn-primary">Pridať označené úlohy do testu</button>
        </div>
        <div class="col-md-6">
            <h2>Úlohy v teste</h2>
            <p>...</p>
            <button class="btn btn-primary">Zrušiť označené úlohy z testu</button>
        </div>
    </div>
</div>
@endsection