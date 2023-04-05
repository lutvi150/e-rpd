<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .no-border-table tr td {
            border: 0px solid rgb(255, 255, 255) !important;
            height: 20px !important;
        }

        table tr td {
            height: 40px;
        }

        .head td {
            text-align: center;
            height: 50px;
        }
    </style>
    <table class="no-border-table" style="width: 100%;text-align: center;font-weight: bold;">
        <tr>
            <td>Tabel 3.1</td>
        </tr>
        <tr>
            <td>Kalender Kegiatan Harian</td>
        </tr>
        <tr>
            <td><?=$lembaga->nama_lembaga?></td>
        </tr>
        <!-- <tr>
            <td>Bulan Januari Tahun Anggaran <?=date('Y')?></td>
        </tr> -->
    </table>
    <br>
    <?php foreach ($kalender['mingguan'] as $key => $value): ?>
    <div style="text-align: center;font-weight: bold;">
        Bulan <?=$value->long_month?> Tahun Anggaran <?=date('Y')?></div>
    <table style="width: 100%;">
        <tr class="head">
            <td></td>
            <td>Senin</td>
            <td>Selasa</td>
            <td>Rabu</td>
            <td>Kamis</td>
            <td>Jum'at</td>
            <td>Sabtu</td>
            <td>Minggu</td>
        </tr>
        <tr class="head">
            <td>Tanggal</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <table class="no-border-table" style="width:100%;">
                    <?php foreach ($value->kegiatan as $key2 => $k): ?>
                    <tr>
                        <td style="width:10px;"><?=$key2 + 1?>.</td>
                        <td style="font-weight:bold;width:20px;"><?=$k->uraian_kegiatan?></td>
                    </tr>
                    <?php foreach ($k->rincian_kegiatan as $key3 => $r): ?>
                        <tr>
                        <td style="width:10px;"></td>
                        <td style="width:20px;"><?=$r->uraian_rincian_kegiatan?></td>
                    </tr>
                    <?php endforeach;?>
                    <?php endforeach;?>
                </table>
            </td>
            <?php for ($i = 1; $i <= 7; $i++): ?>
            <td style="text-align:center;">&#10004;</td>
            <?php endfor;?>
        </tr>
    </table>
    <br>
    <?php endforeach;?>
</body>

</html>