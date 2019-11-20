@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('posts/css/posts.css') }}">
@endsection

@section('content')
<div class="col-md-12">
    <div class="card bg-light mt-4" id="cardInputs">
        <div class="card-body">
            <div class="row">
                <div class="input-group col-md-4 mb-3">
                    <input type="text" class="form-control" id="searchInput" placeholder="Filtrar Postagem" aria-label="Filtrar por postagem específica" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#postModal"><i class="fa fa-plus"></i> Nova Postagem</button>
                    <button class="btn btn-success" type="button" onclick="getPosts()"><i class="fa fa-sync-alt"></i> Recarregar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="postagens">
            <div class="col-md-12">
                <div class="spinner-border" id="spinnerPosts">
                    <span class="sr-only">Buscando...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Incluindo Modal de cadastro-->
@include('posts.includes.modal-create-post')
@endsection

@section('js')
    <script src="{{ asset('posts/js/ajax.js') }}"></script>
    <script src="{{ asset('posts/js/FilterPost.js') }}"></script>
    <!-- O script que realiza o Get dos posts deve ficar no template -->
    <script>
        $(document).ready(function () {
            $('#spinnerPosts').hide();
        })
    </script>
@endsection
