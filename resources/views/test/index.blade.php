@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - testy
@endsection

@section('content')
<div class="container">
    <!--<div class="row justify-content-center mb-5">
        <div class="col-sm-6 col-12">
            @includeWhen(session('errors'), 'layouts.errors')
            @includeWhen(session('success'), 'layouts.success', ['success' => session('success')])
        </div>
    </div>-->
    <div class="row">

        <!-- Main content -->
        <div class="col-md-12">
            <h1>Zoznam testov</h1>


        </div>

    </div>
</div>
@endsection