
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
        <td>Tabel 2.3</td>
    </tr>
        <tr>
            <td>Rencana Penarikan Dana Bulanan</td>
        </tr>
        <tr>
            <td>Rincian Perminggu</td>
        </tr>
        <tr>
            <td><?=$lembaga->nama_lembaga?></td>
        </tr>
        <tr>
            <td>Tahun Anggaran <?=date('Y')?></td>
        </tr>
    </table>
    <br>
    <?php foreach ($data_mingguan['mingguan'] as $key => $value): ?>
    <table style="width: 100%;">
        <tr>
            <td style="text-align: center;" rowspan="2">KODE</td>
            <td style="text-align: center;" rowspan="2">URAIAN PROGRAM</td>
            <td style="text-align: center;" rowspan="2">HARGA SATUAN</td>
            <td style="text-align: center;" colspan="4">BULAN <?=strtoupper($value->long_month)?></td>
        </tr>
        <tr>
            <td style="text-align: center;">Minggu ke 1</td>
            <td style="text-align: center;">Minggu ke 2</td>
            <td style="text-align: center;">Minggu ke 3</td>
            <td style="text-align: center;">Minggu ke 4</td>
        </tr>
        <?php foreach ($value->kegiatan as $key2 => $k): ?>
        <tr>
            <td><?=$k->kode_kegiatan?></td>
            <td style="font-weight:bold;"><?=$k->uraian_kegiatan?></td>
            <td style="text-align:right;">Rp.<?=number_format($k->pagu_kegiatan)?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php foreach ($k->rincian_kegiatan as $key3 => $r): ?>
        <tr>
        <td style="text-align:right;"><?=$r->kode_rincian?></td>
            <td><?=$r->uraian_rincian_kegiatan?></td>
            <td style="text-align:right;">Rp.<?=number_format($r->pagu_rincian_kegiatan)?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach;?>
        <?php endforeach;?>
    </table>
        <br>
        <?php endforeach;?>
</body>

</html>