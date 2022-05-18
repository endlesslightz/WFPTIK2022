<a href="#" id="tambah" class="btn btn-rounded btn-success mb-3">Tambah Anggota</a>

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

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
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

    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>