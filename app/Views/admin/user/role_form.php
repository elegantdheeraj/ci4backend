<?= $this->extend('admin/common/default_layout') ?>
<?= $this->section('style') ?>
<style>
    .menu_list {
        height: 250px;
    }
    ul.tree,
    ul.tree * {
        list-style-type: none;
        margin: 0;
        padding: 0 0 5px 0;
        font-size: 11px;
    }

    ul.tree img.arrow {
        padding: 2px 0 0 0;
        border: 0;
        width: 20px;
    }

    ul.tree li {
        padding: 4px 0 0 0;
    }

    ul.tree li ul {
        padding: 0 0 0 20px;
        margin: 0;
    }

    ul.tree label {
        cursor: pointer;
        font-weight: bold;
        padding: 2px 0;
    }

    ul.tree label.hover {
        color: red;
    }

    ul.tree li .arrow {
        width: 20px;
        height: 18px;
        padding: 0;
        margin: 0;
        cursor: pointer;
        float: left;
        background: transparent no-repeat 0 0px;
    }

    ul.tree li .collapsed {
        background-image: url('<?php echo base_url() ?>assets/admin/plugins/treeview/images/right.svg')
    }

    ul.tree li .expanded {
        background-image: url('<?php echo base_url() ?>assets/admin/plugins/treeview/images/down.svg')
    }

    ul.tree li .checkbox {
        width: 20px;
        height: 18px;
        padding: 0;
        margin: 0;
        cursor: pointer;
        float: left;
        background: url('<?php echo base_url() ?>assets/admin/plugins/treeview/images/square.svg') no-repeat 0 0px;
    }

    ul.tree li .checked {
        background-image: url('<?php echo base_url() ?>assets/admin/plugins/treeview/images/check.svg')
    }

    ul.tree li .half_checked {
        background-image: url('<?php echo base_url() ?>assets/admin/plugins/treeview/images/square-minus.svg')
    }
</style>
<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <form id="user-form" name="user-form" class="needs-validation"
        action="<?= !empty($roleDetails) ? base_url('backend/role/edit/'.$roleDetails->id) : base_url('backend/role/add') ?>"
        method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-sm-3 mb-2">
                <label class="form-label" for="code">User Code</label>
                <input type="text" class="form-control user-form-input text-uppercase" id="code" name="code"
                    value="<?= !empty($roleDetails) ? $roleDetails->code : '' ?>" autocomplete="true"
                    required />
                <div class="invalid-feedback">Please fill role code.</div>
            </div>
            <div class="col-sm-5 mb-2">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control user-form-input text-capitalize" id="name" name="name"
                    value="<?= !empty($roleDetails) ? $roleDetails->name : '' ?>" autocomplete="true"
                    required />
                <div class="invalid-feedback">Please fill name.</div>
            </div>

            <div class="col-sm-4 col-md-2 mb-2">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="in-active" <?= !empty($roleDetails) ? ($roleDetails->status == 0 ? 'selected' : '') : '' ?>>In-Active</option>
                    <option value="active" <?= !empty($roleDetails) ? ($roleDetails->status == 1 ? 'selected' : '') : '' ?>>Active</option>
                </select>
                <div class="invalid-feedback">Please choose role status.</div>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label" for="status">Access Permission</label>
                <div class="menu_list border p-2 bg-white w-100 overflow-auto">
                    <?= $menus ?>
                </div>
                <div class="mt-2">
                    <strong>Access</strong>
                    <a id="Select_All" onclick="">Select All</a> / <a id="Un_Select_All">Un Select All</a>
                </div>
            </div>
            <div class="col-sm-12 my-2">
                <a href="<?= base_url('backend/roles') ?>" type="button" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary role_data_submit">Save</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url() ?>assets/admin/plugins/treeview/jquery.checktree.js"></script>
<script>
    var checktree = '';
    $(document).ready(function () {
        checktree = $('ul.tree').checkTree();
    });
    $("#Select_All").click(function () {
        unset();
        $('ul.tree').find('.checkbox')
            .addClass('checked')
            .siblings(':checkbox').prop('checked', true);
    });
    $("#Un_Select_All").click(function () {
        unset();
    });
    function unset() {
        $('ul.tree').find('.checkbox')
            .removeClass('checked half_checked')
            .siblings(':checkbox').prop('checked', false);
    }
</script>
<?= $this->endsection() ?>