@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - skupina {{ $group->name}}
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1>Skupina {{ $group->name}}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Vytvorená:</strong> {{ $group->created_at}}</p>
            <p><strong>Popis:</strong> {{ $group->description}}</p>
            <h3>Žiaci v skupine ({{ count($students) }})</h3>
            @if (count($students)>0)
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th><i class="fa fa-trash float-right px-4"></i></th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{$student->first_name}} {{$student->last_name}}</a></td>
                            <td>
                                <form method="post" class="d-inline float-right">
                                    @csrf
                                    <button class="btn btn-danger btn-trash px-4 py-0" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

</div>
@endsection