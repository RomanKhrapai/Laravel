<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Page - @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container-fluid overflow-hidden">
        <div class="row vh-100 overflow-auto">
            <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-secondary d-flex sticky-top">
                <div
                    class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
                    <a href="{{ route('home') }}"
                        class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <span class="h3">Admin panel</span>
                    </a>

                    <div class=" p-2 no-select block-menu">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <div data-bs-toggle="collapse" data-bs-target="#node1" aria-expanded="false"
                                    aria-controls="node1">Data tables</div>
                                <ul class="collapse " id="node1">

                                    @can('view', auth()->user())
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('users.index') }}" class="dropdown-item">Users</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Company::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('companies.index') }}" class="dropdown-item">Companies</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Vacancy::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('vacancies.index') }}" class="dropdown-item">Vacancies</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Candidate::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('candidates.index') }}" class="dropdown-item">Candidates</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Review::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('reviews.index') }}" class="dropdown-item">Reviews</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div data-bs-toggle="collapse" data-bs-target="#node2" aria-expanded="false"
                                    aria-controls="node2">Data options</div>
                                <ul class="collapse" id="node2">
                                    @can('viewAny', App\Models\Area::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('areas.index') }}" class="dropdown-item">Areas</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Profession::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('professions.index') }}" class="dropdown-item">Professions</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Nature::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('natures.index') }}" class="dropdown-item">Natures</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Type::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('types.index') }}" class="dropdown-item">Types</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Skill::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('skills.index') }}" class="dropdown-item">Skills</a>
                                        </li>
                                    @endcan
                                    @can('viewAny', App\Models\Role::class)
                                        <li class="list-group-item item-action">
                                            <a href="{{ route('roles.index') }}" class="dropdown-item">Roles</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </div>


                    <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                        @isset(Auth::user()->name)
                            @if (Auth::user()->image)
                                <img src="{{ Storage::url(Auth::user()->image) }}" alt="avatar" width="28"
                                    height="28" class="rounded-circle">
                            @else
                                <img src="https://i.gyazo.com/50c000c0e4715eba3a2d778c01ac1c5c.png" alt="avatar"
                                    width="28" height="28" class="rounded-circle">
                            @endif
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            @if (Auth::user()->role)
                                <h4>{{ Auth::user()->role->name }} </h4>
                            @else
                                <p>User has no role assigned.</p>
                            @endif
                        @endisset
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">

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
