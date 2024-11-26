<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin nézet</title>
</head>
<body>
    <h1>Munka létrehozása</h1>

    <div style="border: 3px solid black; padding: 2px; margin: 3px;">
        <form action="/createjob" method="POST">
            @csrf
            <input name="starting_address" type="text" placeholder="Kiindulási cím">
            <input name="ending_address" type="text" placeholder="Érkezési cím">
            <input name="person_name" type="text" placeholder="Címzett neve">
            <input name="phone_number" type="text" placeholder="Címzett telefonszáma">
            <button type="submit">Létrehozás</button>
        </form>
    </div>

    <h1>Munkák kezelése</h1>

    <table>
        <thead>
            <tr>
                <th>Kiindulási cím</th>
                <th>Érkezési cím</th>
               <th>Címzett neve</th>
               <th>Címzett telefonszáma</th>
               <th>Státusz</th>
              <th>Hozzárendelt fuvarozó</th>
              <th>Műveletek</th>
         </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job -> starting_address }}</td>
                    <td>{{ $job -> ending_address }}</td>
                    <td>{{ $job -> person_name }}</td>
                    <td>{{ $job -> phone_number }}</td>
                    <td>{{ $job -> status }}</td>
                    <td>{{ $job -> driver -> name ?? 'Unassigned' }}</td>   
                    <td>
                        <div style="margin: 3px; padding: 3px;">
                            <p>Fuvarozó hozzárendelése</p>
                            <form action="/assignjob" method="POST">
                                @csrf
                                <input name="id" value="{{$job -> id}}" type="text" hidden>
                                <select name="driver_id" onchange="this.form.submit()">
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver -> id }}">{{ $driver -> name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div style="margin: 3px; padding: 3px;">
                            <p>Munka módosítása</p>
                            <form method="GET" action="/editpage">
                                @csrf
                                <input name="id" value="{{$job -> id}}" type="text" hidden>
                                <button type="submit">Módosítás</button>
                            </form>
                        </div>
                        <div style="margin: 3px; padding: 3px;">
                            <p>Munka törlése</p>
                            <form method="POST" action="/deletejob">
                                @csrf
                                <input name="id" value="{{$job -> id}}" type="text" hidden>
                                <button type="submit">Törlés</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>