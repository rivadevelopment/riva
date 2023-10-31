<div class="form-content">

<div class="card mb-3">
    <div class="row g-0 p-3">
     <?php require "partcials/flight.php" ?>
    </div>
</div>
<!-- end form-content -->


         <?php
            $travellers = ( json_decode($booking->booking_guest_info));
            foreach ($travellers as $index => $guest ) {
                ?>


    <div class="card">    
        
        <div class="card-body">
            <div class="card-title  strong font-size-14 text-color-6">
           << <?=T::guest?> - <?=$index+1?> >>
        </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <ul class="customer">
                                                <li><span class="text-black font-weight-bold">Title:</span><span class="text-black font-weight-regular"> <?=$guest->title?></span></li>
                                                <li><span class="text-black font-weight-bold"><?=T::full_name?>:</span><span class="text-black font-weight-regular"> <?=$guest->first_name?> <?=$guest->last_name?></span></li>
                                                <li><span class="text-black font-weight-bold"><?=T::date_of_birth?>:</span><span class="text-black font-weight-regular"> <?=$guest->dob_day?>-<?=$guest->passport_month?>-<?=$guest->dob_year?></span></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="customer">
                                                <li><span class="text-black font-weight-bold"><?=T::nationality?>:</span><span class="text-black font-weight-regular"> <?=$guest->nationality?></span></li>
                                                <li><span class="text-black font-weight-bold"><?=T::passport_no?>:</span><span class="text-black font-weight-regular"> <?=$guest->passport?></span></li>
                                                <li><span class="text-black font-weight-bold"><?=T::passport_expiry?>:</span><span class="text-black font-weight-regular"> <?=$guest->passport_day?>-<?=$guest->passport_month?>-<?=$guest->passport_year?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                    </div>
                  </div>
     <hr>
<?php } ?>
            

   

    <div class="mb-3">
        <div class="card">
            <div class="card-title px-3 pt-2 strong font-size-14">
                <?=T::bookingdetails?>
            </div>
            <ul class="list-group list-group-flush font-size-14">
                <li class="list-group-item">
                    <?=($booking->booking_adults == 0)  ? null : '<span><strong>'.T::adults .'</strong>: </span><span class="text-black font-weight-regular">'.$booking->booking_adults .'</span> -'; ?>  
                    <?=($booking->booking_childs == 0)  ? null : '<span><strong>'.T::child  .'</strong>: </span><span class="text-black font-weight-regular">'.$booking->booking_childs .'</span> -'; ?>  
                    <?=($booking->booking_infants == 0) ? null : '<span><strong>'.T::infants.'</strong>: </span><span class="text-black font-weight-regular">'.$booking->booking_infants.'</span> -'; ?>  
                </li>
                <li class="list-group-item"><span><strong><?=T::bookingprice?></strong>:</span><span class="text-black font-weight-regular"> <?=$booking->booking_curr_code?> <?=($booking->total_price-$booking->booking_tax)?></span></li>
                <li class="list-group-item"><span><strong><?=T::bookingtax?></strong>:</span><span class="text-black font-weight-regular"> <?=$booking->booking_curr_code?> <?=$booking->booking_tax?></span></li>
                <!--<li class="list-group-item"><span><strong><?=T::depositnow?> <?=T::price?></strong>:</span> <?=$booking->booking_curr_code?> <?=$booking->booking_deposit?></li>-->
                <hr style="margin:0">
                <li style="background:#f1f4f8" class="list-group-item"><span class=""><strong><?=T::total?> <?=T::price?></strong>:</span><span class="text-black font-weight-regular"> <?=$booking->booking_curr_code?> <?=$booking->total_price?></span></li>
            </ul>
        </div>
    </div>

    <div class="btn-box px-1">
    <div class="row g-2">
    <?php if ($booking->booking_cancellation_request == "1") { ?>
     <div class="alert alert-danger"><?=T::cancellationrequestmsg?></div>
    <?php } ?>
    <div class="col-md-4">
        <?php if ($booking->booking_cancellation_request == "0") { ?>
            <form onSubmit="if(!confirm('<?=T::areyousureforcancellationofthisbooking?>')){return false;}" action="<?=root?>hotels/cancellation" method="post">
                <input type="hidden" name="booking_no" value="<?=$booking->booking_ref_no?>" />
                <input type="hidden" name="booking_id" value="<?=$booking->booking_id?>" />
                <!--<input type="submit" value="<?=T::requestcancellation?>" class="btn btn-outline-danger btn-block">-->
            </form>
        <?php } ?>
        <script>
         function show_alert() { if(!confirm("<?=T::thisrequestwillsubmitcancellation?>")) { return false; } this.form.submit(); }
        </script>
        </div>
        <div class="col-md-3 float-right text-right">
        <button class="btn btn-outline-success btn-block text-right" id="download"><i class="la la-print"></i> <?=T::downloadinvoice?></button>
        </div>
        </div>
    </div>
    </div>