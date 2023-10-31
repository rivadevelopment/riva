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
<form action="<?=root?>flights/book" method="POST" class="book" id="registerSubmit22">
<section class="booking-area padding-top-50px padding-bottom-70px">
    <div class="container">
        <div class="row">

            <div class="accordion col-lg-8" id="myAccordion">
             <div class="accordion-item"> <!--accordion-->    
                <div class="form-box mb-2">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::yourpersonalinformation?></h3>
                    </div><!-- form-title-wrap -->
                    <div class="accordion-content accordion-collapse collapse show"  id="content-1" data-bs-parent="#myAccordion">
                        <?php include views."modules/accounts/booking_user.php";?>
                                <div class="col-lg-12 p-2">
                                    <div class="clearfix">
                                        <!--<button style="padding: 6px 44px" id="primaryPrevBtn" class="btn btn-warning waves-effect">Prev</button>-->
                                        <button oncklick="#" style="padding: 6px 44px" id="AccordionNextBtn"  name="AccordionNextBtn" class="AccordionNextBtn btn btn-success waves-effect right align-right float-right text-right">Next</button>
                                         <!--<input style="padding: 6px 44px" id="AccordionNextBtn1" name="AccordionNextBtn1" class="AccordionNextBtn btn btn-success waves-effect right align-right float-right text-right" type="button" value="Next" />-->
                                   </div>
                                </div><!-- end col-lg-12 -->
                    </div>
                </div><!-- end form-box -->
               </div><!--accordion-->
               
               
               
               <div class="accordion-item"> <!--accordion--> <!-- Ferassssssss -->
                <div class="form-box payment-received-wrap mb-2">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::travellersinformation?></h3>
                    </div>
                    <div class="accordion-content accordion-collapse collapse"  id="content-2" data-bs-parent="#myAccordion"> <!-- Ferassssssss -->
                    <div class="card-body">
                    <!-- adults -->
                    <?php if (isset($_SESSION['flights_adults'])) {
                    $travellers = $_SESSION['flights_adults'];
                    } else $travellers = 1; for ($i = 1; $i <= $travellers; $i++) { ?>
                     <div class="card mb-3">
                        <!--<div class="card-header">-->
                        <!--    <?=T::adult?> <?=T::traveller?> <strong><?=$i?></strong>-->
                        <!--</div>-->
                        
                           <div class="pt-3" style="padding-left: 20px;">
                            <strong> <?=T::adult?> - </strong> <?=T::traveller?> <?=$i?> 
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
                            <div class="col-md-12">
                                <label class="label-text"><?=T::passport_or_id?></label>
                                <input type="number" name="passport_<?=$i?>" class="form-control passport_" placeholder="<?=T::passport_or_id?>" value="<?php if (dev == 1){echo "6655899745626";}?>"/>
                            </div>
                            
                            <div class="col-md-6">
                                  <label class="label-text"><?=T::passport_issuance?></label>
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
                            <div class="col-md-6">
                                 <label class="label-text"><?=T::passport_expiry?></label>
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
                        </div>

                        </div>
                     </div>
                     <?php } ?>

                     <!-- child -->
                     <?php if (isset($_SESSION['flights_childs'])) {
                    $travellers = $_SESSION['flights_childs'];
                    } else $travellers = 1; for ($i = 1; $i <= $travellers; $i++) { ?>
                     <div class="card mb-3">
                        <!--<div class="card-header">-->
                             <!-- childs -->
                        <!--     Childs <?=T::traveller?> <strong><?=$i+$_SESSION['flights_adults']?></strong>-->
                        <!--</div>-->
                        
                           <div class="pt-3" style="padding-left: 20px;">
                            <strong> <?=T::child?> - </strong> <?=T::traveller?> <?=$i+$_SESSION['flights_adults']?>
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
                        <div class="col-md-12">
                            <label class="label-text"><?=T::passport_or_id?></label>
                            <input type="number" name="passport_<?=$i+$_SESSION['flights_adults']?>" class="form-control passport_" placeholder="<?=T::passport_or_id?>" value="<?php if (dev == 1){echo "6655899745626";}?>"/>
                        </div>
                       

                        <div class="col-md-6">
                                <label class="label-text"><?=T::passport_issuance?></label>
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
                        

                        <div class="col-md-6">
                            <label class="label-text"><?=T::passport_expiry?></label>
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



                        </div>
                    </div>
                </div>
                     <?php } ?>

                     <!-- infants -->
                     <?php if (isset($_SESSION['flights_infants'])) {
                    $travellers = $_SESSION['flights_infants'];
                    } else $travellers = 1; for ($i = 1; $i <= $travellers; $i++) { ?>
                     <div class="card mb-3">
                        <!--<div class="card-header">-->
                        <!--    <?=T::infants?> <?=T::traveller?> <strong><?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?></strong>-->
                        <!--</div>-->
                        
                           <div class="pt-3" style="padding-left: 20px;">
                            <strong> <?=T::infants?> - </strong> <?=T::traveller?> <?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>
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
                        <div class="col-md-12">
                            <label class="label-text"><?=T::passport_or_id?></label>
                            <input type="number" name="passport_<?=$i+$_SESSION['flights_childs']+$_SESSION['flights_adults']?>" class="form-control passport_" placeholder="<?=T::passport_or_id?>" value="<?php if (dev == 1){echo "6655899745626";}?>"/>
                        </div>
                       

                        <div class="col-md-6">
                            <label class="label-text"><?=T::passport_issuance?></label>
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
                        
                        <div class="col-md-6">
                            <label class="label-text"><?=T::passport_expiry?></label>
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

                        </div>
                    </div>
                 </div>
                     <?php } ?>
                     
                     
                     
                     
                     <!-------------->
                      <!-------------->
                       <!-------------->
                        <!-------------->
                        
                        <div class="col-lg-12">
                            <div class="clearfix">
                                            
                                            <?php 
                                            if (isset($_SESSION['frules'])) {?>
                                            
                                                <span class="col-lg-12 theme-btn theme-btn-small theme-btn-rgb"><strong>Fare Rules -</strong> 
                                                 <?php 
                                                    echo $_SESSION['frules'];
                                                    unset($_SESSION['frules']);
                                                  ?>
                                                </span>
                                              
                                                    <!-- <div class="card">-->
                                                    <!--    <div class="card-header" id="faqHeadingFour">-->
                                                    <!--        <h2 class="mb-0">-->
                                                    <!--            <button class="btn btn-link d-flex align-items-center justify-content-end flex-row-reverse font-size-16" type="button" data-toggle="collapse" data-target="#faqCollapseFour" aria-expanded="true" aria-controls="faqCollapseFour">-->
                                                    <!--                <span class="ml-3 pl-3" style="padding-left: 10px;">Fare Rules</span>-->
                                                    <!--                <i class="la la-minus"></i>-->
                                                    <!--                <i class="la la-plus"></i>-->
                                                    <!--            </button>-->
                                                    <!--        </h2>-->
                                                    <!--    </div>-->
                                                    <!--    <div id="faqCollapseFour" class="collapse show" aria-labelledby="faqHeadingFour" data-parent="#accordionExample2" style="">-->
                                                    <!--        <div class="card-body d-flex">-->
                                                    <!--            <p class="font-size-11">-->
                                                    <!--                <!--?php 
                                                    <!--                    echo $_SESSION['frules'];
                                                    <!--                    unset($_SESSION['frules']);
                                                    <!--                ?-->
                                                    <!--            </p>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</div><!-- end card -->
                                            <?php }?>
                                
                                            <?php 
                                            if (isset($_SESSION['fgeneral'])) {?>
                                            
                                             <span class="col-lg-12 theme-btn theme-btn-small theme-btn-rgb"><strong>General Info - </strong>
                                                 <?php 
                                                    echo $_SESSION['fgeneral'];
                                                    unset($_SESSION['fgeneral']);
                                                  ?>
                                                </span>
                                            
                                                    <!--<div class="card">-->
                                                    <!--    <div class="card-header" id="faqHeadingFive">-->
                                                    <!--        <h2 class="mb-0">-->
                                                    <!--            <button class="btn btn-link d-flex align-items-center justify-content-end flex-row-reverse font-size-16 collapsed" type="button" data-toggle="collapse" data-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">-->
                                                    <!--                <span class="ml-3 pl-3" style="padding-left: 10px;">General Info</span>-->
                                                    <!--                <i class="la la-minus"></i>-->
                                                    <!--                <i class="la la-plus"></i>-->
                                                    <!--            </button>-->
                                                    <!--        </h2>-->
                                                    <!--    </div>-->
                                                    <!--    <div id="faqCollapseFive" class="collapse" aria-labelledby="faqHeadingFive" data-parent="#accordionExample2" style="">-->
                                                    <!--        <div class="card-body d-flex">-->
                                                    <!--            <p class="font-size-11">-->
                                                    <!--              <!--?php 
                                                    <!--                echo $_SESSION['fgeneral'];
                                                    <!--                unset($_SESSION['fgeneral']);
                                                    <!--              ?-->
                                                    <!--            </p>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</div><!-- end card -->
                                          <?php }?>
                                          
                                </div>
                            </div><!-- end col-lg-12 -->
                         <!-------------->
                        <!-------------->
                      <!-------------->    
                    <!--------------> 
                     
                     
                     
                     
                     
                     
                    </div>

                  
                            <div class="col-lg-12 p-2">
                                <div class="clearfix">
                                    <button oncklick="#" style="padding: 6px 44px" id="AccordionPervBtn2"  name="AccordionPervBtn2" class="AccordionPervBtn btn btn-warning waves-effect">Prev</button>
                                    <button oncklick="#" style="padding: 6px 44px" id="AccordionNextBtn2"  name="AccordionNextBtn2" class="AccordionNextBtn btn btn-success waves-effect right align-right float-right text-right">Next</button>
                                    <!--<input style="padding: 6px 44px" id="AccordionPervBtn2" name="AccordionPervBtn2" class="AccordionPervBtn btn btn-warning waves-effect" type="button" value="Prev" />-->
                                    <!--<input style="padding: 6px 44px" id="AccordionNextBtn2" name="AccordionNextBtn2" class="AccordionNextBtn btn btn-success waves-effect right align-right float-right text-right" type="button" value="Next" />-->
                               </div>
                            </div><!-- end col-lg-12 -->
                
                
                
                   </div> <!-- accordion-->
                 
                 </div><!--accordion-->
                 </div>
                 
                
                 
                <?php include views."partcials/payment_methods.php"; ?>
                


            </div><!-- end col-lg-8 -->
      
       
            
            
            <div class="col-lg-4">
            <div class="sticky-top">
                <div class="form-box booking-detail-form">
                    <div class="form-title-wrap">
                        <h3 class="title"><?=T::bookingdetails?></h3>
                    </div><!-- end form-title-wrap -->
                    <div class="form-content">
                        <div class="card-item shadow-none radius-none mb-0">

                         <?php include "partcials/flight.php" ?>

                            <div class="card-body p-0">
                                <!--<div class="section-block"></div>-->
                                <!-- tabby snippet -->
                               <script src="https://checkout.tabby.ai/tabby-product-page-snippet-cci.js"></script>
                               <div id="tabbyId" class="pb-2"></div>
                                        
                                <script type="text/javascript">
                                  new window.TabbyProductPageSnippetCCI({
                                    selector: '#tabbyId',
                                    lang: '<?=$session_lang?>', // 'ar'
                                    currency: '<?=$currency?>', // 'SAR, AED, KWD, BHD'
                                    price: '<?=$prices->total;?>',
                                  });
                                </script>
                              <!-- tabby snippet end -->
                              <!--  -->
                              
                              
                                <!--<div class="section-block"></div>-->
                                <h3 class="card-title pt-3 pb-2 font-size-15"><a><strong><?=T::travellers?></strong></a></h3>
                                <div class="section-block"></div>
                                <ul class="list-items list-items-2 py-3">
                                    <li class="font-size-15"><span><?=T::adults?>:</span><?=$traveller->adults?></li>
                                    <li class="font-size-15"><span><?=T::child?> :</span><?=$traveller->childs?></li>
                                    <li class="font-size-15"><span><?=T::infant?>:</span><?=$traveller->infants?> </li>
                                </ul>
                              
                              
                                <!--<ul class="list-items list-items-2 py-3">-->
                                <!--    <li><span>< ?=T::travellers?>:</span></li>-->
                                    <!-- oneway -->
                                <!--    <li><span>< ?=T::adults?>:</span> Oneway - < ?=$traveller->adults?> - <small class="flight_travellers">< ?= $prices->currency;?> < ?= $traveller->adults * $prices->oneway_adult_price;?></small> </li>-->
                                <!--    <li><span>< ?=T::child?>:</span> Oneway - < ?=$traveller->childs?> - <small class="flight_travellers">< ?= $prices->currency;?> < ?= $traveller->childs * $prices->oneway_child_price;?></small></li>-->
                                <!--    <li><span>< ?=T::infant?>:</span> Oneway - < ?=$traveller->infants?> - <small class="flight_travellers">< ?= $prices->currency;?> < ?= $traveller->infants * $prices->oneway_infant_price;?></small></li>-->
                                    
                                    <!-- return -->
                                    <!--?php if($prices->flight_type == 'return'){?-->
                                <!--    <li><span>< ?=T::adults?>:</span> < ?=$prices->flight_type?> - < ?=$traveller->adults?> - <small class="flight_travellers">< ?= $prices->currency;?> < ?= $traveller->adults * $prices->return_adult_price;?></small> </li>-->
                                <!--    <li><span>< ?=T::child?>:</span> < ?=$prices->flight_type?> - < ?=$traveller->childs?> - <small class="flight_travellers">< ?= $prices->currency;?> < ?= $traveller->childs * $prices->return_child_price;?></small></li>-->
                                <!--    <li><span>< ?=T::infant?>:</span> < ?=$prices->flight_type?> - < ?=$traveller->infants?> - <small class="flight_travellers">< ?= $prices->currency;?> < ?= $traveller->infants * $prices->return_infant_price;?></small></li>-->
                                    <!--?php }?-->
                                <!--</ul>-->
                                <div class="section-block"></div>
                                <ul class="list-items list-items-2 pt-3">
                                    <li><span><?=T::subtotal?>:</span><?=$currency?> <?php echo $prices->total;?></li>
                                    <li><span><?=T::taxesandfees?>:</span><span><?=$currency?> <?=round(($prices->total*.05),2);?></span></li>
                                    <hr>
                                    <li style="font-size:16px"><span><?=T::totalprice?>:</span><strong><?=$currency?> <?=round(($prices->total*1.05),2);?> </strong></li>
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
  
  //dd($prices);
    //$prices['tax'] = round(($prices->total*.05),2);
    $prices->total = round(($prices->total*1.05),2);
  ?>


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

  <?php include views."partcials/tabby-payment-methods.php"; ?> 
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


<script src="<?=root.theme_url?>assets/js/booking.accordion.js"></script>



