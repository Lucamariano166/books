<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Book Store</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Itens do lado direito da barra de navegação -->
            @guest
            <!-- Links de autenticação para usuários não autenticados -->


                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest

        </div>
    </nav>
    <h1>Book Store</h1>
    <form id="add-book-form" method="POST" action="{{ route('books.store') }}">
        @csrf
        <h2>Add Book</h2>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="isbn" placeholder="ISBN" required>
        <input type="text" name="value" placeholder="Value" required>
        <button type="submit">Add</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>ISBN</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->name }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->value }}</td>
                <td>
                    <form id="edit-book-form" method="POST" action="{{ route('books.update', ['book' => $book->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $book->name }}" required>
                        <input type="text" name="isbn" value="{{ $book->isbn }}" required>
                        <input type="text" name="value" value="{{ $book->value }}" required>
                        <button type="submit">Update</button>
                    </form>
                    <form class="delete-book-form" data-book-id="{{ $book->id }}" method="POST" action="{{ route('books.destroy', ['book' => $book->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @auth
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endauth

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
