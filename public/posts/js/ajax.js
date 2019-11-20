// Passando meta tag do csrf
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function getPosts() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '/e-libras/public/postagens/get-posts',
        success: function(response) {
            var posts = '';

            $.each(response.posts, function(key, value) {
                // Decisão para saber se o usuário é o criador do post
                if(value.user_id == response.authUser.id)
                {
                    /*
                    *
                    *   Buscar melhor forma para manipular a visualização
                    *
                    */
                    // Template String com o conteúdo da postagem
                    posts = posts +
                    `<section>
                        <div class="row justify-content-center">
                            ${value.iframe_video}
                        </div>
                        <div class="row justify-content-center">
                            <div class="card" style="width: 95%;">
                                <div class="card-body">
                                    <h4>
                                      ${value.title}
                                    </h4>
                                    <br>
                                    <p>${value.content}</p>
                                    <p>Likes: ${Object.keys(value.likes).length}</p>
                                    <p>Dislikes: ${Object.keys(value.dislikes).length}</p>
                                    <a href="/postagens/edit-post/${value.id}" class="btn"><i class="fa fa-edit text-primary"></i></a>
                                    <button class="btn" type="button" onclick="deletePost(${value.id})"><i class="fa fa-trash text-danger"></i></button>
                                    <button class="btn" onclick="likePost(${value.id})">
                                        <i class="far fa-thumbs-up" style="font-size: 20px;"></i>
                                    </button>
                                    <button class="btn" onclick="dislikePost(${value.id})">
                                        <i class="far fa-thumbs-down" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section><hr>`;
                }else {
                    posts = posts +
                    `<section>
                        <div class="row justify-content-center">
                            ${value.iframe_video}
                        </div>
                        <div class="row justify-content-center">
                            <div class="card" style="width: 95%;">
                                <div class="card-body content-post">
                                    <h4>
                                      ${value.title}
                                    </h4>
                                    <br>
                                    <p>${value.content}</p>
                                    <p>Likes: ${Object.keys(value.likes).length}</p>
                                    <p>Dislikes: ${Object.keys(value.dislikes).length}</p>
                                    <h5><b>Cadastrado por: </b>${value.user.name}</h5>
                                    <br>
                                    <button class="btn" onclick="likePost(${value.id})">
                                        <i class="far fa-thumbs-up" style="font-size: 20px;"></i>
                                    </button>
                                    <button class="btn" onclick="dislikePost(${value.id})">
                                        <i class="far fa-thumbs-down" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section><hr>`;
                }
            });

            if(posts.length <= 0)
            {
                var alerta = `
                            <div class="alert" style="background-color: #f6ff82; border: 2px solid #f1ff4a;">
                                <i class="fa fa-frown-open" style="font-size: 20px"></i> Nenhuma Postagem cadastrada
                            </div>
                        `;
                $('#postagens').html(alerta);
            }else {
                $('#spinnerPosts').show();
                $('#postagens').html(posts);
                $('#spinnerPosts').hide();
            }
        }
    });
}

getPosts()

function clearForm() {
    $('#title').val('');
    $('#iframe_video').val('');
    $('#groups').val('');
    $('#content').val('');
}

function createPost() {
    var title = $('#title').val();
    var iframe_video = $('#iframe_video').val();
    var groups = $('#groups').val();
    var content = $('#content').val();
    console.log(groups)
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {title:title, iframe_video:iframe_video, groups:groups, content:content},
        url: '/e-libras/public/postagens/create-post',
        success: function(response){
            getPosts();
            $('#postModal').modal('hide');
            toastr.success('Postagem Cadastrada com sucesso');
            clearForm();
        },
        error: function () {
            toastr.error('Falha ao cadastrar postagem');
        }
    });
}

function editPost(id, title, iframe_video, content) {
    console.log(id + title);
}

function deletePost(id) {
    Swal.fire({
       title: "Você tem certeza?",
       text: "O processo não poderá ser revertido",
       showCancelButton: true,
       confirmButtonColor: "#68c344",
       cancelButtonColor: "#c32f38"
    }).then((result) => {
        if(result.value) {
            $.ajax({
                type: 'DELETE',
                dataType: "json",
                url: '/e-libras/public/postagens/delete-post/'+id,
                success: function() {
                    getPosts();
                    toastr.success('Postagem deletada com sucesso');
                }
            })
        }
    });
}

function likePost(id) {
    var post_id = id;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/e-libras/public/postagens/like-post/'+post_id,
        success: function(response) {
            getPosts();
            console.log(response.message);
        }
    });
}

function dislikePost(id)
{
    var post_id = id;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/e-libras/public/postagens/dislike-post/'+post_id,
        success: function(response) {
            getPosts();
            console.log('Post disliked');
        }
    })
}

