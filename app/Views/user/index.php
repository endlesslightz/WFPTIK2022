<?= $this->extend('template/layout'); ?>

<?= $this->section('kontainer'); ?>
<main style="margin-top: 58px">
    <div class="container pt-4">
        <!-- Section: Main chart -->
        <section class="mb-4">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Hello, <?= $nama ?> !</strong></h5>
                </div>
                <div class="card-body">
                    <?php if (session()->getflashdata('label') != '') { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getflashdata('label'); ?>
                        </div>
                    <?php } ?>

                    <h1>Daftar anggota</h1>
                    <!-- <a href="user/create" class="btn btn-rounded btn-success mb-3">Tambah data</a> -->
                    <div id="viewdata"></div>
                </div>
            </div>
        </section>
    </div>

    <div id="viewmodal" style="display: none;"></div>
</main>
<?= $this->endSection(); ?>