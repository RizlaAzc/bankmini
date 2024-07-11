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
            <th>Nama Siswa</th>
            <th>Jenis Tabungan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>
        <?php
        $no = 1;
        foreach($transaksi as $transaksi){
        ?>
        <tr>
            <td><?= $transaksi->tanggal ?></td>
            <td><?= $transaksi->id_transaksi ?></td>
            <td><?= $transaksi->nama_siswa ?></td>
            <td><?= $transaksi->jenis_tabungan ?></td>
            <td>Rp<?= $transaksi->debit ?></td>
            <td>Rp<?= $transaksi->kredit ?></td>
            <td>Rp<?= $transaksi->saldo_harian ?></td>
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