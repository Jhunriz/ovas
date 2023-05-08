<style>
    #uni_modal .modal-footer {
        display: none;
    }
</style>


<?php

include('libs/phpqrcode/qrlib.php');
include('config_new.php');

$code = $_GET['code'];
$name = $_GET['owner_name'];
$qrtext = $code . ' ' . $name . '.jpg';

mysqli_query($conn, "UPDATE `appointment_list` SET qr = '$qrtext' WHERE code = '$code'")
?>


<div class="container-fluid">
    <div class="alert alert-success">
        <p>Your Appointment Request has been submitted. The management will reach you as soon as they sees your request. Your appointment code is <b><?= ucwords($_GET['code']) ?></b>. Thank You!</p>
        <?php
        $select = mysqli_query($conn, "SELECT * FROM `appointment_list` WHERE code = '$code'") or die('query failed');
        if (mysqli_num_rows($select) > 0) {
            $fetch = mysqli_fetch_assoc($select);
        }
        if ($fetch['qr'] == '') {
            echo '<img src="qrcodeimg/test.jpg">';
            // echo 'no data';
        } else {
            echo '<img src="qrcodeimg/' . $fetch['qr'] . '.jpg" style="width:300px; height:300px; border-radius: 1px;"><br>';
            // echo '<img src="qrcodeimg/test.jpg" style="width:300px; height:300px; border-radius: 1px;"><br>';
            // echo 'merong data';
            // echo '<img src="admin/uploaded_img/'.$fetch['image'].'" height=500 width=500>';
        }
        ?>
        <?php
        $tempDir = 'qrcodeimg/';
        $codeContents = $code . ' ' . $name;
        $filename = ($codeContents) . '.jpg';
        $qrtext = $code . ' ' . $name;
        QRcode::png($codeContents, $tempDir . '' . $filename . '.jpg', QR_ECLEVEL_L, 5);

        ?>

    </div>

    <div class="form-group text-right">
        <a class="btn" href="download.php?file=<?php echo $filename; ?>.jpg">Download QR code</a>
        <!-- <button class="btn btn-sm btn-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Download</button> -->
    </div>
    <div class="form-group text-right">
        <button class="btn btn-sm btn-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
    </div>
</div>
<script>
    $(function() {
        $('#uni_modal').on('hide.bs.modal', function() {
            location.reload()
        })
    })
</script>