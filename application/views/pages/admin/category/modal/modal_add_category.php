<div class="modal fade bd-example-modal-lg" id="modalAddCategory">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="formAddCategory">
                    <div class="form-group">
                        <label for="title_category">Title</label>
                        <input type="text" class="form-control" name="title" id="title_category" onkeyup="createSlug('#title_category')" aria-describedby="emailHelp" placeholder="Title of Category">
                        <span id="title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-rounded btn-hers">Add Data</button>
            </div>
            </form>
        </div>
    </div>
</div>