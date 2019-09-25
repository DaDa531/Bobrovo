@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - upraviť skupinu
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h1>Upraviť skupinu</h1>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('group.show', $group->id) }}"><button class="btn btn-secondary px-4">Späť na skupinu</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('group.update', $group->id) }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Meno</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $group->name }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="group-description">Popis</label>
                    <input id="group-description" type="text" class="form-control" name="description" value="{{ old('description') ?? $group->description }}" size="90">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Zmeniť údaje</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2>Zrušiť žiakov zo skupiny</h2>
            @if (count($students)>0)
                <form method="post" action="{{ route('group.removestudents', $group->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="pupils">Vyber žiakov:</label>
                        <select name="pupils[]" id="pupils" class="custom-select" size = {{ count($students) > 20 ? 20 : count($students)}} multiple>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-danger px-4" type="submit"><i class="fa fa-lg fa-trash pr-3"></i>Označených zrušiť zo skupiny</button>
                </form>
            @endif
        </div>
        <div class="col-md-6">
            <h2>Pridať žiakov do skupiny</h2>
            <form method="post" action="{{ route('group.addstudents', $group->id) }}">
                @csrf
                <div class="form-group">
                    <label for="pupils">Vyber žiakov:</label>
                    <select name="pupils[]" id="pupils" class="custom-select" size = {{ count($allstudents) > 20 ? 20 : count($allstudents)}} multiple>
                        @foreach($allstudents as $student)
                            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Označených pridať do skupiny</button>
            </form>
        </div>
    </div>
</div>
@endsection