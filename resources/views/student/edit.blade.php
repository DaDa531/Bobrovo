@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - žiak
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1>Upraviť žiaka {{ $student->first_name}} {{ $student->last_name}}</h1>
        </div>
    </div>

</div>
@endsection