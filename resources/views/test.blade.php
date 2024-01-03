@extends('layouts.admin')

@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <div class="toggle-btn-container text-center">
                    <button class="toggle-btn" onclick="toggleSidebar()">☰ Toggle Menu</button>
                </div>
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    Головна <span class="sr-only">(Поточна)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Про нас
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Контакти
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="mt-5">Ваш зміст тут</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...</p>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('d-md-block');
        }
    </script>
@endsection
