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
        <p class="text-lg mx-auto"><b><?= ($name) ?></b></p>
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="schedule" value="<?php echo isset($schedule) ? $schedule : '' ?>">
        <dd class="text-md"><b><?= date("F d, Y") ?></b></dd> <!-- Real-time date -->

        <?php
        $select = mysqli_query($conn, "SELECT * FROM `appointment_list` WHERE code = '$code'") or die('query failed');
        if (mysqli_num_rows($select) > 0) {
            $fetch = mysqli_fetch_assoc($select);
        }
        if ($fetch['qr'] == '') {
            echo '<img src="qrcodeimg/test.jpg">';
            // echo 'no data';
        } else {
            echo '<div style="text-align: center;">
         <img src="qrcodeimg/' . $fetch['qr'] . '.jpg" style="width:350px; padding: 20px; height:350px; border-radius:10px; margin-left:auto; margin-right:auto;"><br>
        </div>';

            //    echo '<img src="qrcodeimg/' . $fetch['qr'] . '.jpg" style="width:300px; height:300px; border-radius:10px;><br>'; 
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
        <div style="display: flex; justify-content: center;">
            <a class="btn" href="download.php?file=<?php echo $filename; ?>.jpg">
                <button class="btn-md btn-dark shadow-lg flex align-items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="height: 20px; width: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                    </svg>
                    Download QR code</button>
            </a>
        </div>

        <!-- <a class="btn" href="download.php?file=<?php echo $filename; ?>.jpg"><button style="padding:25px;">Download QR code</button></a> -->
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