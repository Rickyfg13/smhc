<div class="form-group">
    <label for="therapy">Therapy</label>
    <select name="therapy" class="form-control select2">
       
        <?php foreach ($dataTherapy as $row) : ?>
            <option value=""><?= $row->title; ?></option>
        <?php endforeach ?>
    </select>
</div>