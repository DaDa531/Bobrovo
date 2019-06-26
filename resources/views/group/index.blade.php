@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - skupiny
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
            <h1>Zoznam skupín</h1>

            @if (isset($groups))

                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Počet žiakov</th>
                        <th>Vytvorená</th>
                        <th>Vymazať</th>
                    </tr>
                    @foreach ($groups as $group)
                        <tr>
                            <td><a href="{{ route('group.show', $group->id) }}">{{ $group->name}}</a></td>
                            <td>{{ $group->studentsCount()}}</td>
                            <td>{{ $group->created_at }}</td>
                            <td>
                                @if ($group->canDelete())
                                    <form action="{{ route('group.destroy', $group->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-trash px-4 py-0" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                <!--<a href="{{ route('group.destroy', $group->id) }}"><i class="fa fa-trash"></i></a>-->
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>

            @else
                <div>
                    Nemáte vytvorené žiadne skupiny
                </div>
            @endif


        </div>

    </div>
</div>
@endsection