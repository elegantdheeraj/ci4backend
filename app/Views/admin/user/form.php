<?= $this->extend('admin/common/default_layout') ?>
<?= $this->section('style') ?>

<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <form id="user-form" name="user-form" class="needs-validation"
        action="<?= !empty($userDetails) ? base_url('backend/user/edit/' . $userDetails->id) : base_url('backend/user/add') ?>"
        method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-sm-4 mb-2">
                <label class="form-label" for="code">User Code</label>
                <input type="text" class="form-control text-capitalize" id="code" name="code"
                    value="<?= isset($userDetails) ? $userDetails->code : '' ?>" autocomplete="true" required/>
                <div class="invalid-feedback">Please fill user code.</div>
            </div>
            <div class="col-sm-4 mb-2">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control text-capitalize" id="name" name="name"
                    value="<?= isset($userDetails) ? $userDetails->name : '' ?>" autocomplete="true" required/>
                <div class="invalid-feedback">Please fill name.</div>
            </div>
            <div class="col-sm-4 mb-2">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= isset($userDetails) ? $userDetails->email : '' ?>" autocomplete="true" />
            </div>
            <div class="col-sm-4 mb-2">
                <label class="form-label" for="phone">Mobile</label>
                <input type="text" data-inputmask-mask="9999999999" inputmode="numeric" class="form-control" id="phone" name="phone"
                    value="<?= isset($userDetails) ? $userDetails->phone : '' ?>" autocomplete="true" required/>
                <div class="invalid-feedback">Please fill mobile.</div>
            </div>
            <div class="col-sm-4 mb-2">
                <label class="form-label" for="dob">DOB</label>
                <input type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" inputmode="numeric" class="form-control" id="dob" name="dob"
                    value="<?= isset($userDetails) ? $userDetails->dob : '' ?>" autocomplete="true"/>
                <div class="invalid-feedback">Please fill DOB.</div>
            </div>
            <?php if (empty($userDetails)) { ?>
                <div class="col-sm-4 mb-2">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control password-f" id="password" name="password" required/>
                    <div class="invalid-feedback">Please fill password.</div>
                </div>
                <div class="col-sm-4 mb-2">
                    <label class="form-label" for="c_password">Confirm Password</label>
                    <input type="password" class="form-control c-password-f" id="c_password" name="c_password" required/>
                </div>
            <?php } ?>
            <div class="col-sm-4 mb-2">
                <label class="form-label" for="role">User Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Select User Group</option>
                    <?php foreach($roles as $role) : ?>
                        <option value="<?= $role->code ?>" <?= isset($userDetails) ? ($userDetails->role == $role->code ? 'selected' : '') : '' ?>><?= $role->name ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please choose user role.</div>
            </div>
            <div class="col-sm-4 col-md-3 mb-2">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="in-active" <?= isset($userDetails) ? ($userDetails->status == 0 ? 'selected' : '') : '' ?>>In-Active</option>
                    <option value="active" <?= isset($userDetails) ? ($userDetails->status == 1 ? 'selected' : '') : '' ?>>Active</option>
                </select>
                <div class="invalid-feedback">Please choose user status.</div>
            </div>
            <?php if (!empty($userDetails)) { ?>
                <div class="col-sm-12 mb-2 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="reset_password" id="reset_password"
                            value="true">
                        <label class="form-check-label" for="reset_password">
                            Want to reset password <i class="fa fa-question" aria-hidden="true"></i>
                        </label>
                    </div>
                </div>
                <div id="reset_password_form" class="col-sm-12 mb-2">
                    <!-- dynamic fields added -->
                </div>
            <?php } ?>
            <div class="col-sm-12 my-2">
                <a href="<?= base_url('backend/users') ?>" type="button" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary user_data_submit">Save</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script>
    $('#reset_password').change(function() {
        if($(this).is(":checked")) {
            var field = '<div class="row pt-3">'+
                '<div class="form-group required col-sm-4 col-md-3">'+
                    '<label class="control-label" for="inputEmail4">Password</label>'+
                    '<input type="password" class="form-control password-f" id="password" name="password" />'+
                '</div>'+
                '<div class="form-group required col-sm-4 col-md-3">'+
                    '<label class="control-label" for="inputEmail4">Confirm Password</label>'+
                    '<input type="password" class="form-control c-password-f" id="c_password" name="c_password"/>'+
                '</div>'+
            '</div>';
            $('#reset_password_form').html(field);
        } else {
            $('#reset_password_form').html('');
        }
    });
    $('#reset_password_form').on('focusout', '.c-password-f', function() {
        if($('.password-f').val() != '') {
            if($(this).val() !== $('.password-f').val()) {
                $(this).val('');
                iziToast.error({
                    message: 'Confirm Password not matched'
                });
                return false;
            }
        } else {
            $(this).val('');
            iziToast.error({
                message: 'Fill Password first'
            });
        }
    });
    $(document).ready(function() {
        var maxBirthdayDate = new Date();
        // max="2017-04-30"
        maxBirthdayDate = (maxBirthdayDate.getFullYear() - 18) + "-" + (maxBirthdayDate.getMonth() + 1).toString().padStart(2, '0') + "-" + (maxBirthdayDate.getDay() + 1).toString().padStart(2, '0');
        $("#dob").attr('max', maxBirthdayDate);
    });
    
</script>
<?= $this->endsection() ?>