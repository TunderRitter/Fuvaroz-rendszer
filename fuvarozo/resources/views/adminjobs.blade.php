<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <title>Admin nézet</title>
</head>
<body>
@auth
<div style="padding: 2px; margin: 3px;">
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Kijelentkezés</button>
    </form>
</div>

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

<h1>Jármű létrehozása</h1>

<div style="border: 3px solid black; padding: 2px; margin: 3px;">
    <form action="/createvehicle" method="POST">
        @csrf
        <input name="brand" type="text" placeholder="Márka">
        <input name="type" type="text" placeholder="Típus">
        <input name="license_plate" type="text" placeholder="Rendszám">
        <select name="driver_id"">
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>
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
                <td>{{ ($job -> driver -> name ?? ' ') == ' ' ? 'Kiosztásra vár ' : ($job -> status == "assigned" ? 'Kiosztva' : ($job -> status == 'in-progress' ?  "Folyamatban" : ($job -> status == 'completed' ? "Elvégezve" : "Sikertelen"))) }}</td>
                <td>{{ $job -> driver -> name ?? ' - ' }}</td>
                <td>
                    <div style="margin: 3px; padding: 3px;">
                        <p>Fuvarozó hozzárendelése</p>
                        <form action="/assignjob" method="POST">
                            @csrf
                            <input name="id" value="{{$job -> id}}" type="text" hidden>
                            <select name="driver_id">
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver -> id }}">{{ $driver -> name }}</option>
                                @endforeach
                                <button type="submit">Hozzárendelés</button>
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

<h2>Járművek kezelése</h2>
<table>
    <thead>
        <tr>
            <th>Márka</th>
            <th>Típus</th>
            <th>Rendszám</th>
            <th>Hozzárendelt fuvarozó</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle -> brand }}</td>
                <td>{{ $vehicle -> type }}</td>
                <td>{{ $vehicle -> license_plate }}</td>
                <td>{{ $vehicle -> driver -> name ?? ' ' }}</td>
                <td>
                    <div style="margin: 3px; padding: 3px;">
                        <p>Jármű törlése</p>
                        <form method="POST" action="/deletevehicle">
                            @csrf
                            <input name="id" value="{{$vehicle -> id}}" type="text" hidden>
                            <button type="submit">Törlés</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endauth
@guest
    <p>Kérlek jelentkezz be!</p>
@endguest
</body>
</html>