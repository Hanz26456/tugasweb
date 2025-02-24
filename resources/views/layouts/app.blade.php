<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Perpustakaan</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}">Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('loans.index') }}">Peminjaman & Pengembalian</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Kategori</a></li>
    
                    <!-- Dropdown untuk memilih anggota -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="historyDropdown" role="button" data-bs-toggle="dropdown">
                            History
                        </a>
                        <ul class="dropdown-menu">
                            @foreach(App\Models\Member::all() as $m)
                                <li>
                                    <a class="dropdown-item" href="{{ route('members.history', ['member' => $m->id]) }}">
                                        {{ $m->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
