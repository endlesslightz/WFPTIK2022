<?php echo $this->extend('template/layout'); ?>

<?php echo $this->section('kontainer'); ?>
<!--Main layout-->
<main style="margin-top: 58px">
    <div class="container pt-4">
        <!-- Section: Main chart -->
        <section class="mb-4">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Hello, <?= $nama ?> !</strong></h5>
                </div>
                <div class="card-body">
                    <h1>Tambah Anggota</h1>
                    <form action="insert" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="nd" name="namadepan" class="form-control" required />
                                    <label class="form-label" for="nd">Nama depan</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="nb" name="namabelakang" class="form-control" required />
                                    <label class="form-label" for="nb">Nama belakang</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea class="form-control" name="alamat" id="al" rows="4"></textarea>
                            <label class="form-label" for="al">Alamat Rumah</label>
                        </div>
                        <div class="row mb-4">

                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="tempatlahir" name="tempatlahir" class="form-control" />
                                    <label class="form-label" for="tempatlahir">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="date" id="tanggallahir" name="tanggallahir" class="form-control" />
                                    <label class="form-label" for="tanggallahir">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>
                        Jenis Kelamin : <div class="form-check form-check-inline mb-4 mx-3">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="flexRadioDefault1" value="laki-laki" checked />
                            <label class="form-check-label" for="flexRadioDefault1"> Laki-laki </label>
                        </div>

                        <div class="form-check form-check-inline mb-4 mx-3">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="flexRadioDefault2" value="perempuan" />
                            <label class="form-check-label" for="flexRadioDefault2"> Perempuan </label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="tel" name="telepon" class="form-control" />
                            <label class="form-label" for="tel">Telepon</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="em" name="email" class="form-control" />
                            <label class="form-label" for="em">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="username" name="username" class="form-control" />
                            <label class="form-label" for="username">Username</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="pass" name="password" class="form-control" />
                            <label class="form-label" for="pass">Password</label>
                        </div>

                        Avatar : <div class="form-outline mb-4">
                            <input type="file" id="ava" name="avatar" class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-primary mb-4">Tambah Data</button>

                    </form>

                </div>

            </div>
        </section>
        <!-- Section: Main chart -->

    </div>
</main>

<?php echo $this->endSection();
?>