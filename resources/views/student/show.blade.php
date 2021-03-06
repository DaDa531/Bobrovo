@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - zobraziť žiaka
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
            <h1>Žiak {{ $student->first_name}} {{ $student->last_name}}</h1>
        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('student.edit', $student->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-lg fa-edit pr-2"></i>Upraviť</button></a>

            @if ($student->canDelete())
                <form action="{{ route('student.destroy', $student->id) }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-danger px-4" type="submit"><i class="fa fa-trash"></i> Zrušiť</button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Kód:</strong> {{ $student->code}}</p>
            <p><strong>Zaregistrovaný:</strong> {{ $student->dateToString($student->created_at)}}</p>

            <p><strong>Patrí do skupiny (skupín):</strong></p>
            @if (count($groups) == 0)
                Žiak nie je zatiaľ zaradený do žiadnej skupiny.
            @else
                <ul>
                 @foreach ($groups as $group)
                    <li><a href="{{ route('group.show', $group->id) }}">{{ $group->name}}</a></li>
                @endforeach
                </ul>
            @endif
        </div>

        <div class="col-md-6">
            <h2>Čakajúce testy</h2>
            Zoznam

            <h2>Vyriešené testy</h2>
            Tabuľka
        </div>
    </div>

</div>
@endsection