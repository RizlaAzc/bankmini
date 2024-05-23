<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa.pdf - Bank Mini</title>
    <style>
        .title{
            text-align: center;
            /* font-size: 30px; */
        }
        
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        th{
            padding: 5px;
        }

        td{
            padding: 5px;
        }
    </style>
</head><body>

    <h3 class="title">Data Siswa</h3>
            <table style="margin : auto; margin-top: 20px;">
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
                foreach($transaksi as $transaksi){
                ?>
                <tr>
                    <td><?= $transaksi->tanggal ?></td>
                    <td><?= $transaksi->id_transaksi ?></td>
                    <td><?= $transaksi->nama_siswa ?></td>
                    <td><?= $transaksi->jenis_tabungan ?></td>
                    <td><?= $transaksi->debit ?></td>
                    <td><?= $transaksi->kredit ?></td>
                    <td><?= $transaksi->saldo ?></td>
                </tr>
                <?php
                }
                ?>
            </table>

</body></html>