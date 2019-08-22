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
            <h1>Zadať test skupine</h1>
        </div>
    </div>
    @if (isset($groups) and isset($tests))
        <form method="POST" action="{{ route('test.assign') }}">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="test">Zvoľ test</label>
                        <select name="test" id="test" class="custom-select">
                            <option value="0" selected>- Zvoľ test - </option>
                            @foreach($tests as $test)
                                <option value="{{ $test->id }}">{{ $test->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="group">Zvoľ skupinu</label>
                        <select name="group" id="group" class="custom-select">
                            <option value="0" selected>- Zvoľ skupinu -</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
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
                        <select name="time_to_do" id="time_to_do" class="form-control">
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