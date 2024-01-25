<?php include(INCLUDESPATH . '/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>All Coordinates</h4>
                <a class="btn btn-primary btm-sm float-right" data-toggle="modal" data-target="#addCoordinate" style="color: white;">Add Coordinates</a>
            </div>
            <div class="card-body">
                <span id="error_msg" style="color:red"></span>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($coordinates)) {
                            foreach ($coordinates as $c) {
                        ?>
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['latitude'] ?></td>
                                    <td><?= $c['longitude'] ?></td>
                                    <?php if ($c['status'] == 1) { ?>
                                        <td>Active</td>
                                    <?php } else { ?>
                                        <td>InActive</td>
                                    <?php } ?>
                                    <td><?= $c['created'] ?></td>
                                    <td>&nbsp;&nbsp;<a class="fa-solid fa-pen-to-square text-blue" data-toggle="tooltip" title="Edit Location details !" href="#" onclick="editModal(<?= $c['id'] ?>)"></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div><!-- card -->
        <div class="modal fade" id="addCoordinate" tabindex="-1" role="dialog" aria-labelledby="addCoordinate" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCoordinateTitle">Add New Coordinate</h5>
                        <h5 class="modal-title" id="updateCoordinateTitle" style="display: none;">Update Coordinate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: 220px; overflow-y: inherit;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input id="latitude" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter Latitude">
                                    <span id="latitude_error" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input id="longitude" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter Longitude">
                                    <span id="longitude_error" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" class="form-control">
                                        <option selected value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <input id="id" hidden value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="addButton" type="button" class="btn btn-primary" onclick="addCoordinate()">Save changes</button>
                        <button id="updateButton" type="button" class="btn btn-primary" onclick="updateCoordinate()" style="display: none;">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(INCLUDESPATH . '/footer.php'); ?>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function addCoordinate() {
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var status = $('#status').val();
        if (latitude == '') {
            $('#latitude_error').text('Enter Latitude');
            $('#longitude_error').text('');
        } else if (longitude == '') {
            $('#longitude_error').text('Enter Latitude');
            $('#latitude_error').text('');
        } else {
            var url = "<?php echo USER_PATH ?>/add_new_coordinate";
            $.ajax({
                url: url,
                dataType: 'Json',
                type: 'POST',
                data: JSON.stringify({
                    latitude: latitude,
                    longitude: longitude,
                    status: status
                }),
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'Success!!',
                            text: data.message,
                            icon: 'success',
                        }).then((result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Warning!!',
                            text: data.message,
                            icon: 'warning',
                        }).then((result) => {

                        });
                    }
                },
                error: function(error) {

                }
            });
        }
    }

    function editModal(id) {
        $('#addCoordinate').modal('show');
        $('#updateCoordinateTitle').css('display', 'block');
        $('#addCoordinateTitle').css('display', 'none');
        $('#updateButton').css('display', 'block');
        $('#addButton').css('display', 'none');
        $('#latitude').val('');
        $('#longitude').val('');
        $('#id').val('');
        var url = "<?php echo USER_PATH ?>/fetch_coordinate_details";
        $.ajax({
            url: url,
            dataType: 'Json',
            type: 'POST',
            data: JSON.stringify({
                id: id
            }),
            success: function(data) {
                $('#latitude').val(data.latitude);
                $('#longitude').val(data.longitude);
                $('#status').val(data.status);
                $('#id').val(data.id);
            },
            error: function(error) {

            }
        })
    }

    function updateCoordinate() {
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var status = $('#status').val();
        var id = $('#id').val();
        if (latitude == '') {
            $('#latitude_error').text('Enter Latitude');
            $('#longitude_error').text('');
        } else if (longitude == '') {
            $('#longitude_error').text('Enter Latitude');
            $('#latitude_error').text('');
        } else {
            var url = "<?php echo USER_PATH ?>/update_coordinate";
            $.ajax({
                url: url,
                dataType: 'Json',
                type: 'POST',
                data: JSON.stringify({
                    latitude: latitude,
                    longitude: longitude,
                    status: status,
                    id: id
                }),
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: 'Success!!',
                            text: data.message,
                            icon: 'success',
                        }).then((result) => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Warning!!',
                            text: data.message,
                            icon: 'warning',
                        }).then((result) => {

                        });
                    }
                },
                error: function(error) {

                }
            });
        }
    }
</script>