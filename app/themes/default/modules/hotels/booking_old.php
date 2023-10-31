
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area bread-bg-booking pt-3 pb-3" style="z-index:0">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="sec__title text-white text-center"><?=T::hotels_hotelbooking?></h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<div class="booking_loading" style="display:none">
<div class="rotatingDiv"></div>
</div>

<div class="booking_data">
<!-- ================================
    START BOOKING AREA
================================= -->
<?php 
if (isset($_SESSION['flash'])) {?>
<div class="alert alert-danger text-center" id="flashMsg">
    <?php 
    echo $_SESSION['flash'];
    unset($_SESSION['flash']);
    ?>
</div>
<?php }?>
<script type="text/javascript">
    $("#flashMsg").fadeIn().delay(8000).fadeOut();
</script>
<form action="<?=root?>hotels/book" method="POST" class="book" id="registerSubmit">
<section class="booking-area padding-top-50px padding-bottom-70px">
    <div class="container">
        <div class="row">
          <?php  //dd($booking_data);die;?>
            <div class="col-lg-4" style="z-index:0">
                <div class="form-box booking-detail-form sticky-top font-size-14">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::bookingdetails?></h3>
                    </div><!-- end form-title-wrap -->
                    <div class="form-content">
                        <div class="card-item shadow-none radius-none mb-0">
                            <div class="card-img pb-2">
                             <img class="lazyload" data-expand="-20" data-src="<?php if (empty($booking_data->hotel_img)){ echo api_url."uploads/images/hotels/slider/thumbs/blank.jpg"; }else { echo $booking_data->hotel_img;} ?>" alt="img">
                            </div>
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                     <?php for ($i = 1; $i <= $booking_data->hotel_stars; $i++) { ?>
                                     <span class="stars la la-star"></span>
                                     <?php } ?>
                                        <h3 class="card-title"><?=$booking_data->hotel_name?></h3>
                                        <p class="card-meta"><?=$booking_data->hotel_address?></p>
                                    </div>
                                    <!--<div>
                                        <a href="#" class="btn ml-1"><i class="la la-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                    </div>-->
                                </div>
                                <!--<div class="card-rating">
                                    <span class="badge text-white">4.4/5</span>
                                    <span class="review__text">Average</span>
                                    <span class="rating__text">(30 Reviews)</span>
                                </div>-->
                                <div class="section-block"></div>
                                <ul class="list-items list-items-2 py-2">
                                    <li><span><?=T::hotels_checkin?>:</span><?=$booking_data->checkin?></li>
                                    <li><span><?=T::hotels_checkout?>:</span><?=$booking_data->checkout?></li>
                                </ul>
                                <div class="section-block"></div>
                                <h3 class="card-title pt-3 pb-2 font-size-15"><a href="#"><strong><?=T::hotels_room_type?></strong></a></h3>
                                <div class="section-block"></div>

                                <?php

                                // dd($booking_data);
                                // die;

                                // calculated for tax
                                if ($booking_data->tax_type == "percentage" ) {
                                $tax = $booking_data->tax;
                                $total = $booking_data->room_price * $rooms_quatity;
                                $totaltax = ($tax / 100) * $total; }

                                if ($booking_data->tax_type == "fixed" ) {
                                $tax = $booking_data->tax;
                                $total = $booking_data->room_price * $rooms_quatity;
                                $totaltax = $tax;
                                }

                                if (empty($booking_data->tax_type) ) { $totaltax = 0; }

                                $nights = round($nights / (60 * 60 * 24));

                                // IF MANUAL HOTELS MODULE DOUBLE PRICE
                                if ($booking_data->supplier_name == "manual") {
                                    $grand_total = $booking_data->room_price * $rooms_quatity + $totaltax;

                                 } else {
                                    $grand_total = $booking_data->room_price * $rooms_quatity + $totaltax;
                                 }

                                if ($booking_data->deposit_type == "percentage" ) {
                                $deposit = ($booking_data->deposit_amount / 100) * $grand_total;
                                }

                                if ($booking_data->deposit_type == "fixed" ) {
                                $deposit = $booking_data->deposit_amount + $grand_total;
                                }

                                if (empty($booking_data->deposit_type) ) {
                                $deposit = $grand_total;
                                }

                                // IF MANUAL HOTELS MODULE DOUBLE SUBTOTAL
                                if ($booking_data->supplier_name == "manual") {
                                    $subtotal = $booking_data->room_price * $rooms_quatity;
                                 } else {
                                    $subtotal = $booking_data->room_price * $rooms_quatity;
                                 }

                                // echo $booking_data->deposit_amount;
                                // echo $booking_data->deposit_amount;
                                ?>

                                <p><?=$booking_data->room_type?></p>
                                <ul class="list-items list-items-2 py-3">
                                    <li><span><?=T::hotels_room_quality?>:</span><?=$rooms_quatity?> <?=T::hotels_rooms?></li>
                                    <li><span><?=T::hotels_room?> <?=T::price?>:</span><?=$booking_data->currency?> <?=number_format( $booking_data->room_price,2);?></li>
                                    <li><span><?=T::adults?>:</span><?=$booking_data->adults?></li>
                                    <li><span><?=T::child?>:</span><?=$booking_data->childs?></li>
                                    <li><span><?=T::hotels_stay?>:</span><?=$nights;?> <?=T::hotels_nights?> </li>
                                </ul>

                                <div class="section-block"></div>
                                <ul class="list-items list-items-2 pt-3">
                                    <li><span><?=T::subtotal?>:</span><?=$currency?> <?= number_format( $subtotal,2) ?> </li>
                                    <li><span><?=T::taxesandfees?>:</span><?=$currency?> <?=number_format( $totaltax,2) ?></li>
                                    <hr>
                                    <li style="font-size:16px"><span><?=T::totalprice?>:</span><strong><?=$currency?> <?=number_format( $grand_total,2);?> </strong></li>
                                    <!--<hr>-->
                                    <!--<li><span><?=T::depositnow?>:</span><strong><?=$currency?> <?=number_format( $deposit,2)?></strong></li>-->
                                    <!--<li><span><?=T::remaining?>:</span><strong><?=$currency?> 56 </strong></li>-->
                                </ul>
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
            </div><!-- end col-lg-4 -->
            
            
            
              <div class="col-lg-8">
                <div class="form-box mb-2">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::yourpersonalinformation?></h3>
                    </div><!-- form-title-wrap -->
                    <?php include views."modules/accounts/booking_user.php";?>
                </div><!-- end form-box -->

                <div class="form-box payment-received-wrap mb-2">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::travellersinformation?></h3>
                    </div>
                    <div class="card-body">

                    <?php
                    if (isset($_SESSION['hotels_adults'])) {
                    $hotels_adults = $_SESSION['hotels_adults'];
                    } else $hotels_adults =$booking_data->adults; for ( $i = 1; $i <= $hotels_adults; $i++ ) { ?>

                    <?php
                    // generate random words
                    $range1 = range('A', 'Z');  $index1 = array_rand($range1);
                    $range2 = range('A', 'Z');  $index2 = array_rand($range2); ?>

                     <div class=" mb-3">
                        <div class="">
                        <strong><?=T::adult .' </strong> '. T::traveller?> <?=$i?>
                        </div>
                        <div class="card-body">
                          <div class="row">
                        <div class="col-md-2">
                        <label class="label-text"><?=T::title?></label>
                         <select name="title_<?=$i?>" class="form-select adult_title">
                             <option value="Mr"><?=T::mr?></option>
                             <option value="Miss"><?=T::miss?></option>
                             <option value="Mrs"><?=T::mrs?></option>
                         </select>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="firstname_<?=$i?>" class="form-control adult_firstname" required placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="lastname_<?=$i?>" class="form-control adult_lastname" required placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>

                        </div>
                        </div>
                     </div>
                     <hr>
                     <?php } ?>

                     <?php
                    if (isset($_SESSION['hotels_childs'])) {
                    $hotels_childs = $_SESSION['hotels_childs'];
                    } else $hotels_childs =$booking_data->childs; for ( $i = 1; $i <= $hotels_childs; $i++ ) { ?>

                    <?php
                    // generate random words
                    $range1 = range('A', 'Z');  $index1 = array_rand($range1);
                    $range2 = range('A', 'Z');  $index2 = array_rand($range2); ?>

                     <div class=" mb-3">
                        <div class="">
                        <strong><?=T::child .' </strong> '. T::traveller?> <?=$i?>
                        </div>
                        <div class="card-body">
                          <div class="row">

                        <div class="col-md-2">
                        <label class="label-text"><?=T::age?></label>
                        <select readonly class="form-select child_age" required name="child_age_<?=$i?>">
                        <?php for ($x = 1; $x <= 16; $x++) { ?>
                        <option value="<?=$x?>"> <?=$x?> </option>
                        <?php } ?>
                        </select>
                        </div>

                        <div class="col-md-5">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="child_firstname_<?=$i?>" class="form-control child_firstname" required placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="child_lastname_<?=$i?>" class="form-control child_lastname" required placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>

                        </div>
                        </div>
                     </div>
                     <hr>
                     <?php } ?>

                    </div>
                 </div>
                <?php

                    $booking = json_decode(json_encode($booking_data), true);
                    $booking['nights'] = $nights;
                    $booking['currency'] = $currency;
                    $booking['room_price'] = $booking_data->room_price;//number_format( $booking_data->room_price,2);
                    $booking['room_quantity'] = $rooms_quatity;
                    $booking['adult_travellers'] = (isset($_SESSION['hotels_adults'])) ? $_SESSION['hotels_adults'] : 1 ;
                    $booking['child_travellers'] = (isset($_SESSION['hotels_childs'])) ? $_SESSION['hotels_childs'] : 0 ;
                    $booking['booking_type'] = 'hotels';
                    //$booking['child_travellers'] = $_SESSION['hotels_childs'];
                    $booking['total_price'] = $grand_total; //number_format( $grand_total,2);
                    $booking['deposit_amount'] = $deposit; //number_format( $deposit,2);
                    $booking['total_tax'] = $totaltax; //number_format( $totaltax,2);
                ?>
                <?php include views."partcials/payment_methods.php"; ?>
                <!-- data pass for tabby api -->
                   <input type="hidden" class="child_travellers" value="<?= $booking['child_travellers'];?>">
                   <input type="hidden" class="adult_travellers" value="<?= $booking['adult_travellers'];?>">
                    <!-- data pass tabby api end -->
                <div class="col-lg-12">
                    <div class="input-box">
                        <div class="form-group">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="agreechb" onchange="document.getElementById('booking').disabled = !this.checked;" <?php if (dev == 1){echo "checked";}?>>
                                <label for="agreechb"><?=T::bycontinuingyouagreetothe?> <a target="_blank" href="<?=root?>terms-of-use"> &nbsp; <?=T::termsandconditions?></a></label>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
                <div class="col-lg-12">
                    <div class="btn-box">
                     <button class="theme-btn book attr_for_tabby" type="submit" id="booking" <?php if (dev == 1){} else{echo "disabled";}?>><?=T::confirmbooking?></button>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end col-lg-8 -->
        

            
            
            
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end booking-area -->



