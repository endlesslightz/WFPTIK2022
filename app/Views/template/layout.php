<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="<?= base_url('mdb/css/mdb.min.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('mdb/css/admin.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('datatables/datatables.min.css'); ?>" rel="stylesheet">
    <title>Hello, world!</title>
</head>

<body>
    <?= $this->include('template/navigasi'); ?>

    <?= $this->renderSection('kontainer'); ?>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('mdb/js/mdb.min.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?= base_url('mdb/js/admin.js'); ?>" crossorigin="anonymous"></script>
    <script src="<?= base_url('datatables/datatables.min.js'); ?>"></script>
    <script>
        function tampilData() {
            $.ajax({
                url: "<?= base_url('/user/data') ?>",
                dataType: "json",
                success: function(response) {
                    $('#viewdata').html(response.data);
                }
            });
        }

        $(document).ready(function() {
            tampilData();
        });

        var tick = function() {
            let today = new Date();
            let months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            let days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
            let year = today.getFullYear();
            let month = today.getMonth();
            let d = today.getDate();
            let day = today.getDay();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            $('#waktu').html(days[day] + ', ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + (today.getMinutes() < 10 ? '0' : '') + m + ':' + (today.getSeconds() < 10 ? '0' : '') + s);
        }
        tick;
        setInterval(tick, 1000);
    </script>
</body>

</html>