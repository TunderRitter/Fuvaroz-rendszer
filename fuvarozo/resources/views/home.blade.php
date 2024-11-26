<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <title>Fuvarozó rendszer</title>
</head>
<body>
    <div style="border: 3px solid black; padding: 3px; margin: 2px;">
        <h2>Regisztráció</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Név (min 4, max 30, egyedi)">
            <input name="email" type="text" placeholder="Email (min 3, email)">
            <input name="password" type="password" placeholder="Jelszó (min 8, max 30)">
            <button type="submit">Regisztráció</button>
        </form>
    </div>

    <div style="border: 3px solid black; padding: 3px; margin: 2px;">
        <h2>Bejelentkezés</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="Név">
            <input name="loginpassword" type="password" placeholder="Jelszó">
            <button type="submit">Bejelentkezés</button>
        </form>
    </div>
    <div style="border: 3px solid black; padding: 3px; margin: 2px;">
        <h2>Admin (admin) felhasználó és két munkás (Jozsi, Sanyi) hozzáadása</h2>
        <form action="/admin" method="POST">
            @csrf
            <button type="submit">Létrehozás</button>
        </form>
    </div>
</body>
</html>