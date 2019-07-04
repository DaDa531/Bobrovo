@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - skupina {{ $group->name}}
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
            <h1>Skupina {{ $group->name}}</h1>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('group.edit', $group->id) }}" class="d-inline mr-2"><button class="btn btn-secondary px-4">Upraviť</button></a>

            @if ($group->canDelete())
                <form action="{{ route('group.destroy', $group->id) }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-danger px-4" type="submit">
                        Zrušiť
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Vytvorená:</strong> {{ $group->created_at}}</p>
            <p><strong>Popis:</strong> {{ $group->description}}</p>
        </div>
        <div class="col-md-6">
            <h3>Žiaci v skupine ({{ count($students) }})</h3>
            @if (count($students)>0)
                <ul>
                @foreach ($students as $student)
                    <li>
                        <a href="{{ route('student.show', $student->id) }}">{{$student->first_name}} {{$student->last_name}}</a>
                    </li>
                @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>
@endsection