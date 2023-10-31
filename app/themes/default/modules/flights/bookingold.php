<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area bread-bg-booking pt-3 pb-3" id="" style="z-index:0;">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="sec__title text-white text-center"><?=T::flights_flights_booking?></h2>
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
<!-- ================================
    START BOOKING AREA
================================= -->
<form action="<?=root?>flights/book" method="POST" class="book" id="registerSubmit">
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
                    <div class="card-body">
                    <!-- adults -->
                    <?php if (isset($_SESSION['flights_adults'])) {
                    $travellers = $_SESSION['flights_adults'];
                    } else $travellers = 1; for ($i = 1; $i <= $travellers; $i++) { ?>
                     <div class="card mb-3">
                        <div class="card-header">
                            <?=T::adult?> <?=T::traveller?> <strong><?=$i?></strong>
                        </div>
                        <div class="card-body">

                        <?php
                        // generate random words
                        $range1 = range('A', 'Z');  $index1 = array_rand($range1);
                        $range2 = range('A', 'Z');  $index2 = array_rand($range2); ?>

                        <!-- personal info -->
                        <div class="row">
                        <div class="col-md-2">
                        <input type="hidden" name="traveller_type_<?=$i?>" value="adults">
                        <label class="label-text"><?=T::title?></label>
                        <select name="title_<?=$i?>" class="form-select">
                        <option value="Mr"><?=T::mr?></option>
                        <option value="Miss"><?=T::miss?></option>
                        <option value="Mrs"><?=T::mrs?></option>
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="firstname_<?=$i?>" class="form-control firstname_" placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="lastname_<?=$i?>" class="form-control lastname_" placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>
                        </div>

                        <!-- nationality and personality -->
                        <div class="row mt-3">
                        <div class="col-md-6">
                        <label class="label-text"><?=T::nationality?></label>
                        <select class="form-select form-select nationality" name="nationality_<?=$i?>">
                        <?php if (dev == 1){?>
                        <option value="pakistan">Pakistan</option>
                        <?php }?>
                        <?=countries_list();?>
                        </select>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::date_of_birth?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select dob_month_" name="dob_month_<?=$i?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="dob_day_<?=$i?>" class="form-control dob_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="dob_year_<?=$i?>" class="form-control dob_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>
                        </div>

                        <!-- passport credentials -->
                        <div class="row mt-3">
                        <div class="col-md-6">
                        <label class="label-text"><?=T::passport_or_id?></label>
                        <input type="number" name="passport_<?=$i?>" class="form-control passport_" placeholder="<?=T::passport_or_id?>" value="<?php if (dev == 1){echo "6655899745626";}?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::expiry_date?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select passport_month_" name="passport_month_<?=$i?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="passport_day_<?=$i?>" class="form-control passport_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="passport_year_<?=$i?>" class="form-control passport_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label class="label-text"><?=T::expiry_date?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select passport_issuance_month_" name="passport_issuance_month_<?=$i?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="passport_issuance_day_<?=$i?>" class="form-control passport_issuance_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="passport_issuance_year_<?=$i?>" class="form-control passport_issuance_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>
                     </div>
                     <?php } ?>

                     <!-- chaild -->
                     <?php if (isset($_SESSION['flights_childs'])) {
                    $travellers = $_SESSION['flights_childs'];
                    } else $travellers = 1; for ($i = 1; $i <= $travellers; $i++) { ?>
                     <div class="card mb-3">
                        <div class="card-header">
                             <!-- childs -->
                             Childs <?=T::traveller?> <strong><?=$i+$_SESSION['flights_adults']?></strong>
                        </div>
                        <div class="card-body">

                        <?php
                        // generate random words
                        $range1 = range('A', 'Z');  $index1 = array_rand($range1);
                        $range2 = range('A', 'Z');  $index2 = array_rand($range2); ?>

                        <!-- personal info -->
                        <div class="row">
                        <div class="col-md-2">
                        <input type="hidden" name="traveller_type_<?=$i+$_SESSION['flights_adults']?>" value="child">
                        <label class="label-text"><?=T::title?></label>
                        <select name="title_<?=$i+$_SESSION['flights_adults']?>" class="form-select">
                        <option value="Mr"><?=T::mr?></option>
                        <option value="Miss"><?=T::miss?></option>
                        <option value="Mrs"><?=T::mrs?></option>
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="firstname_<?=$i+$_SESSION['flights_adults']?>" class="form-control firstname_" placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="lastname_<?=$i+$_SESSION['flights_adults']?>" class="form-control lastname_" placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>
                        </div>

                        <!-- nationality and personality -->
                        <div class="row mt-3">
                        <div class="col-md-6">
                        <label class="label-text"><?=T::nationality?></label>
                        <select class="form-select form-select nationality" name="nationality_<?=$i+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="pakistan">Pakistan</option>
                        <?php }?>
                        <?=countries_list();?>
                        </select>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::date_of_birth?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select dob_month_" name="dob_month_<?=$i+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="dob_day_<?=$i+$_SESSION['flights_adults']?>" class="form-control dob_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="dob_year_<?=$i+$_SESSION['flights_adults']?>" class="form-control dob_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>
                        </div>

                        <!-- passport credentials -->
                        <div class="row mt-3">
                        <div class="col-md-6">
                        <label class="label-text"><?=T::passport_or_id?></label>
                        <input type="number" name="passport_<?=$i+$_SESSION['flights_adults']?>" class="form-control passport_" placeholder="<?=T::passport_or_id?>" value="<?php if (dev == 1){echo "6655899745626";}?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::expiry_date?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select passport_month_" name="passport_month_<?=$i+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="passport_day_<?=$i+$_SESSION['flights_adults']?>" class="form-control passport_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="passport_year_<?=$i+$_SESSION['flights_adults']?>" class="form-control passport_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label class="label-text"><?=T::expiry_date?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select passport_issuance_month_" name="passport_issuance_month_<?=$i+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="passport_issuance_day_<?=$i+$_SESSION['flights_adults']?>" class="form-control passport_issuance_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="passport_issuance_year_<?=$i+$_SESSION['flights_adults']?>" class="form-control passport_issuance_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>
                     </div>
                     <?php } ?>

                     <!-- infants -->
                     <?php if (isset($_SESSION['flights_infants'])) {
                    $travellers = $_SESSION['flights_infants'];
                    } else $travellers = 1; for ($i = 1; $i <= $travellers; $i++) { ?>
                     <div class="card mb-3">
                        <div class="card-header">
                            <?=T::infants?> <?=T::traveller?> <strong><?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?></strong>
                        </div>
                        <div class="card-body">

                        <?php
                        // generate random words
                        $range1 = range('A', 'Z');  $index1 = array_rand($range1);
                        $range2 = range('A', 'Z');  $index2 = array_rand($range2); ?>

                        <!-- personal info -->
                        <div class="row">
                        <div class="col-md-2">
                        <input type="hidden" name="traveller_type_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" value="infant">
                        <label class="label-text"><?=T::title?></label>
                        <select name="title_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-select">
                        <option value="Mr"><?=T::mr?></option>
                        <option value="Miss"><?=T::miss?></option>
                        <option value="Mrs"><?=T::mrs?></option>
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label class="label-text"><?=T::firstname?></label>
                        <input type="text" name="firstname_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control firstname_" placeholder="<?=T::firstname?>" value="<?php if (dev == 1){echo "Elan".$range1[$index1];}?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::lastname?></label>
                        <input type="text" name="lastname_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control lastname_" placeholder="<?=T::lastname?>" value="<?php if (dev == 1){echo "Mask".$range2[$index2];}?>"/>
                        </div>
                        </div>

                        <!-- nationality and personality -->
                        <div class="row mt-3">
                        <div class="col-md-6">
                        <label class="label-text"><?=T::nationality?></label>
                        <select class="form-select form-select nationality" name="nationality_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="pakistan">Pakistan</option>
                        <?php }?>
                        <?=countries_list();?>
                        </select>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::date_of_birth?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select dob_month_" name="dob_month_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="dob_day_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control dob_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="dob_year_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control dob_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>
                        </div>

                        <!-- passport credentials -->
                        <div class="row mt-3">
                        <div class="col-md-6">
                        <label class="label-text"><?=T::passport_or_id?></label>
                        <input type="number" name="passport_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control passport_" placeholder="<?=T::passport_or_id?>" value="<?php if (dev == 1){echo "6655899745626";}?>"/>
                        </div>
                        <div class="col-md-6">
                        <label class="label-text"><?=T::expiry_date?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select passport_month_" name="passport_month_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="passport_day_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control passport_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="passport_year_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control passport_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <label class="label-text"><?=T::expiry_date?></label>
                        <div class="row">
                        <div class="col-5">
                        <select class="form-select form-select passport_issuance_month_" name="passport_issuance_month_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>">
                        <?php if (dev == 1){?>
                        <option value="01">January</option>
                        <?php }?>
                        <option><?=T::month?></option>
                        <?php months_list()?>
                        </select>
                        </div>
                        <div class="col-3">
                        <input type="number" name="passport_issuance_day_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control passport_issuance_day_" placeholder="<?=T::day?>" value="<?php if (dev == 1){echo "1";}?>"/>
                        </div>
                        <div class="col-4">
                        <input type="number" name="passport_issuance_year_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control passport_issuance_year_" placeholder="<?=T::year?>" value="<?php if (dev == 1){echo "2029";}?>"/>
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>
                     </div>
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
                     <button class="theme-btn book attr_for_tabby" type="submit" id="booking" <?php if (dev == 1){} else{echo "disabled";}?>><?=T::confirmbooking?></button>
                    </div>
                </div><!-- end col-lg-12 -->

            </div><!-- end col-lg-8 -->
            <div class="col-lg-4" style="z-index:0;">
            <div class="sticky-top">
                <div class="form-box booking-detail-form">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::bookingdetails?></h3>
                    </div><!-- end form-title-wrap -->
                    <div class="form-content">
                        <div class="card-item shadow-none radius-none mb-0">

                         <?php include "partcials/flight.php" ?>

                            <div class="card-body p-0">
                                <div class="section-block"></div>
                                <!-- tabby snippet -->
                               <script src="https://checkout.tabby.ai/tabby-product-page-snippet-cci.js"></script>
                               <div id="tabbyId" class="pb-2"></div>
                                        
                                <script type="text/javascript">
                                  new window.TabbyProductPageSnippetCCI({
                                    selector: '#tabbyId',
                                    lang: '<?=$session_lang?>', // 'ar'
                                    currency: '<?= $currency?>', // 'SAR, AED, KWD, BHD'
                                    price: '<?=$prices->total;?>',
                                  });
                                </script>
                              <!-- tabby snippet end -->
                                <ul class="list-items list-items-2 py-3">
                                    <li><span><?=T::travellers?>:</span></li>
                                    <li><span><?=T::adults?>:</span> <?=$traveller->adults?> - <small class="flight_travellers"><?= $prices->currency;?> <?= $traveller->adults * $prices->oneway_adult_price;?></small> </li>
                                    <?php if (!empty($traveller->childs)){ ?><li><span><?=T::child?>:</span> <?=$traveller->childs?> - <small class="flight_travellers"><?= $prices->currency;?> <?= $traveller->childs * $prices->oneway_child_price;?></small></li><?php } ?>
                                    <?php if (!empty($traveller->infants)){ ?><li><span><?=T::infant?>:</span> <?=$traveller->infants?> - <small class="flight_travellers"><?= $prices->currency;?> <?= $traveller->infants * $prices->oneway_infant_price;?></small></li><?php } ?>
                                </ul>

                                <ul class="list-items list-items-2 pt-3">
                                    <li><span><?=T::subtotal?>:</span><?=$currency?> <?php echo $prices->total;?> </li>
                                    <li><span><?=T::taxesandfees?>:</span><?=$currency?> <?=$prices->total;?></li>
                                    <hr>
                                    <li style="font-size:22px"><span><?=T::totalprice?>:</span><strong><?=$currency?> <?=$prices->total;?> </strong></li>
                                    <hr>
                                    <li><span><?=T::depositnow?>:</span><strong><?=$currency?> <?=$prices->total;?></strong></li>
                                    <!--<li><span><?=T::remaining?>:</span><strong><?=$currency?> 56 </strong></li>-->
                                </ul>
                            </div>
                        </div><!-- end card-item -->
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
            </div><!-- end col-lg-4 -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end booking-area -->

