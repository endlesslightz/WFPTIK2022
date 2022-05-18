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
                    <p>Ini adalah halaman about</p>
                </div>
            </div>
        </section>
    </div>
</main>

<?= $this->endSection(); ?>