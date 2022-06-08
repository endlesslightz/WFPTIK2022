<table id="datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Avatar</th>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($list as $item) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><img src="/images/avatar/<?= $item['avatar'] ?>" alt="" width="100px"></td>
                <td><?= $item['username'] ?></td>
                <td><?= $item['email'] ?></td>
                <td>
                    <a href="user/<?= $item['id'] ?>" class="btn">Detail</a>
                    <a href="#" id="edit" onclick="edit(<?= $item['id'] ?>)" class="btn btn-info">Edit</a>
                    <a href="#" id="edit" onclick="hapus(<?= $item['id'] ?>)" class="btn btn-danger">Hapus</a>

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function edit(id) {
        $.ajax({
            url: "<?= base_url('/user/form') ?>/" + id,
            dataType: "json",
            success: function(response) {
                $('#viewmodal').html(response.data).show();
                $('#editmodal').modal('show');
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Data',
            text: `Apakah Anda yakin akan menghapus data dengan ID=${id}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete",
                    url: "<?= base_url('/user') ?>/" + id,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.sukses,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                        tampilData();
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        $('#datatable').DataTable();

        $('#tambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('/user/form') ?>",
                dataType: "json",
                success: function(response) {
                    $('#viewmodal').html(response.data).show();
                    $('#anggotamodal').modal('show');
                }
            });
        });
    });
</script>