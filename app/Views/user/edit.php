<?= $this->extend('_layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit User</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <form action="/user/<?= $user['id']; ?>" method="POST">
                            <input type="hidden" name="_method" value="PATCH" />
                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>" name="nama" value="<?= (old('nama') ? old('nama') : $user['nama']) ?>">
                                <span class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>" name="username" value="<?= (old('username') ? old('username') : $user['username']) ?>">
                                <span class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" name="email" value="<?= (old('email') ? old('email') : $user['email']) ?>">
                                <span class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2 <?= ($validation->hasError('role') ? 'is-invalid' : '') ?>" name="role">
                                    <option selected disabled>- Belum ada data -</option>
                                    <?php if ($user['role'] == 'Admin') : ?>
                                        <option value="Admin" selected>Admin</option>
                                        <option value="Member">Member</option>
                                    <?php else : ?>
                                        <option value="Admin">Admin</option>
                                        <option value="Member" selected>Member</option>
                                    <?php endif; ?>
                                </select>
                                <span class="invalid-feedback">
                                    <?= $validation->getError('role'); ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a href="/user" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>