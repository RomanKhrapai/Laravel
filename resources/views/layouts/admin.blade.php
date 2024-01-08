<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Page - @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container-fluid overflow-hidden">
        <div class="row vh-100 overflow-auto">
            <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-secondary d-flex sticky-top">
                <div
                    class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
                    {{-- <a href="{{ route('layouts.admin') }}" 
                    class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-dark text-decoration-none"> --}}
                    <span class="h3">Admin panel</span>
                    {{-- </a> --}}
                    <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Users</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownUser1">
                                    <li>
                                        <a href="{{ route('users.index') }}" class="dropdown-item">All users</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('users.create') }}" class="dropdown-item">Create user</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownArea" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Areas</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownArea">
                                    <li>
                                        <a href="{{ route('areas.index') }}" class="dropdown-item">All areas</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('areas.create') }}" class="dropdown-item">Create area</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownArea" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Categories</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownArea">
                                    <li>
                                        <a href="{{ route('categories.index') }}" class="dropdown-item">All
                                            categories</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('categories.create') }}" class="dropdown-item">Create
                                            category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownArea" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Languages</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownArea">
                                    <li>
                                        <a href="{{ route('languages.index') }}" class="dropdown-item">All
                                            languages</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('languages.create') }}" class="dropdown-item">Create
                                            language</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownArea" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Natures</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownArea">
                                    <li>
                                        <a href="{{ route('natures.index') }}" class="dropdown-item">All
                                            natures</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('natures.create') }}" class="dropdown-item">Create
                                            nature</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownArea" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Types</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownArea">
                                    <li>
                                        <a href="{{ route('types.index') }}" class="dropdown-item">All
                                            types</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('types.create') }}" class="dropdown-item">Create
                                            type</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownSkill" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Skills</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownSkill">
                                    <li>
                                        <a href="{{ route('skills.index') }}" class="dropdown-item">All skills</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('skills.create') }}" class="dropdown-item">Create skill</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown py-sm-2 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                                <a href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    id="dropdownRole" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-sm-inline mx-1 text-dark h5">Roles</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownRole">
                                    <li>
                                        <a href="{{ route('roles.index') }}" class="dropdown-item">All roles</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.create') }}" class="dropdown-item">Create role</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                    </ul>


                    <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                        @isset(Auth::user()->name)
                            <img src="https://i.gyazo.com/50c000c0e4715eba3a2d778c01ac1c5c.png" alt="avatar"
                                width="28" height="28" class="rounded-circle">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <h4>{{ Auth::user()->role->name }} </h4>
                        @endisset
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                            aria-labelledby="dropdownUser1">

                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                        </ul>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col d-flex flex-column bg-dark h-sm-100">
                <main class="row overflow-auto">
                    <div class="col pt-4">

                        <!-- Main content -->
                        <section class="content px-sm-4">
                            @yield('content')
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>

</body>

</html>
