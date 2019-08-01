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
            <a href="{{ route('group.edit', $group->id) }}" class="d-inline mr-2">
                <button class="btn btn-secondary px-4"><i class="fa fa-edit pr-2"></i>Upraviť</button>
            </a>

            @if ($group->canDelete())
                <a href="{{ route('group.destroy', $group->id) }}" class="d-inline mr-2">
                    <button class="btn btn-danger px-4"><i class="fa fa-trash pr-2"></i>Zrušiť</button>
                </a>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p>TO DO: VYHĽADANIE KONKRÉTNEHO ZIAKA, TLAČ ZOZNAMU ŽIAKOV S KÓDMI</p>
            <p><strong>Vytvorená:</strong> {{ $group->created_at}}</p>
            <p><strong>Popis:</strong> {{ $group->description}}</p>
        </div>
        <div class="col-md-6">
            <h3>Žiaci v skupine ({{ count($students) }})</h3>
            @if (count($students)>0)
                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                    </tr>
                @foreach ($students as $student)
                    <tr>
                        <td><a href="{{ route('student.show', $student->id) }}">{{$student->first_name}} {{$student->last_name}}</a></td>
                        <td>{{ $student->code }}</td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>

</div>
@endsection