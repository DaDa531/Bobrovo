@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - upraviť pridelenie testu pre skupinu
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
            <h1>Zmeniť nastavenia pre pridelenie testu</h1>
            TODO: KONTROLU PRISTUPU
        </div>
    </div>

    <form method="POST" action="{{ route('assignment.update', $assignment->id) }}">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="test" class="font-weight-bold">Test</label>
                    <input type="hidden" name="test" value="{{$assignment->test->id}}">
                    <select name="t" id="test" class="custom-select" disabled>
                        <option value="{{$assignment->test->id}}" selected>{{$assignment->test->name}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="group" class="font-weight-bold">Skupina</label>
                    <input type="hidden" name="group" value="{{$assignment->group->id}}">
                    <select name="g" id="group" class="custom-select" disabled>
                        <option value="{{$assignment->group->id}}" selected>{{$assignment->group->name}}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="mix_questions" name="mix_questions" value="1" {{ (old('mix_questions') != null || $assignment->mix_questions == 1) ? "checked" : '' }}>
                    <label class="custom-control-label" for="mix_questions">Náhodné poradie otázok</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="available_answers" name="available_answers" value="1" {{(old('available_answers') != null  || $assignment->available_answers == 1) ? "checked" : '' }}>
                    <label class="custom-control-label" for="available_answers">Dostupné odpovede</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="available_from" class="font-weight-bold">Dostupný od</label>
                    <datetime-component name="available_from" value="{{ old('available_from') ?? $assignment->available_from}}"></datetime-component>
                    <!--
                    <div class="input-group mb-3">
                        <input type="date" name="available_from_date" id="available_from_date" class="form-control" value="{{ old('available_from_date')}}">
                        <input type="time" name="available_from_time" id="available_from_time" class="form-control" value="{{ old('available_from_time')}}">
                    </div>
                    -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="available_to" class="font-weight-bold">Dostupný do</label>
                    <datetime-component name="available_to" value="{{ old('available_to') ?? $assignment->available_to}}"></datetime-component>
                    <!--
                    <div class="input-group mb-3">
                        <input type="date" name="available_to_date" id="available_to_date" class="form-control" value="{{ old('available_to_date')}}">
                        <input type="time" name="available_to_time" id="available_to_time" class="form-control" value="{{ old('available_to_time')}}">
                    </div>
                    -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="time_to_do" class="font-weight-bold">Čas na vypracovanie testu (min.)</label>
                    <select name="time_to_do" id="time_to_do" class="custom-select" required>
                        @for ($i=1; $i<=20; $i++)
                            <option value="{{5*$i}}" {{($assignment->time_to_do == 5*$i) ? "selected" : ""}}>{{5*$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Zmeniť nastavenia</button>
            </div>
        </div>
    </form>
</div>
@endsection