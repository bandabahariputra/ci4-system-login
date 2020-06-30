<?= $this->extend('_layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Dashboard page</h4>
            </div>
            <div class="card-body">
                <?= $session->get('logged_in') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>