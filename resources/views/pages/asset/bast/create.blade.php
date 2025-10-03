<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah User</title>
</head>

<body>
    <h1>Tambah Pengguna Baru</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Tambah</button>
        <a href="{{ route('users.index') }}">Batal</a>
    </form>
</body>

</html>
