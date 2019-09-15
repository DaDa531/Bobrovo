<html>
<head>
    <meta charset="utf-8">
    <title>Bobrovo - zoznam zaregistrovaných žiakov</title>
    <style>
        .student-table{border-collapse: collapse; border: 1px solid #000000;}
        .student-table thead tr td {padding: 10px 10px; font-weight:bold; border-color: #000000}
        .student-table tr td{padding: 6px 10px; vertical-align: middle; border-top: 1px solid #000000;}
    </style>
</head>
<body>
    <h1>Bobrovo - zoznam zaregistrovaných žiakov</h1>
    @if ($group != null)
        <h2>Skupina {{ $group->name }}</h2>
    @endif
    <table class="student-table">
        <thead>
        <tr>
            <td>Meno</td>
            <td>Priezvisko</td>
            <td>Kód</td>
        </tr>
        </thead>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->first_name}}</td>
                <td>{{ $student->last_name}}</td>
                <td><code>{{ $student->code }}</code></td>
            </tr>
        @endforeach
    </table>
</body>
</html>