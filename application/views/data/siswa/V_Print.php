<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <table>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
        </tr>
        <?php
        $no = 1;
        foreach($siswa as $siswa){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $siswa->nis ?></td>
            <td><?= $siswa->nama_siswa ?></td>
            <td><?= $siswa->jenis_kelamin ?></td>
            <td><?= $siswa->kelas ?></td>
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