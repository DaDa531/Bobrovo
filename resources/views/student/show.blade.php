@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - žiak
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h1>Žiak {{ $student->first_name}} {{ $student->last_name}}</h1>
        </div>
        <div class="col-md-2">
            <form method="POST" action="{{ route('student.edit', $student->id) }}" class="d-inline">
                @csrf
                <button class="btn btn-danger" type="submit" title="Upraviť žiaka">
                    Upraviť žiaka
                </button>
            </form>
        </div>
        <div class="col-md-2">
            <form method="POST" action="{{ route('student.destroy', $student->id) }}" class="d-inline">
                @csrf
                <button class="btn btn-danger" type="submit" title="Zrušiť žiaka">
                    Zrušiť žiaka
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Kód:</strong> {{ $student->code}}</p>
            <p><strong>Zaregistrovaný:</strong> {{ $student->created_at}}</p>

            <h3>Skupiny</h3>
            @if (count($groups) == 0)
                Žiak nie je zatiaľ zaradený do žiadnej skupiny.
            @else
                <table class="table">
                    <!--<tr>
                        <th>Skupina</th>
                        <th>Vymazať</th>
                    </tr>-->
                @foreach ($groups as $group)
                    <tr>
                        <td>{{$group->name}}</td>
                        <td>
                            <form method="POST" action="{{ route('student.removegroup', [$student->id, $group->id]) }}" class="d-inline float-right">
                                @csrf
                                <button class="btn btn-danger btn-trash px-4 py-0" type="submit" title="Vymazať žiaka zo skupiny">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </table>
            @endif

            <!--Skupiny pomocou card
            <div class="card">
                @if (count($groups) > 0)
                    <div class="card-header">
                        <h4>Skupiny ({{count($groups)}})</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($groups as $group)
                                <li class="list-group-item">
                                    {{$group->name}}
                                    <form method="POST" action="{{ route('student.removegroup', [$student->id, $group->id]) }}" class="d-inline float-right">
                                        @csrf
                                        <button class="btn btn-danger btn-trash px-4 py-0" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>-->


            @if (count($allgroups) > 0)
                <form method="POST" action="{{ route('student.addgroup', $student->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="addgroup">Pridať do skupiny</label>
                        <select name="addgroup" id="addgroup" class="form-control">
                            <option value="">-- vybrať skupinu --</option>
                            @foreach($allgroups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Pridať do skupiny</button>
                </form>
            @endif

        </div>
        <div class="col-md-6">
            <h3>Nevyriešené testy</h3>
            Zoznam
            <h3>Úspešnosť vo vyriešených testoch</h3>
            Tabuľka
        </div>
    </div>

</div>
@endsection