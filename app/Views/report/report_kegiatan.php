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
        <td>Tabel 2.1</td>
    </tr>
        <tr>
            <td>Data Pelaksanaan Kegiatan</td>
        </tr>
        <tr>
            <td><?=$lembaga->nama_lembaga?></td>
        </tr>
        <tr>
            <td>Tahun Anggaran <?=date('Y')?></td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td colspan="2">Kementrian Negara/ Lembaga</td>
            <td colspan="2">: Kementrian Agama</td>
        </tr>
        <tr>
            <td colspan="2">Satuan Kerja</td>
            <td colspan="2">: UIN MY Batusangkar</td>
        </tr>
        <tr>
            <td colspan="2">Fak/PPs/Lembaga/Unit</td>
            <td colspan="2">: <?=$lembaga->nama_lembaga?></td>
        </tr>
        <tr class="head">
            <td>Kode</td>
            <td>Uraian</td>
            <td>Pagu (Rp)</td>
            <td>Jadwal Pelaksanaan</td>
        </tr>
        <!-- use for data  -->
        <?php foreach ($activity as $key => $value): ?>
        <tr>
            <td><?=$value->kode_kegiatan?></td>
            <td><?=$value->uraian_kegiatan?></td>
            <td>Rp.<?=number_format($value->pagu_kegiatan)?></td>
            <td><?=$month[$value->mulai_pelaksanaan - 1]['month'] . " - " . $month[$value->akhir_pelaksanaan - 1]['month']?>
            </td>
        </tr>
        <?php endforeach;?>
        <!-- end data  -->
    </table>
</body>

</html>