<form action="#" method="POST" id="formEditCategory">
    <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    </div>
    <div class="modal-body">

        <input type="hidden" name="id" id="id_category" value="<?= $getCategory->id; ?>">
        <div class="form-group">
            <label for="title_category">Title</label>
            <input type="text" class="form-control" name="title" id="title_category" onkeyup="createSlug()" aria-describedby="emailHelp" placeholder="Title of Category" value="<?= $getCategory->title; ?>">
            <span id="title_error"></span>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="<?= $getCategory->slug; ?>" readonly>
        </div>



    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-rounded btn-hers">Update Data</button>
    </div>
</form> 