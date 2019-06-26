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

        <!-- Main content -->
        <div class="col-md-6">
            <h1>Vytvorenie testu</h1>
            FORM

        </div>

    </div>
</div>
@endsection