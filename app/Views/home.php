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
                    <h1>Selamat datang di sistem perpustakaan digital </h1>
                    <p>Daftar pustakawan hari ini :</p>
                    <ul>
                        <?php foreach ($list as $item) {
                            echo "<li> $item </li>";
                        } ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</main>
<?= $this->endSection(); ?>