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
    <form class="needs-validation" action="<?= !empty($menu) ? base_url('backend/menu/edit/'.$menu->id) : base_url('backend/menu/add') ?>" method="post" enctype="multipart/form-data" novalidate >
        <div class="row">
            <div class="mb-3 col-12 text-end">
                <a href="<?= base_url('backend/menus') ?>" class="btn btn-danger">Cancel</a>
                <button type="submit" id="submit_btn" class="btn btn-success">Save</button>
            </div>
            <div class="mb-3 col-sm-4">
                <label for="m_name" class="form-label">Name</label>
                <input type="text" class="form-control text-capitalize" id="m_name" name="name" value="<?= !empty($menu) ? $menu->name : "" ?>" placeholder="Menu Name" required />
                <div class="invalid-feedback">Please fill name.</div>
            </div>
            <div class="mb-3 col-sm-4">
                <label for="m_url" class="form-label">URL</label>
                <input type="text" class="form-control" id="m_url" name="url" value="<?= !empty($menu) ? $menu->url : "" ?>" placeholder="URL" required />
                <div class="invalid-feedback">Please fill url.</div>
            </div>
            <div class="mb-3 col-sm-4">
                <label for="m_parent" class="form-label">Parents</label>
                <select class="form-select" id="m_parent" name="parent">
                    <option value="">Select Parents</option>
                    <?php foreach($menus as $m) : ?>
                        <option value="<?= $m->id ?>" <?= !empty($menu) ? ($menu->parent == $m->id ? 'selected' : '') : '' ?>><?= $m->name." (".$m->url.")" ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-3 col-sm-4">
                <label for="m_sequence" class="form-label">Sequence</label>
                <input type="text" class="form-control" id="m_sequence" name="sequence" value="<?= !empty($menu) ? $menu->sequence : "0" ?>" placeholder="Menu Sequence no" required />
                <div class="invalid-feedback">Please fill Sequence in numeric.</div>
            </div>
            <div class="mb-3 col-md-3 col-sm-4">
                <label for="m_visible" class="form-label">Is Visible</label>
                <select id="m_visible" name="is_visible" class="form-select" aria-label="Menu Is Visible" required>
                    <option value="yes" <?= !empty($menu) ? ($menu->is_visible == 1 ? "selected" : "") : "" ?>>Yes</option>
                    <option value="no" <?= !empty($menu) ? ($menu->is_visible == 0 ? "selected" : "") : "" ?>>No</option>
                </select>
            </div>
            <div class="mb-3 col-md-3 col-sm-4">
                <label for="m_status" class="form-label">Status</label>
                <select id="m_status" name="status" class="form-select" aria-label="Menu Status" required>
                    <option value="active" <?= !empty($menu) ? ($menu->status == 1 ? "selected" : "") : "" ?>>Active</option>
                    <option value="in-active" <?= !empty($menu) ? ($menu->status == 0 ? "selected" : "") : "" ?>>In Active</option>
                </select>
            </div>
        </div>
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        const choices = new Choices("#m_parent", { allowHTML: true });
    });
</script>
<?= $this->endsection() ?>