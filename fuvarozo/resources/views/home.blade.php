<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuvarozó rendszer</title>
</head>
<body>
    <div style="border: 3px solid black; padding: 3px; margin: 2px;">
        <h2>Regisztráció</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">Regisztráció</button>
        </form>
    </div>

    <div style="border: 3px solid black; padding: 3px; margin: 2px;">
        <h2>Bejelentkezés</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button type="submit">Bejelentkezés</button>
        </form>
    </div>
    <div style="border: 3px solid black; padding: 3px; margin: 2px;">
        <h2>Admin felhasználó és két munkás (Jozsi, Sanyi) hozzáadása</h2>
        <form action="/admin" method="POST">
            @csrf
            <button type="submit">Létrehozás</button>
        </form>
    </div>
</body>
</html>