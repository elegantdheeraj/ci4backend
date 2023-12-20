<?= $this->extend('admin/common/default_layout') ?>
<?= $this->section('style') ?>
    <style>
        .c_height {
            height : 200px;
            object-fit: scale-down;
        }
    </style>
<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <form class="needs-validation" action="<?= !empty($image) ? base_url('backend/image/edit/'.$image['id']) : base_url('backend/image/add') ?>" method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="mb-3 col-12 text-end">
                <a href="<?= base_url('backend/images') ?>" class="btn btn-danger">Cancel</a>
                <button type="submit" id="submit_btn" class="btn btn-success">Save</button>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 required">
                    <label for="i_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="i_name" name="i_name" value="<?= !empty($image) ? $image['name'] : "" ?>" placeholder="Image Name" required>
                </div>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="image_upload" class="form-label">Image Upload</label>
                <input type="file" class="form-control" name="image_upload" id="image_upload" accept="image/*" required/>
            </div>
            <div class="mb-3 col-sm-12">
                <label for="image_upload" class="form-label">Preview Image</label>
                <img class="form-control c_height" src="<?= !empty($image) ? $image['url'] : "" ?>" id="preview_image" />
            </div>
        </div>
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script>

</script>
<?= $this->endsection() ?>