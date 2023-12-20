<?= $this->extend('admin/common/default_layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="container-fluid text-end p-0 pb-2">
            <a class="btn btn-primary" href="<?= base_url('backend/role/add') ?>" data-bs-toggle="tooltip" data-bs-title="Add New Role"><i class="align-middle" data-feather="plus"></i> New Role</i></a>
        </div>
        <div class="col-12 bg-white">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = ($pager->getCurrentPage()-1)*10; if($roles) : foreach($roles as $role) : ?>
                        <tr>
                            <td class="fw-bold" scope="row"><?= ++$sno; ?></td>
                            <td><span class="btn btn-link"><?= $role->code ?></span></td>
                            <td><?= $role->name ?></td>
                            <td><?= $role->status == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">In-Active</span>' ?></td>
                            <td class="text-center fw-bold">
                                <a href="<?= base_url('backend/role/edit/'.$role->id) ?>" ><i class="align-middle" data-feather="edit"></i></a> | 
                                <a href="<?= base_url('backend/role/delete/'.$role->id) ?>" class="delete_role" ><i class="align-middle text-danger" data-feather="trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr><td class="text-danger" colspan="99">No record found</td></tr>    
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="container-fluid mt-3 p-0">
            <span class="align-middle float-end"><?= $pager->links() ?></span>
        </div>
    </div>
</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script>
    $(".delete_role").click(function() {
        $(this).html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    });
</script>
<?= $this->endsection() ?>