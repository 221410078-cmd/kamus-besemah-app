<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0d2b53;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .logout-form {
            margin: 0;
        }

        .logout-form button {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-form button:hover {
            background-color: #c0392b;
        }

        main {
            padding: 40px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        .card h2 {
            color: #0d2b53;
        }

        .card p {
            color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    <main>
        <div class="card">
            <h2>Selamat Datang, {{ Auth::user()->username }}!</h2>
            <p>Anda berhasil login sebagai <strong>Admin</strong>.</p>
            <p>Di halaman ini nanti kamu bisa mengelola data, pengguna, dan konten aplikasi.</p>
        </div>
    </main>

</body>
</html>
