<!-- Modal para cadastro de posts -->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Cadastro de Postagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="">Titulo da Postagem <sup class="text-danger">*</sup></label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">iFrame do vídeo <sup class="text-danger">*</sup></label>
                        <input type="text" name="iframe_video" id="iframe_video" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Postar em Grupos</label>
                        <select name="groups" id="groups" class="form-control" multiple>
                            @foreach(App\Models\Group::all() as $group)
                                <option value="{{ $group->id }}">{{ $group->name_group }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Conteúdo</label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" onclick="createPost()" class="btn btn-primary"><i class="fa fa-save"></i> Salvar Postagem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
