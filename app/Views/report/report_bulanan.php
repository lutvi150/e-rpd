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
            /* font-size: 12px; */
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
        .head-table td{
            text-align: center;
        }
    </style>
    <table class="no-border-table" style="width: 100%;text-align: center;font-weight: bold;">
        <tr>
            <td>Tabel 2.2</td>
        </tr>
        <tr>
            <td>Rencana Penarikan Dana Bulanan</td>
        </tr>
        <tr>
            <td><?=$lembaga->nama_lembaga?></td>
        </tr>
        <tr>
            <td>Tahun Anggaran <?=date('Y')?></td>
        </tr>
    </table>
    <table style="width: 100%;" >
        <tr>
            <td colspan="3">Kementrian Negara/ Lembaga</td>
            <td colspan="14">: Kementrian Agama</td>
        </tr>
        <tr>
            <td colspan="3">Satuan Kerja</td>
            <td colspan="14">: UIN MY Batusangkar</td>
        </tr>
        <tr>
            <td colspan="3">Fak/PPs/Lembaga/Unit</td>
            <td colspan="14">: <?=$lembaga->nama_lembaga?></td>
        </tr>
        <tr class="head-table" style="background-color: rgb(115, 120, 116);text-align: center;">
            <td>Kode</td>
            <td>Uraian</td>
            <td>Pagu (Rp)</td>
            <?php foreach ($data_bulanan['month'] as $key => $value): ?>
            <td style="width:80px"><?=$value['month']?></td>
            <?php endforeach;?>
            <td>Jumlah</td>
        </tr>
        <?php foreach ($data_bulanan['kegiatan'] as $key => $kegiatan): ?>
        <tr>
            <td style="font-weight: bold;" ><?=$kegiatan->kode_kegiatan?></td>
            <td style="font-weight: bold;" ><?=$kegiatan->uraian_kegiatan?></td>
            <td>Rp.<?=number_format($kegiatan->pagu_kegiatan)?></td>
            <?php for ($i = 0; $i < 12; $i++): ?>
            <td></td>
            <?php endfor;?>
            <td colspan="2"></td>
        </tr>
        <?php $total = 0;foreach ($kegiatan->detail_kegiatan as $key => $detail_kegiatan): ?>
        <tr>
            <td style="text-align: right;"><?=$detail_kegiatan->kode_rincian?></td>
            <td><?=$detail_kegiatan->uraian_rincian_kegiatan?></td>
            <td>Rp.<?=number_format($detail_kegiatan->pagu_rincian_kegiatan)?></td>
            <?php for ($i = 0; $i < 12; $i++): ?>
                <?php $pagu = 0;if (isset($detail_kegiatan->rincian_pagu)) {foreach ($detail_kegiatan->rincian_pagu as $key => $rincian_pagu) {
    if ($i == (int) $rincian_pagu->bulan) {
        $pagu = $rincian_pagu->pagu;
        break;
    }
}
    $total += $pagu;
}?>
            <td  style="text-align: right;"><?=number_format($pagu)?></td>
            <?php endfor;?>
            <td colspan="2"><?=number_format($total)?></td>
        </tr>
        <?php $total = 0;endforeach;?>
        <?php endforeach;?>
        <!-- use for data  -->

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center;" data-bulan="<?=$i?>">
                <span class=""></span>
            </td>

        </tr>
        <!-- end data  -->
    </table>
</body>

</html>