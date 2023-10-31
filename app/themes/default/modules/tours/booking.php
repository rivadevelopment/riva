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
                            <h2 class="sec__title text-white text-center"><?=T::tours_tour_booking?></h2>
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
// dd($_SESSION);die;
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
<form action="<?=root?>tours/book" method="POST" class="book" id="registerSubmit">
<section class="booking-area padding-top-50px padding-bottom-70px">
    <div class="container">
        <div class="row">
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
                    <?php 
                        if (empty($_POST['adults'])) {$adults=1;} else {$adults=$_POST['adults'];}
                        if (empty($_POST['childs'])) {$childs=0;} else {$childs=$_POST['childs'];}
                        if (empty($_POST['infants'])) {$infants=0;} else {$infants=$_POST['infants'];}
                    ?>
                    <div class="card-body">
                         <?php
                    if (isset($adults)) {
                       $tours_adults = $adults;
                    } 
                    else {
                       $tours_adults = $_SESSION['tours_adults'];
                    }
                    
                    for ( $i = 1; $i <= $tours_adults; $i++ ) { ?>

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
                         <select name="adult_title_<?=$i?>" class="form-select adult_title">
                             <option value="Mr"><?=T::mr?></option>
                             <option value="Miss"><?=T::miss?></option>
                             <option value="Mrs"><?=T::mrs?></option>
                         </select>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="adult_firstname_<?=$i?>" class="form-control adult_firstname" required placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="adult_lastname_<?=$i?>" class="form-control adult_lastname" required placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>

                        </div>
                        </div>
                     </div>
                     <hr>
                     <?php } ?>

                     <?php
                    if (isset($childs)) {
                        $tours_childs = $childs;
                    } else {
                        $tours_childs =$_SESSION['tours_childs'];
                    } 

                    for ( $i = 1; $i <= $tours_childs; $i++ ) { ?>

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
                     <?php
                    if (isset($infants)) {
                        $tours_infants = $infants;
                    } else{
                        $tours_infants =$_SESSION['tours_infants'];
                    } 

                    for ( $i = 1; $i <= $tours_infants; $i++ ) { ?>

                    <?php
                    // generate random words
                    $range1 = range('A', 'Z');  $index1 = array_rand($range1);
                    $range2 = range('A', 'Z');  $index2 = array_rand($range2); ?>

                     <div class=" mb-3">
                        <div class="">
                        <strong><?=T::infants .' </strong> '. T::traveller?> <?=$i?>
                        </div>
                        <div class="card-body">
                          <div class="row">
                        <div class="col-md-2">
                        <label class="label-text"><?=T::title?></label>
                         <select name="infant_title_<?=$i?>" class="form-select">
                             <option value="Mr"><?=T::mr?></option>
                             <option value="Miss"><?=T::miss?></option>
                             <option value="Mrs"><?=T::mrs?></option>
                         </select>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="infant_firstname_<?=$i?>" class="form-control" required placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-5">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="infant_lastname_<?=$i?>" class="form-control" required placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>

                        </div>
                        </div>
                     </div>
                     <hr>
                     <?php } ?>
                     
                    </div>
                 </div>

                <?php include views."partcials/payment_methods.php"; ?>

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
                     <button class="theme-btn attr_for_tabby book" type="submit" id="booking" <?php if (dev == 1){} else{echo "disabled";}?>><?=T::confirmbooking?></button>
                    </div>
                </div><!-- end col-lg-12 -->

            </div><!-- end col-lg-8 -->
            <div class="col-lg-4" style="z-index:0">
                <div class="form-box booking-detail-form">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::bookingdetails?></h3>
                    </div><!-- end form-title-wrap -->
                    <div class="form-content">
                        <div class="card-item shadow-none radius-none mb-0">
                            <div class="card-img pb-2">
                             <img src="<?=$tour->img[0]?>" alt="img">
                            </div>
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                     <?php for ($i = 1; $i <= $tour->rating; $i++) { ?>
                                     <span class="stars la la-star"></span>
                                     <?php } ?>
                                        <h3 class="card-title font-weight-bold"><?=$tour->name?></h3>
                                        <p class="card-meta"></p>
                                        
                                    </div>  
                                </div>
                                   <hr>
                                
                                <div class="section-block"></div>
                                <ul class="list-items list-items-2 py-2">
                                    <li><span><?=T::date?>:</span><?=$_POST['date']?></li>
                                    <li><span><?=T::tours_tour?>:</span><?=$tour->tourDays?> <?=T::Day?></li>
                                </ul>
                                <div class="section-block"></div>
                                <h3 class="card-title pt-3 pb-2 font-size-15"><a href="#"><strong><?=T::travelerdetails?></strong></a></h3>
                                <div class="section-block"></div>
                                
                                <div class="list-items list-items-2 py-3">
                                    <div class="row ">
                                        <div class="col-5 ">
                                            <p style="padding : 0;  margin-bottom: -10px;"><?=T::adults?>:</p>
                                            <p style="padding : 0; margin : 0; line-height : 20px;" class="font-size-11 text-color"><?=T::age?> 18+</p>
                                        </div>
                                        <div class="col-7 ">
                                           <?=$adults?> <?php if (!empty($adults)){ echo "- ". $currency." ".$tour->b2c_price_adult * $adults; } ?>
                                        </div>
                                    </div>
                                     <div class="row ">
                                        <div class="col-5 ">
                                            <p style="padding : 0;  margin-bottom: -10px;"><?=T::child?>:</p>
                                            <p style="padding : 0; margin : 0; line-height : 20px;" class="font-size-11 text-color"><?=T::age?> 2 to 17</p>
                                        </div>
                                        <div class="col-7">
                                            <?=$childs?> <?php if (!empty($childs)){ echo "- ". $currency." ".$tour->b2c_price_child * $childs; } ?>
                                        </div>
                                    </div>
                                     <div class="row ">
                                        <div class="col-5 ">
                                            <p style="padding : 0;  margin-bottom: -10px;"><?=T::infants?>:</p>
                                            <p style="padding : 0; margin : 0; line-height : 20px;" class="font-size-11 text-color"> Younger than 2 </p>
                                        </div>
                                        <div class="col-7 ">
                                           <?=$infants?> <?php if (!empty($infants)){ echo "- ". $currency." ".$tour->b2c_price_infant * $infants; } ?>
                                        </div>
                                    </div>
                                </div>


                                <?php

                                // cleaning and creating vars
                                $adults_price = $tour->b2c_price_adult * $adults;
                                $childs_price = $tour->b2c_price_child * $childs;
                                $infants_price = $tour->b2c_price_infant * $infants;
                                
                                
                              
                                // merging all pricies to sub total
                                $sub_total = $adults_price + $childs_price + $infants_price;
                                
                                  // calculated for tax
                                if ($tour->taxType == "percentage" ) {
                                    $tax = $tour->taxValue;
                                    $total = $sub_total;
                                    $totaltax = ($tax / 100) * $total; 
                                }

                                if ($tour->taxType == "fixed" ) {
                                    $tax = $tour->taxValue;
                                    $total = $sub_total;
                                    $totaltax = $tax;
                                } ?>
                                
                                 <div class="section-block"></div>
                                 <ul class="list-items list-items-2 pt-3">
                                     <hr>
                                    <li><span><?=T::subtotal?>:</span><?=$currency?> <?=$sub_total ?> </li>
                                    <li><span><?=T::taxesandfees?>:</span><?=$currency?> <?=$totaltax ?></li>
                                    <hr>
                                    <li style="font-size:16px"><span><?=T::totalprice?>:</span><strong><?=$currency?> <?=($sub_total+$totaltax);?> </strong></li>
                                </ul>
                                
                                
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end booking-area -->

<?php $booking = json_decode(json_encode($tour), true);
// dd($tour);die;
$booking['travellers'] = $tours_adults + $tours_childs + $tours_infants;
$booking['adult_travellers'] = $tours_adults;
$booking['child_travellers'] = $tours_childs;
$booking['infant_travellers'] = $tours_infants;
$booking['booking_type'] = 'tours';

$booking['tour_date'] = $_POST['date'];
$booking['sub_total'] = $sub_total;
$booking['total_tax'] = $totaltax;
$booking['total_price'] = ($sub_total+$totaltax); 

?>
 <!-- data pass for tabby api -->

                    <!-- data pass tabby api end -->
<input type="hidden" class="adult_travellers" name="adults" value="<?= $booking['adult_travellers'];?>">
<input type="hidden" class="child_travellers" name="childs" value="<?= $booking['child_travellers'];?>">
<input type="hidden" class="infant_travellers" name="infants" value="<?= $booking['infant_travellers'];?>">

<input type="hidden" name="payload" value="<?= base64_encode(json_encode($booking)) ?>" />

</form>

<?php include views."partcials/tabby-payment-methods.php"; ?>         
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
</script>


<style>
.form-check{cursor:pointer}
.header-top-bar,.main-menu-content,.info-area,.footer-area,.cta-area{display:none}
.menu-wrapper{display: flex; justify-content: center; padding: 12px;}
.card-item .card-title{white-space:unset}
.contact-form-action .form-group .form-icon{z-index: 0!important;}
</style>
