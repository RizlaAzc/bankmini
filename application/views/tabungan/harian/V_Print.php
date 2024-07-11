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
            <th>Kelas</th>
        </tr>
        <?php
        $no = 1;
        foreach($harian as $harian){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $harian->nis ?></td>
            <td><?= $harian->nama_siswa ?></td>
            <td><?= $harian->kelas ?></td>
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