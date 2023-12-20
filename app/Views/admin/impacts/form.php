<?= $this->extend('admin/common/default_layout') ?>
<?= $this->section('style') ?>

<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <form class="needs-validation" action="<?= !empty($story_data) ? base_url('backend/impact/edit/'.$story_data['id']) : base_url('backend/impact/add') ?>" method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3 required">
                    <label for="i_title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="i_title" name="i_title" value="<?= !empty($story_data) ? $story_data['title'] : "" ?>" placeholder="Title" required>
                </div>
            </div>
            <div class="col-sm-12 mb-3">
                <div class="clearfix">
                    <label for="impact_story" class="form-label">Impact Story</label> <span id="page-editor-loader"><div class="spinner-border spinner-border-sm" role="status"></div></span>
                    <textarea class="d-none form-control page-editor" id="impact_story" name="impact_story" required><?= !empty($story_data) ? $story_data['impact_story'] : "" ?></textarea>
                </div>
            </div>
            <div class="mb-3 col-sm-4">
                <label for="publish_status" class="form-label">Publish Status</label>
                <select id="publish_status" name="publish_status" class="form-select" aria-label="Publish Status" required>
                    <option value="yes" <?= !empty($story_data) ? ($story_data['publish_status'] == 1 ? "selected" : "") : "" ?>>Yes</option>
                    <option value="no" <?= !empty($story_data) ? ($story_data['publish_status'] == 0 ? "selected" : "") : "" ?>>No</option>
                </select>
            </div>
            <div class="mb-3 col-12">
                <a href="<?= base_url('backend/impact') ?>" class="btn btn-danger">Cancel</a>
                <button type="submit" id="submit_btn" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url() ?>assets/admin/plugins/tinymce5/tinymce.min.js"></script>
<script>
    $(window).on('load', function() {
        $('#page-editor-loader').addClass('d-none');
        $(".page-editor").removeClass('d-none');
    });
    $(document).ready(function() {
        if ($("#impact_story").length > 0) {
            tinymce.remove();
            tinymce.init({
                selector: "textarea#impact_story",
                // extended_valid_elements: 'img[src|alt|title]',
                height: 350,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'imagetools', 'wordcount'
                    ],
                toolbar: 'fontsizeselect | searchreplace undo redo | blocks | bold italic | alignleft aligncentre alignright alignjustify | indent outdent | bullist numlist table link code fullscreen emoticons',
                fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
                content_style: 'body { font-size: 12px; }',
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                },
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        }
    });
   
</script>
<?= $this->endsection() ?>