@extends('layouts.master-teacher')

@section('title')
    Bobrovo - učiteľ - zoznam žiakov
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
        <div class="col-md-12">
            <h1>Zoznam žiakov</h1>
            <p>TO DO: UMOŽNIŤ SORT PODĽA PRIEZVISKA, VYHĽADANIE KONKRÉTNEHO ZIAKA, TLAČ ZOZNAMU ŽIAKOV S KÓDMI, HROMADNÉ PRIDÁVANIE ŠTUDENTOV DO SKUPÍN</p>
            @if (isset($students))

                <table class="table">
                    <tr>
                        <th>Meno a priezvisko</th>
                        <th>Kód</th>
                        <th>Dátum pridania</th>
                        <th class="text-center">Vymazať</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name}} {{ $student->last_name}}</a></td>
                            <td>{{ $student->code }}</td>
                            <td>{{ $student->created_at }}</td>
                            <td class="text-center">

                                @if ($student->canDelete())
                                        <a href="{{ route('student.destroy', $student->id) }}" class="text-danger" title="Vymazať {{ $student->first_name . ' ' . $student->last_name }}"><i class="fa fa-trash"></i></a>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach

                </table>
                {{ $students->links() }}
            @else
                <div>
                    Nemáte pridaných žiadnych študentov
                </div>
            @endif
        </div>

    </div>
</div>
@endsection