@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - zadať test skupine
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
            <h1>Zadať test skupine {{isset($group) ? $group->name : ''}}</h1>
        </div>
    </div>
    @if ((isset($groups) or isset($group)) and isset($tests))
        <form method="POST" action="{{ route('assignment.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="test" class="font-weight-bold">Zvoľ test</label>
                        <select name="test" id="test" class="custom-select">
                            <option value="" selected>- Zvoľ test - </option>
                            @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="group" class="font-weight-bold">Zvoľ skupinu</label>
                        @if (isset($group))
                            <input type="hidden" name="group" value="{{$group->id}}">
                            <select name="g" id="group" class="custom-select" disabled>
                                <option value="{{$group->id}}" selected>{{$group->name}}</option>
                        @else
                            <select name="group" id="group" class="custom-select">
                                <option value="" selected>- Zvoľ skupinu -</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                        @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="mix_questions" name="mix_questions" value="{{ old('mix_questions') != null  ? "checked" : '' }}">
                        <label class="custom-control-label" for="mix_questions">Náhodné poradie otázok</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="available_answers" name="available_answers" value="{{ old('available_answers') != null  ? "checked" : '' }}">
                        <label class="custom-control-label" for="available_answers">Dostupné odpovede</label>
                    </div>
                </div>
             </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="available_from" class="font-weight-bold">Dostupný od</label>
                        <datetime-component name="available_from" id="available_from"></datetime-component>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="available_to" class="font-weight-bold">Dostupný do</label>
                        <datetime-component2 name="available_to" id="available_to"></datetime-component2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="time_to_do" class="font-weight-bold">Čas</label>
                        <select name="time_to_do" id="time_to_do" class="form-control">
                            <option value="" selected>- Zvoľ čas -</option>
                            @for ($i=1; $i<=20; $i++)
                                <option value="{{5*$i}}">{{5*$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Zadať test skupine</button>
                </div>
            </div>
        </form>
    @else
        <div class="row">
            <div class="col-md-12">
                @if (!isset($groups))
                    Nemáte vytvorené žiadne skupiny.
                @endif
                @if (!isset($tests))
                    Nemáte vytvorené žiadne testy.
                @endif
            </div>
        </div>
    @endif
</div>
@endsection