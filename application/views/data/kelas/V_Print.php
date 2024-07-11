<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <table>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Kompetensi Keahlian</th>
        </tr>
        <?php
        $no = 1;
        foreach($kelas as $kelas){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $kelas->kelas ?></td>
            <td><?= $kelas->kompetensi_keahlian ?></td>
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