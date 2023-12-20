<?= $this->extend('common/default_layout') ?>
<?= $this->section('content') ?>
<section class="pagebanner pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bannerTitle text-left">
                    <h2>Default Page</h2>
                    <p>This is default page</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Banner -->

<!-- Common section -->
<section>
    <div class="container">
        <h4>Hello Welcome to CI4Backend</h4>
    </div>
</section>
<!-- End Common section -->
<?= $this->endsection() ?>
<?= $this->section('script') ?>
<script src="<?php echo base_url() ?>assets/js/custom/faq.js"></script>
<?= $this->endsection() ?>