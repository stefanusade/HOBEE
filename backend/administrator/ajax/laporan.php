<?php   
    include "verify.php";

	require_once '../../../config/db.php';

    $begin = date('Y-m-d',strtotime($_GET['begin']));
    $end = date('Y-m-d',strtotime($_GET['end']));
	
	$show = mysqli_query($conn, "
    SELECT t.tanggal AS tgl, t.rincian AS rinci, t.pengeluaran AS outcome, t.pemasukan AS income
    FROM ( 
        SELECT po.tanggal_pengeluaran AS tanggal, po.rincian_pengeluaran AS rincian, po.nominal_pengeluaran AS pengeluaran, 0 AS pemasukan
        , 'po' AS po_or_pi, po.id_pengeluaran AS id FROM pengeluaran po
        UNION ALL
        SELECT pi.tanggal_pemasukan AS date, pi.rincian_pemasukan AS rincian, 0 AS pengeluaran, pi.nominal_pemasukan AS pemasukan
        , 'pi' AS po_or_pi, pi.id_pemasukan AS id FROM pemasukan pi
       ) t
    WHERE (tanggal BETWEEN '$begin' AND '$end')
    ORDER BY t.tanggal;");
	
?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Rincian</th>
                <th>Pengeluaran</th>
                <th>Pemasukan</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($show)) {?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['tgl']; ?></td>
                <td><?= $row['rinci']; ?></td>
                <td><?= $row['outcome']; ?></td>
                <td><?= $row['income']; ?></td>
            </tr>
        <?php $no++; } ?>
        </tbody>
    </table>