<input type="hidden" class="payload_cls" name="payload" value="<?= base64_encode(json_encode($booking)) ?>" />

</form>

            <!-- javascript for tabby integration -->
            <script type="text/javascript">

                 function submit_tabby_req() {
                    
                    // get from input
                    var validate = true;
                    // alert('sdsds')
                    var firstname = $('.firstname_cls').val();
                    var lastname = $('.lastname_cls').val();
                    var email = $('.email_cls').val();
                    var phone = $('.phone_cls').val();
                    var address = $('.address_cls').val(); 
                     
                    var nationality = $('.nationality').val(); 

                    var child_travellers = $('.child_travellers').val();
                    var adult_travellers = $('.adult_travellers').val();

                    var adult_title = $('.adult_title').val();
                    var adult_firstname = $('.adult_firstname').val();
                    var adult_lastname = $('.adult_lastname').val();
                      
                    var child_age = $('.child_age').val();
                    var child_firstname = $('.child_firstname').val();
                    var child_lastname = $('.child_lastname').val();
                
                    if(firstname==''){
                        $('.firstname_cls').focus();
                        validate = false;
                        e.preventDefault();
                        return;  
                    }
                    if(lastname==''){
                        $('.lastname_cls').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(email==''){
                        $('.email_cls').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                    if(phone==''){
                        $('.phone_cls').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(address==''){
                        $('.address_cls').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                    if(nationality==''){
                        $('.nationality').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                    if(adult_firstname==''){
                        $('.adult_firstname').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }

                    if(adult_lastname==''){
                        $('.adult_lastname').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                    if(child_firstname==''){
                        $('.child_firstname').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                     if(child_lastname==''){
                        $('.child_lastname').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                // ajax call
                if(validate==true){
                    $(".booking_loading").css("display", "block");
                    $(".booking_data").css("display", "none");
                    $.ajax({
                        url: '<?=root?>payment/tabby_api',
                        type: 'POST',
                        data: $("#registerSubmit").serialize(),
                        
                        success: function(data) {
                            $(".booking_loading").css("display", "none");
                            $(".booking_data").css("display", "block");
                            var parsData = JSON.parse(data);
                            // alert(parsData.web_url);
                            var is_email_virified = parsData.is_email_verified;
                            if(is_email_virified){

                              var web_url = `<a href="`+parsData.web_url+`" class="nav-link  border p-2" style="background:#fff;">
                                        <i class="la la-check icon-element"></i>
                                        <img src="<?=root.theme_url?>assets/img/tabby-logo.png" alt="<?=$item->title ?>" style="width:100px; height: 41px;">
                                        <span class="d-block pt-2 font-size-13"><?= T::interesttext?> `+parsData.total_payment+`. `+parsData.currency+`.</span></a>`

                            } else{

                               var web_url = 'Installments is not available';
                            }

                            var amazone = `<a href="#" class="nav-link border p-2" style="background:#fff;"  >
                                        <i class="la la-check icon-element"></i>
                                        <img src="<?=root.theme_url?>assets/img/payment-img.png" alt="<?=$item->title ?>" class="img-fluid w-75">
                                        <span class="d-block pt-2 font-size-13"><?= T::installmenttext?> `+parsData.total_payment+`. `+parsData.currency+`. <?=T::nofees?>.</span></a>`;
                            
                            $("#tabbyModal").modal('show');
                            $(".tabby_btn").html(web_url);
                            $(".amazone_btn").html(amazone);
                        }
                    }); 
                    
                } 
                }
                 
                 function hide_modal(){
                    $("#tabbyModal").modal('hide');
                 }

               
             </script>
             <!-- modal for tabby-->
            <div class="modal fade " id="tabbyModal" tabindex="-1" aria-labelledby="tabby" aria-hidden="true"> 
              <div class="modal-dialog ">
                <div class="modal-content " >
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=T::tabbyhead?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body pb-2">
                        <div class="check-mark-tab text-center pb-4 row">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item tabby_btn pt-4 col-lg-6 m-0 p-1">
                                <li class="nav-item amazone_btn pt-4 col-lg-6 m-0 p-1">
                            </ul>
                       </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
             <!-- modal end -->  
<!-- ================================
    END BOOKING AREA
================================= -->
</div>

<script>
$(".book").submit(function() {
$("body").scrollTop(0);
$(".booking_loading").css("display", "block");
$(".booking_data").css("display", "none");
});

// child ages

<?php

// loop for child ages
if(isset($_SESSION['ages'])) {
$ages_ = json_decode($_SESSION['ages']);
foreach ($ages_ as $i => $ages) { ?>

// disable selection of values
$('.child_age_<?=$i+1?>').css('pointer-events','none');
$('.child_age_<?=$i+1?>').css('background','#e9eef2');

// js change select option to this valu
$('.child_age_<?=$i+1?> option[value=<?=$ages->ages?>]')

.attr('selected', 'selected');
<?php } } ?>

</script>

<style>
.form-check{cursor:pointer}
.header-top-bar,.main-menu-content,.info-area,.footer-area,.cta-area{display:none}
.menu-wrapper{display: flex; justify-content: center; padding: 12px;}
.contact-form-action .form-group .form-icon{z-index: 0!important;}
</style>