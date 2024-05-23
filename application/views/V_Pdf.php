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
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                </tr>
                <?php
                foreach($siswa as $siswa){
                ?>
                <tr>
                    <td><?= $siswa->nis ?></td>
                    <td><?= $siswa->nama_siswa ?></td>
                    <td><?= $siswa->jenis_kelamin ?></td>
                    <td><?= $siswa->kelas ?></td>
                </tr>
                <?php
                }
                ?>
            </table>

</body></html>