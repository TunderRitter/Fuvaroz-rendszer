<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Munka módosítása</title>
</head>
<body>
    <div style="border: 3px solid black; padding: 2px; margin: 3px;">
        <form action="/editJob" method="POST">
            @csrf
            <input name="id" value="{{$job -> id}}" type="text" hidden>
            <input name="starting_address" type="text" placeholder="Kiindulási cím" value="{{$job -> starting_address}}">
            <input name="ending_address" type="text" placeholder="Érkezési cím" value="{{$job -> ending_address}}">
            <input name="person_name" type="text" placeholder="Címzett neve" value="{{$job -> person_name}}">
            <input name="phone_number" type="text" placeholder="Címzett telefonszáma" value="{{$job -> phone_number}}">
            <button type="submit">Módosítás</button>
        </form>
    </div>
</body>
</html>