<div class="form-content">
        <div class="">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                    <?php if(isset(json_decode($booking->tour_img)[0])){?>
                      <img src="<?=json_decode($booking->tour_img)[0]?>" class="img-fluid">
                    <?php }?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-1 pb-0 px-3">
                            <?php for ($i = 1; $i <= $booking->tour_stars; $i++) { ?>
                             <span class="stars la la-star"></span>
                            <?php } ?>
                            <h5 class="card-title m-0"><?=$booking->tour_name?></h5>
                            <p class="card-text ttc"><small class="text-muted"><?=$booking->tour_loaction?></small></p>
                            <?php if ($booking->booking_status == "confirmed") { ?>
                            <?php if (!empty($booking->lang)) {?>
                            <p class="py-0 card-text"><a target="_target" href="https://www.google.com/maps/?q=<?=$booking->lang.','.$booking->long?>" class="text-color"><strong class="text-black mr-1"><?=T::tourmap?>:</strong><i class="la la-map-marker"></i> <?=T::location?> </a>
                            <?php } ?>
                            <?php if (!empty($booking->tour_phone)) {?>
                            <a href="tel:<?=$booking->tour_phone?>"><strong class="text-black mr-1"><?=T::phonenumber?>:</strong> +<?=$booking->tour_phone?></a></p>
                            <?php } ?>
                            <?php if (!empty($booking->tour_email)) {?>
                            <p class="py-0 card-text"><a target="_target" href="mailto:<?=$booking->tour_email?>" class="text-color"><strong class="text-black mr-1"><?=T::tours_tour?> <?=T::email?>:</strong> <i class="la la-envelope"></i> <?=$booking->tour_email?> </a></p>
                            <?php } ?>
                            <?php if (!empty($booking->hotel_website)) {?>
                           
                            <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="card">
                    <div class="card-title px-3 pt-2 strong">
                        <?=T::bookingdetails?>
                    </div>
                    <ul class="list-group list-group-flush">
                       
                        <li class="list-group-item"><p class="py-0 card-text"><span><strong><?=T::hotels_checkin?></strong>:</span> <?= date('d M, Y',strtotime(strtr($booking->booking_checkin, '/', '-'))); ?> <i class="la la-arrow-right"></i> <span><strong><?=T::hotels_checkout?></strong>:</span> <?= date('d M, Y',strtotime(strtr($booking->booking_checkout, '/', '-'))); ?></p></li>
                        <li class="list-group-item"><span><strong><?=T::adults?></strong>: <?=$booking->booking_adults?> </span> <span><strong><?=T::child?></strong>: <?=$booking->booking_childs?></span> - <span><strong><?=T::infants?></strong>:</span> <?=$booking->booking_infants?></li>
                       
                        <li class="list-group-item"><span><strong><?=T::bookingtax?></strong>:</span> <?=$booking->booking_curr_code?> <?=$booking->booking_tax ?></li>
                        <li class="list-group-item"><span><strong><?=T::depositnow?> <?=T::price?></strong>:</span> <?=$booking->booking_curr_code?> <?=$booking->booking_remaining ?></li>
                        <hr style="margin:0">
                        <li style="background:#f1f4f8" class="list-group-item"><span class=""><strong><?=T::total?> <?=T::price?></strong>:</span> <?=$booking->booking_curr_code?> <?=$booking->total_price ?></li>
                    </ul>
                </div>
            </div>
        </div><!-- end card-item -->
    <!-- end form-content -->
    <div class="card mt-2 mb-3">
        <div class="card-title px-3 pt-2 strong">
            <?=T::guest?> <?=T::information?>
        </div>
        <div class="card-body">
            <?php
            $travellers = ( json_decode($booking->booking_guest_info));
            foreach ($travellers as $index => $guest ) {
                ?>
                <div class="row">
                   <?php if (empty($guest->age)) {?>
                    <div class="col-md-3"><strong><?=T::guest?> <?=$index+1?> - </strong> <?=$guest->title?></div>
                    <?php } else {?>
                    <div class="col-md-3"><strong><?=T::guest?> <?=$index+1?> - </strong> <?=T::hotels_child?></div>
                    <?php } ?>
                    <div class="col-md-3"><strong><?=T::firstname?></strong> <?=$guest->first_name?></div>
                    <div class="col-md-3"><strong><?=T::lastname?></strong> <?=$guest->last_name?></div>
                    <?php if (isset($guest->age) && !empty($guest->age)) {?>
                    <div class="col-md-3"><strong><?=T::age?></strong> <?=$guest->age?></div>
                    <?php } ?>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>

    <div class="btn-box px-1">
    <div class="row g-2">
    <?php if ($booking->booking_cancellation_request == "1") { ?>
     <div class="alert alert-danger"><?=T::cancellationrequestmsg?></div>
    <?php } ?>
    <div class="col-md-4">
        <?php if ($booking->booking_cancellation_request == "0") { ?>
            <form onSubmit="if(!confirm('<?=T::areyousureforcancellationofthisbooking?>')){return false;}" action="<?=root?>tours/cancellation" method="post">
                <input type="hidden" name="booking_no" value="<?=$booking->booking_ref_no?>" />
                <input type="hidden" name="booking_id" value="<?=$booking->booking_id?>" />
                <input type="hidden" name="supplier" value="<?=$booking->booking_supplier;?>" />
                <input type="submit" value="<?=T::requestcancellation?>" class="btn btn-outline-danger btn-block">
            </form>
        <?php } ?>
        <script>
            function show_alert() {
                if(!confirm("<?=T::thisrequestwillsubmitcancellation?>")) {
                    return false; } this.form.submit(); }
        </script>
        </div>
        <div class="col-md-3 float-right text-right">
        <button class="btn btn-outline-success btn-block text-right" id="download"><i class="la la-print"></i> <?=T::downloadinvoice?></button>
        </div>
        </div>
    </div>
    </div>