<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fuvarozó nézet</title>
</head>

<body>
    <h1>A kiosztott munkáid</h1>

<table>
    <thead>
        <tr>
            <th>Kiindulási cím</th>
            <th>Érkezési cím</th>
            <th>Címzett neve</th>
            <th>Címzett telefonszáma</th>
            <th>Státusz</th>
            <th>Státusz módosítása</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>{{ $job -> starting_address }}</td>
                <td>{{ $job -> ending_address }}</td>
                <td>{{ $job -> person_name }}</td>
                <td>{{ $job -> phone_number }}</td>
                <td>{{ $job -> status == "assigned" ? 'Kiosztva' : ($job -> status == 'in-progress' ?  "Folyamatban" : ($job -> status == 'completed' ? "Elvégezve" : "Sikertelen"))}}</td>
                <td>
                    @if($vehicles -> isEmpty())
                        <p>Nincs hozzád rendelt jármű</p>
                    @else
                        <form method="POST" action="/changestatus">
                            @csrf
                            <input name="id" value="{{$job -> id}}" type="text" hidden>
                            <select name="status" onchange="this.form.submit()" value="{{$job -> status}}">
                                <option value="assigned">Kiosztva</option>
                                <option value="in-progress">Folyamatban</option>
                                <option value="completed">Elvégezve</option>
                                <option value="failed">Sikertelen</option>
                            </select>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>