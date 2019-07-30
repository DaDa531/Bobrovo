@extends('layouts.master-teacher')

@section('title')
    Bobrovo - účiteľ - moje úlohy
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1>Moje úlohy</h1>

            @if (count($tasks) > 0)

                <table class="table">
                    <tr>
                        <th>Názov</th>
                        <th>Typ</th>
                        <th>Náročnosť</th>
                        <th>Téma</th>
                        <th>Hodnotenie</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->title}}</a></td>
                            <td>{{ $task->type }}</td>
                            <td>
                                @if (count($task->categories) > 0)
                                    @foreach ($task->categories as $category)
                                        {{$category->name}}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($task->topics) > 0)
                                    @foreach ($task->topics as $topic)
                                        {{$topic->name}}<br>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$task->averageRating() }}</td>
                        </tr>
                    @endforeach

                </table>
                {{ $tasks->links() }}
            @else
                <div>
                    Nemáte definované žiadne vlastné úlohy.
                </div>
            @endif
        </div>
    </div>
    
</div>
@endsection