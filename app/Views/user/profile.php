<?= $this->extend('_layouts/app'); ?>

<?= $this->section('content'); ?>
<h2 class="section-title">Hai, <?= $user_logged_in['nama']; ?>!</h2>
<p class="section-lead">
    Ubah profile di halaman ini.
</p>

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
            </div>
            <div class="profile-widget-description">
                <div class="profile-widget-name"><?= $user_logged_in['nama']; ?> <div class="text-muted d-inline font-weight-normal">
                        <div class="slash"></div> <?= $user_logged_in['username']; ?>
                    </div>
                </div>
                Bergabung sejak: <b><?= $user_logged_in['created_at']; ?></b>
            </div>
            <div class="card-footer text-center">
                <div class="font-weight-bold mb-2"><?= $user_logged_in['role']; ?></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <?php if ($session->get('msg')) : ?>
                <div class="flashdata" data-msg="<?= $session->get('msg') ?>"></div>
            <?php endif; ?>
            <form action="/user/<?= $user_logged_in['id']; ?>/changeprofile" method="POST">
                <input type="hidden" name="_method" value="PATCH" />
                <input type="hidden" name="id" value="<?= $user_logged_in['id']; ?>">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Nama</label>
                            <input type="text" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>" name="nama" value="<?= (old('nama') ? old('nama') : $user_logged_in['nama']) ?>">
                            <span class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </span>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Username</label>
                            <input type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>" name="username" value="<?= (old('username') ? old('username') : $user_logged_in['username']) ?>">
                            <span class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Email</label>
                            <input type="text" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" name="email" value="<?= (old('email') ? old('email') : $user_logged_in['email']) ?>">
                            <span class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>