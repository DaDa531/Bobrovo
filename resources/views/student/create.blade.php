@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - pridaj žiaka
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.7/slimselect.min.css" rel="stylesheet">
        <div class="col-md-8">
            <h1>Pridať žiaka</h1>

            <form method="POST" action="{{ route('student.store') }}">
                @csrf

                <div class="form-group">
                    <label for="first_name"><strong>Meno</strong></label>
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="last_name"><strong>Priezvisko</strong></label>
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="groups[]">Zaradiť do skupín</label>
                    <select name="groups[]" id="slim-select" multiple="multiple">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Pridať žiaka</button>
            </form>


        </div>

    </div>
</div>
@endsection