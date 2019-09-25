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
        <div class="col-md-6">
            <h1>Upraviť test (základné informácie)</h1>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('test.show', $test->id) }}"><button class="btn btn-secondary px-4">Späť na test</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('test.update', $test->id) }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="font-weight-bold">Názov</label>
                    <input id="name" type="text" class="mb-2 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $test->name}}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="description">Popis</label>
                    <textarea id="description" class="mb-2 form-control" name="description" rows=3">{{ old('description') ?? $test->description}}</textarea>
                </div>

                <div class="custom-control custom-checkbox mb-2">
                    <input type="checkbox" class="custom-control-input" id="available_description" name="available_description" value="1" {{ (old('available_description') != null || $test->available_description == 1)  ? "checked" : '' }}>
                    <label class="custom-control-label" for="available_description">Zobraziť popis testu žiakom</label>
                </div>

                <button type="submit" class="btn btn-primary">Uložiť</button>
            </form>
        </div>
    </div>

</div>
@endsection