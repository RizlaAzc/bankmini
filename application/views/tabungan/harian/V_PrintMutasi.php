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
        foreach($mutasi_harian as $mutasi_harian){
        ?>
        <tr>
            <td><?= $mutasi_harian->tanggal ?></td>
            <td><?= $mutasi_harian->id_transaksi ?></td>
            <td><?= $mutasi_harian->keterangan ?></td>
            <td>Rp<?= $mutasi_harian->debit ?></td>
            <td>Rp<?= $mutasi_harian->kredit ?></td>
            <td>Rp<?= $mutasi_harian->saldo_harian ?></td>
            <td><?= $mutasi_harian->nama_lengkap ?></td>
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