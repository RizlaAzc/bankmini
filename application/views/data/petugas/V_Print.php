<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Posisi</th>
            <th>Status</th>
            <th>Waktu Dibuat</th>
        </tr>
        <?php
        $no = 1;
        foreach($petugas as $petugas){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $petugas->nama_lengkap ?></td>
            <td><?= $petugas->email ?></td>
            <td><?= $petugas->level ?></td>
            <td><?= $petugas->status ?></td>
            <td><?= $petugas->waktu_dibuat ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
    
</body>
</html>