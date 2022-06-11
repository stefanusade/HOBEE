<?php include "verify.php"; 
    $begin  = $_GET['begin'];
    $end    = $_GET['end'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>LAPORAN KEUANGAN (<?= date('d/m/Y',strtotime($begin)).' - '.date('d/m/Y',strtotime($end)); ?>)</title>
        <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                font-family: serif;
            }
            h3{
                font-weight: 600;
            }
            .paper{
                width:21.5cm;
            }
        </style>
    </head>
    <body class="bg-light">
        <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
        <div class="bg-white paper">
            <center><h3>LAPORAN KEUANGAN MADU SAMSI</h3>
            <p>Periode <?= date('d/m/Y',strtotime($begin)).' - '.date('d/m/Y',strtotime($end)); ?></p></center>
            <div class="mt-3" id="tampil">

            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            var begin = "<?= $begin; ?>";
            var end = "<?= $end; ?>";
            $.ajax({
                type: 'GET',
                    url: '../ajax/laporan.php',
                    data: {
                        begin	: begin,
                        end		: end,
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                        window.print();
                    }
            });
            
        });
    </script>
</html>