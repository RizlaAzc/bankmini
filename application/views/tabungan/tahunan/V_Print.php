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
        foreach($tahunan as $tahunan){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $tahunan->nis ?></td>
            <td><?= $tahunan->nama_siswa ?></td>
            <td><?= $tahunan->kelas ?></td>
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