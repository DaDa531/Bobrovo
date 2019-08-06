@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - vytvor test
@endsection

@section('content')
<div class="container">

    <div class="row mb-1">
        <div class="col-sm-6 col-12">
            @includeWhen(session('errors'), 'layouts.errors')
            @includeWhen(session('success'), 'layouts.success', ['success' => session('success')])
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h1>Vytvoriť test</h1>

            <form method="POST" action="{{ route('test.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title" class="mb-0 font-weight-bold">Názov</label>
                    <input id=name" type="text" class="mb-2 form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="description" class="mb-0 font-weight-bold">Popis</label>
                    <textarea id="description" class="mb-2 form-control" name="description" rows=3">{{ old('description') }}</textarea>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="available_description" name="available_description" value="{{ old('available_description') != null  ? "checked" : '' }}">
                <label class="custom-control-label" for="available_description">Zobraziť popis testu žiakom</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="mix_questions" name="mix_questions" value="{{ old('mix_questions') != null  ? "checked" : '' }}">
                <label class="custom-control-label" for="mix_questions">Náhodné poradie otázok</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="available_answers" name="available_answers" value="{{ old('available_answers') != null  ? "checked" : '' }}">
                <label class="custom-control-label" for="available_answers">Dostupné odpovede</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="available_from">Dostupný od</label>
                <div class="input-group form-datetime date">
                    <input type="text" value="" name="available_from" id="available_from" class="form-control">
                    <div class="input-group-append ">
                        <span class="input-group-text "><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="available_to">Dostupný do</label>
                <div class="input-group form-datetime date">
                    <input type="text" value="" name="available_to" id="available_to" class="form-control">
                    <div class="input-group-append ">
                        <span class="input-group-text "><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="time_to_do">Čas</label>
                <select name="time_to_do" id="" class="form-control">
                    @for ($i=1; $i<=20; $i++)
                        <option value="{{5*$i}}">{{5*$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Uložiť</button>
            </form>
        </div>
    </div>

</div>
@endsection