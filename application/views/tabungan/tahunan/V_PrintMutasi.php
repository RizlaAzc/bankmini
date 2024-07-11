<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <table>
        <tr>
            <th>Tanggal</th>
            <th>No. Transaksi</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
            <th>Nama Petugas</th>
        </tr>
        <?php
        $no = 1;
        foreach($mutasi_tahunan as $mutasi_tahunan){
        ?>
        <tr>
            <td><?= $mutasi_tahunan->tanggal ?></td>
            <td><?= $mutasi_tahunan->id_transaksi ?></td>
            <td><?= $mutasi_tahunan->keterangan ?></td>
            <td>Rp<?= $mutasi_tahunan->debit ?></td>
            <td>Rp<?= $mutasi_tahunan->kredit ?></td>
            <td>Rp<?= $mutasi_tahunan->saldo_tahunan ?></td>
            <td><?= $mutasi_tahunan->nama_lengkap ?></td>
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