<script src="<?php echo ASSETSPATH; ?>js/lib/jquery.min.js"></script><!-- jquery vendor -->
<script src="<?php echo ASSETSPATH; ?>js/lib/jquery.nanoscroller.min.js"></script><!-- nano scroller -->
<script type="text/javascript" src="<?php echo ASSETSPATH; ?>js/1.9.jquery.validate.js"></script>

<script src="<?= ASSETSPATH ?>js/bootstrap.min.js"></script>
<script src="<?= ASSETSPATH ?>js/bootstrap.bundle.min.js"></script>

<script src="<?php echo ASSETSPATH; ?>js/lib/sidebar.js"></script><!-- sidebar -->

<script src="<?php echo ASSETSPATH; ?>js/lib/mmc-common.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="<?php echo ASSETSPATH; ?>js/lib/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo ASSETSPATH; ?>js/scripts.js"></script><!-- scripit init-->
<script type="text/javascript" src="<?php echo ASSETSPATH; ?>js/charts/Chart.js"></script>

<!-- bootstrap 4 datatables -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            lengthChange: true,
            buttons: [
                'copy',
                'excel',
                'pdf'
            ],
            "order": [
                [0, "desc"]
            ]
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
</body>

</html>