<?php
$routes['booking_type'] = 'flights';
// dd($routes);die;
$routes = json_decode(json_encode($routes));
// $parms = array(
// 'currency'=>$currency,
// 'travellers'=>$travellers,
// 'total'=>$prices->total);
// dd($prices);die;
?>

<input type="hidden" name="payload" value="<?= base64_encode(json_encode($routes)) ?>" />
<input type="hidden" name="traveller" value="<?= base64_encode(json_encode($traveller)) ?>" />
<input type="hidden" name="prices" value="<?= base64_encode(json_encode($prices)) ?>" />

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
                    var firstname_ = $('.firstname_').val();
                    var lastname_ = $('.lastname_').val();

                    
                    var dob_month_ = $('.dob_month_').val();
                    var dob_day_ = $('.dob_day_').val();
                    var dob_year_ = $('.dob_year_').val();
                    
                    var passport_ = $('.passport_').val();
                    var passport_month_ = $('.passport_month_').val();
                    var passport_day_ = $('.passport_day_').val();
                    var passport_year_ = $('.passport_year_').val();

                    var passport_issuance_month_ = $('.passport_issuance_month_').val();
                    var passport_issuance_day_ = $('.passport_issuance_day_').val();
                    var passport_issuance_year_ = $('.passport_issuance_year_').val();
                    
                
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
                    
                    if(firstname_==''){
                        $('.firstname_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }

                    if(lastname_==''){
                        $('.lastname_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                    if(dob_month_==''){
                        $('.dob_month_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(dob_day_==''){
                        $('.dob_day_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    
                    if(dob_year_==''){
                        $('.dob_year_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_==''){
                        $('.passport_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_month_==''){
                        $('.passport_month_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_day_==''){
                        $('.passport_day_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_year_==''){
                        $('.passport_year_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_issuance_month_==''){
                        $('.passport_issuance_month_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_issuance_day_==''){
                        $('.passport_issuance_day_').focus();
                        validate = false;
                        e.preventDefault();
                        return;
                    }
                    if(passport_issuance_year_==''){
                        $('.passport_issuance_year_').focus();
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
$("body").scrollTop(0);
$(".book").submit(function() {
$(".booking_loading").css("display", "block");
$(".booking_data").css("display", "none");
});
</script>

<style>
.form-check{cursor:pointer}
.header-top-bar,.main-menu-content,.info-area,.footer-area,.cta-area{display:none;margin:0px}
.menu-wrapper{display: flex; justify-content: center; padding: 12px;}
img{background:transparent}
.contact-form-action .form-group .form-icon{z-index: 0!important;}

</style>