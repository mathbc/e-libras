<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            body {
                background-color: #c5c5c5;
            }
        </style>
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg shadow navbar-light bg-light">
            <a class="navbar-brand" href="#">e-Libras</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        @if(!auth()->user())
                        <a class="nav-link" href="{{ route('login') }}">
                            Entrar
                        </a>
                        @else
                        <a class="nav-link" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ auth()->user()->name }} / Sair
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
        <div class="alert"></div>
        <div class="conteiner mt-5">
            <div class="row justify-content-center">
                @foreach(App\Models\Post::all() as $post)
                    <div class="section col-md-7 mt-4">
                        <div class="row justify-content-center">{!! $post->iframe_video !!}</div>
                        <div class="row justify-content-center">
                            <div class="card shadow" style="width: 95%;">
                                <div class="card-body">
                                    <h4>{{ $post->title }}</h4>
                                    <p>{{ $post->content }}</p>
                                    <h5><b>Grupos relacionados:</b>
                                    @foreach($post->groups as $group)
                                        {{ $group->name_group }},
                                    @endforeach
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
