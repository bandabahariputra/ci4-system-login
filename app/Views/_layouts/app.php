<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/vendor/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">

    <!-- iziToast -->
    <link rel="stylesheet" href="<?= base_url() ?>/vendor/iziToast/dist/css/iziToast.min.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block"><?= $user_logged_in['nama']; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <?= $this->include('_layouts/sidebar'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $title; ?></h1>
                    </div>

                    <div class="section-body">
                        <?= $this->renderSection('content'); ?>
                    </div>
                </section>
            </div>

            <!-- Modal Confirm -->
            <div class="modal fade modal-confirm" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Yakin ingin menghapus?</h5>
                        </div>
                        <div class="modal-body">
                            <p class="text-in-modal"></p>
                            <p class="ml-2"><b>*</b>) Data tersebut tidak dapat dikembalikan.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeModalConfirm()">Batal</button>
                            <form class="form-delete" action="" method="POST">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="submit" class="btn btn-danger" value="Hapus">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2020 <div class="bullet"></div> Made with &hearts; By <a href="https://bandabahariputra.now.sh/">Banda Bahari Putra</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/vendor/jquery/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/vendor/momentjs/moment.js"></script>
    <script src="<?= base_url() ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom.js"></script>

    <!-- iziToast -->
    <script src="<?= base_url() ?>/vendor/iziToast/dist/js/iziToast.min.js"></script>

    <!-- Page Specific JS File -->
    <script>
        // Flashdata
        const flashData = $('.flashdata').data('msg');

        if (flashData) {
            iziToast.success({
                title: 'Sukses',
                message: flashData,
                position: 'topRight',
            });
        }

        // Modal Confirm
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            const username = $(this).data('username');
            $('.text-in-modal').html(`Jika user <b>${username}</b> dihapus, maka :`);
            $('.form-delete').attr('action', href);
            $('.modal-confirm').modal('show');
        })

        // Close Modal Confirm
        function closeModalConfirm() {
            $('.text-in-modal').html('');
            $('.form-delete').attr('action', '');
            $('.modal-confirm').modal('hide');
        }
    </script>
</body>

</html>