<?php include(INCLUDESPATH . '/header.php'); ?>
<div class="d-flex justify-content-center m-4">
    <div class="card p-5" style="width: 50%;">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"></p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latitude 1</label>
                        <input id="latitude1" placeholder="Enter Latitude 1" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Longitude 1</label>
                        <input id="longitude1" placeholder="Enter Longitude 1" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latitude 2</label>
                        <input id="latitude2" placeholder="Enter Latitude 2" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Longitude 2</label>
                        <input id="longitude2" placeholder="Enter Longitude 2" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Unit</label>
                        <select id="unit" class="form-control">
                            <option selected value="1">Km</option>
                            <option value="0">Miles</option>
                        </select>
                    </div>
                </div>
            </div>
            <label id="distance_label" style="display:none;">Distance between 2 coordinates is <span id="distance"></span></label>
            <div class="row justify-content-center mt-3">
                <button class="btn btn-primary btn-sm text-center" onclick="calculateDistance()">Calculate</button>
            </div>
        </div>
    </div>
</div>
<?php include(INCLUDESPATH . '/footer.php'); ?>
<script>
    function calculateDistance() {
        var lat1 = $('#latitude1').val();
        var lon1 = $('#longitude1').val();
        var lat2 = $('#latitude2').val();
        var lon2 = $('#longitude2').val();

        var unit = $('#unit').val();

        var R = 6371;
        var dLat = deg2rad(lat2 - lat1);
        var dLon = deg2rad(lon2 - lon1);
        var a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) *
            Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        if (unit == 1) {
            $('#distance').text(d.toFixed(2) + ' Km');
        } else {
            $('#distance').text(convertKmToMiles(d).toFixed(2) + ' Miles');
        }
        $('#distance_label').css('display', 'block');
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }

    function convertKmToMiles(km) {
        return km * 0.621371;
    }
</script>