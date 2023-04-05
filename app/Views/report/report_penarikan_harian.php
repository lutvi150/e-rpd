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
            <td>Tabel 3.2</td>
        </tr>
        <tr>
            <td>RENCANA PENARIKAN DANA HARIAN</td>
        </tr>
        <tr>
            <td><?=$lembaga->nama_lembaga?></td>
        </tr>
        <!-- <tr>
            <td>Bulan Januari Tahun Anggaran <?=date('Y')?></td>
        </tr> -->
    </table>
    <br>
    <?php foreach ($penarikan['kegiatan'] as $key => $kegiatan): ?>
        <?php foreach ($kegiatan->month as $key2 => $month): ?>
    <table style="width: 100%;">
        <tr>
            <td colspan="3">Kementrian Negara/ Lembaga</td>
            <td colspan="7">: Kementrian Agama</td>
        </tr>
        <tr>
            <td colspan="3">Satuan Kerja</td>
            <td colspan="7">: IAIN Batusangkar</td>
        </tr>
        <tr>
            <td colspan="3">Fak/PPs/Lembaga/Unit</td>
            <td colspan="7">: <?=$lembaga->nama_lembaga?></td>
        </tr>
        <tr>
            <td colspan="3">Kode</td>
            <td colspan="7" style="font-weight: bold;">: <?=$kegiatan->kode_kegiatan?></td>
        </tr>
        <tr>
            <td colspan="3">Jumlah Dana</td>
            <td colspan="7" style="font-weight: bold;">: Rp.<?=number_format($kegiatan->pagu_kegiatan)?></td>
        </tr>
        <tr>
            <td colspan="3">Nama Kegiatan</td>
            <td colspan="7" style="font-weight: bold;">: <?=$kegiatan->uraian_kegiatan?></td>
        </tr>
        <tr>
            <td colspan="3">Bulan</td>
            <td colspan="7" style="font-weight: bold;">: <?=$month->long_month?></td>
        </tr>
        <tr class="head" style="text-align: center;">
            <td>MA</td>
            <td>Uraian</td>
            <td>Pagu (Rp)</td>
            <td>Senin</td>
            <td>Selasa</td>
            <td>Rabu</td>
            <td>Kamis</td>
            <td>Jum'at</td>
            <td>Jumlah</td>
            <td>%</td>
        </tr>
        <tr>
            <td></td>
            <td>Tanggal</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <?php endforeach;?>
    <?php endforeach;?>
</body>

</html>