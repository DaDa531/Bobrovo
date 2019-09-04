@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - vytvor skupinu
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

        <!-- Main content -->
        <div class="col-md-8">
            <h1>Vytvorenie skupiny</h1>
            <form method="POST" action="{{ route('group.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Meno</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="group-description" class="mr-sm-2">Popis:</label>
                    <input id="group-description" type="text" class="form-control mb-2 mr-sm-2" name="description" value="{{ old('description')}}">
                </div>

                <button type="submit" class="btn btn-primary">Vytvoriť skupinu</button>
            </form>

        </div>

    </div>
</div>
@endsection