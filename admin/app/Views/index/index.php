<?php include(INCLUDESPATH . '/header.php'); ?>
<div class="d-flex justify-content-center m-4">
    <div class="card p-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            <div class="row">
                <div class="col-md-6">
                    <a href="<?= USER_PATH ?>/fetch_lat_long" class="btn btn-primary" style="margin-left: -15px;">Screen 1</a>
                </div>
                <div class="col-md-6">
                    <a href="<?= USER_PATH ?>/calculate_distance" class="btn btn-primary">Screen 2</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(INCLUDESPATH . '/footer.php'); ?>