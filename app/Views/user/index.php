<?= $this->extend('_layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h4>Data User</h4>
                <a href="/user/new" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <?php if ($session->get('msg')) : ?>
                    <div class="flashdata" data-msg="<?= $session->get('msg') ?>"></div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $user['nama']; ?></td>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td>
                                        <form action="/user/<?= $user['username']; ?>/changestatus" method="POST">
                                            <input type="hidden" name="_method" value="PATCH" />
                                            <input type="submit" class="btn btn-sm btn-rounded <?= ($user['is_active'] == 1 ? 'btn-success' : 'btn-warning') ?>" value="<?= ($user['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif') ?>">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="/user/<?= $user['username']; ?>/edit" class="btn btn-sm btn-success">Edit</a>
                                        <a href="/user/<?= $user['id']; ?>" class="btn btn-sm btn-danger btn-delete" data-username="<?= $user['username']; ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>