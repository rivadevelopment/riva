<style>
.lazyloading{background:#c3cdd6}
</style>

<section class="hero-wrapper">
  <div class="hero-box hero-bg active lazyload" data-bg="<?=api_url?>uploads/images/slider/<?php foreach ($app->slider as $item){ if( $item->slide_order == 1 && $item->slide_status == "Yes" ) echo $item->slide_image; } ?>" style="min-height:371px;background-attachment: fixed;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto responsive--column-l">
          <div class="hero-content pb-4 ">
            <div class="section-heading">
              <!--<h2 class="sec__titles cd-headline zoom d-none d-sm-block" style="color:#fff">
                <?=T::hero1; ?> <span class="cd-words-wrapper" style="width: 252.5px;">
                <?php foreach ($app->modules as $model){ if($model->status == true){ ?>
                <b class="is-hidden" style="text-transform: capitalize;"><?=$model->name ?></b>
                <?php } } ?>
                <b class="is-visible">Flights</b>
                </span>
              </h2>
              <p class="text-white strong"><?=T::hero2; ?></p>-->
            </div>
          </div>
          <!-- end hero-content -->
          <div class="section-tab fade-in glass" style="min-height:167px">
            <ul class="nav nav-tabs listitems" id="Tab" role="tablist">
              <?php if (isset($hotels)) { if ($hotels == 1) {?><li data-position="<?= $hotels_order ?>" class="nav-item" role="presentation"><button class="nav-link" id="hotels-tab" data-bs-toggle="tab" data-bs-target="#hotels" type="button" role="tab" aria-controls="hotels" aria-selected="false"><span class="d-xl-none d-lg-none"><i class="la la-hotel mx-1"></i></span><span class="d-none d-lg-block d-xl-block"><i class="la la-hotel mx-1"></i> <?=T::hotels_hotels; ?></span></button></li><?php } } ?>
              <?php if (isset($flights)) { if ($flights == 1) {?><li data-position="<?= $flights_order ?>" class="nav-item" role="presentation"><button class="nav-link" id="hotels-tab" data-bs-toggle="tab" data-bs-target="#flights" type="button" role="tab" aria-controls="flights" aria-selected="false"><span class="d-xl-none d-lg-none"><i class="la la-plane mx-1"></i></span><span class="d-none d-lg-block d-xl-block"><i class="la la-plane mx-1"></i> <?=T::flights_flights; ?></span></button></li><?php } } ?>
              <!--<?php if (isset($tours)) { if ($tours == 1) {?><li data-position="<?= $tours_order ?>" class="nav-item" role="presentation"><button class="nav-link" id="tours-tab" data-bs-toggle="tab" data-bs-target="#tours" type="button" role="tab" aria-controls="tours" aria-selected="false"><span class="d-xl-none d-lg-none"><i class="la la-briefcase mx-1"></i></span><span class="d-none d-lg-block d-xl-block"><i class="la la-briefcase mx-1"></i> <?=T::tours_tours; ?></span></button></li><?php } } ?>-->
              <?php if (isset($cars)) { if ($cars == 1) {?><li data-position="<?= $cars_order ?>" class="nav-item" role="presentation"><button class="nav-link" id="cars-tab" data-bs-toggle="tab" data-bs-target="#cars" type="button" role="tab" aria-controls="cars" aria-selected="false"><span class="d-xl-none d-lg-none"><i class="la la-car mx-1"></i></span><span class="d-none d-lg-block d-xl-block"><i class="la la-car mx-1"></i> <?=T::cars_cars; ?></span></button></li><?php } } ?>
              <?php if (isset($visa)) { if ($visa == 1) {?><li data-position="<?= $visa_order ?>" class="nav-item" role="presentation"><button class="nav-link" id="visa-tab" data-bs-toggle="tab" data-bs-target="#visa" type="button" role="tab" aria-controls="visa" aria-selected="false"><span class="d-xl-none d-lg-none"><i class="la la-passport mx-1"></i></span><span class="d-none d-lg-block d-xl-block"><i class="la la-passport mx-1"></i> <?=T::visa_visa; ?></span></button></li><?php } } ?>
            </ul>
            <div class="tab-content search-fields-container search_area search_tabs" id="TabContent">
              <?php foreach ($app->modules as $model){ if($model->status == true){ ?>
              <div class="tab-pane fade" id="<?=$model->name ?>" role="<?=$model->name ?>" aria-labelledby="<?=$model->name ?>-tab">
              <?php require_once 'modules/'.$model->name.'/search.php';?>
              </div>
              <?php } } ?>
            </div>
          </div>
          <!--
          <?php // recent searches from session
          if (isset($_SESSION['SEARCHES'])) { ?>
          <div class="row mt-3">
          <div class="col-md-12">
          <p class="mb-0 cw"><?=T::recentsearches?></p>
          <hr style="margin: 4px 0; color: #fff;">
          </div>
            <?php  $max = 12;
            $max_print = count(array_unique($_SESSION['SEARCHES'], SORT_REGULAR));
            krsort($_SESSION['SEARCHES']); foreach (array_unique($_SESSION['SEARCHES'], SORT_REGULAR) as $index => $SEARCHES)  if ($max_print < $max) {
            { $urlm = 0; $urlc = 1; $urlb = 2; }
            ?>
            <div class="col-md-2 mt-3">
            <div class="list-group drop-reveal-list recentsearches">
            <a href="<?=$SEARCHES->$urlb?>" class="list-group-item list-group-item-action border-top-0" target="_blank">
            <div class="msg-body d-flex align-items-center">
                <div class="icon-element flex-shrink-0 mr-3 ml-0">
                <?php if(strtolower($SEARCHES->$urlm) =="hotels"){?><i class="la la-hotel"></i><?php } ?>
                <?php if(strtolower($SEARCHES->$urlm) =="flights"){?><i class="la la-plane"></i><?php } ?>
                <?php if(strtolower($SEARCHES->$urlm) =="tours"){?><i class="la la-briefcase"></i><?php } ?>
                <?php if(strtolower($SEARCHES->$urlm) =="cars"){?><i class="la la-car"></i><?php } ?>
                <?php if(strtolower($SEARCHES->$urlm) =="visa"){?><i class="la la-passport"></i><?php } ?>
                </div>
                <div class="msg-content w-100">
                    <h3 class="title pb-0 px-2" style="text-transform:uppercase"><?=$SEARCHES->$urlm?></h3>
                    <p class="msg-text px-2" style="text-transform:capitalize"><?=$SEARCHES->$urlc?></p>
                </div>
            </div>
            </a>
            </div>
            </div>
            <?php } ?> -->
          </div>
          <?php } else {} ?>
        </div>
      </div>
    </div>
    <!--<svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
      <path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
    </svg>-->
  </div>
</section>


<!-- Feras ----> 


<!---------> 

<section class="info-area  padding-top-50px padding-bottom-50px text-center" > <!--  info-bg  -->
   <div class="container"> 
        
      <div class="row" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center; align-items: center;">
         <div class="col-lg-4" style="vertical-align: middle;">
            <div class="icon-box icon-layout-2" style="background:none;">
               
               <div class="info-content image-box">
                  <img src="<?=root?>app/themes/default/assets/img/home-discover.png" alt="App-image"  class="img__item2" style="width:100%;"/>
               </div>
            </div>
         </div>
         <div class="col-lg-5">
            <div class="icon-box icon-layout-2">
               <!-- end info-icon-->
               <div class="info-content">
                      <h4 class="info__title heading-featured-style text-gray padding-bottom-10px">"<?=T::mobile_body1; ?>"</h4>
                      <h6 class="heading-featured-style text-color-12 adding-top-10px">
                        <?=T::mobile_body2; ?>
                      </h6>
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="icon-box icon-layout-2">
               <div class="info-content">
                   <!--<div class="col-lg-10 col-xs-10 col-sm-10 col-md-10 border">-->
                       <img src="<?=root?>app/themes/default/assets/img/appleStore.png" alt="App-image"  class="padding-bottom-20px img__item2" style="max-width:80%; margin: auto;"/>
                        <img src="<?=root?>app/themes/default/assets/img/googlePlay.png" alt="App-image"  class="img__item" style="max-width:80%; margin: auto;"/>
                    <!--</div>    -->
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
if (isset($hotels)) { if ($hotels == 1) { include theme_url."modules/hotels/featured.php"; } }
?>

<!-- ///////////////////////// **** orginal down **** /////////////////// -->

<section class="info-area padding-top-50px padding-bottom-50px text-center "> <!--  info-bg  -->
   <div class="container"> 
       
       
       <div class="row padding-top-50px padding-bottom-50px">
            <div class="col-lg-12">
                <div class="section-heading text-center font-style-1" >
                    <h2 class="sec__title font-size-40"><?=T::why_different;?></h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
        
        
      <div class="row">
         <div class="col-lg-4">
            <div class="icon-box icon-layout-4" style="background:none;">
               <div class="info-icon" style="background:#fff">
                   <img src="<?=root?>app/themes/default/assets/img/flightNowPayLater.png" alt="App-image"  class="img-fluid lazyload" style="width:100%;"/> 
               </div>
               <div class="info-content">
                  <h4 class="info__title"><?=T::flight_now_pay_later;?></h4>
                  <p class="info__desc">
                   <?=T::flight_now_pay_later_desc;?>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="icon-box icon-layout-4" style="background:none;">
               <div class="info-icon" style="background:#fff">
                   <img src="<?=root?>app/themes/default/assets/img/passport-ticket-icon.png" alt="App-image"  class="img-fluid lazyload" style="width:100%;"/> 
               </div>
               <!-- end info-icon-->
               <div class="info-content">
                  <h4 class="info__title"> <?=T::change_trip;?></h4>
                  <p class="info__desc">
                      <?=T::change_trip_desc;?>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="icon-box icon-layout-4" style="background:none;">
               <div class="info-icon" style="background:#fff">
                   <img src="<?=root?>app/themes/default/assets/img/receipt-icon.png" alt="App-image"  class="img-fluid lazyload" style="width:100%;"/> 
               </div>
               <div class="info-content">
                  <h4 class="info__title"> <?=T::earn_trip;?></h4>
                  <p class="info__desc">
                     <?=T::earn_trip_desc;?>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

 


<?php
if (isset($tours)) { if ($tours == 1) { include theme_url."modules/tours/featured.php"; } }
?>



<!--?php
if (isset($flights)) { if ($flights == 1) { include theme_url."modules/flights/featured.php"; } }
if (isset($hotels)) { if ($hotels == 1) { include theme_url."modules/hotels/featured.php"; } }
if (isset($tours)) { if ($tours == 1) { include theme_url."modules/tours/featured.php"; } }
if (isset($cars)) { if ($cars == 1) { include theme_url."modules/cars/featured.php"; } }
if (isset($offers)) { if ($offers == 1) { include theme_url."modules/offers/featured.php"; } }
if (isset($blog)) { if ($blog == 1) { include theme_url."modules/blog/featured.php"; } }
?-->


<!-- ================================
    START INFO AREA
================================= -->
<section class="info-area padding-top-30px padding-bottom-20px"> <!--  info-bg  -->
    <div class="container">
        
        
        <div class="row">
            <div class="col-lg-12 padding-bottom-20px">
                <!--<div class="section-heading text-center">-->
                <!--    <h2 class="sec__title line-height-55 bottom-linec">Follow us</h2>-->
                <!--</div>-->
                
                <div class="section-heading text-center">
                    <h2 class="heading-featured-style text-color-12"><?=T::follow_us;?></h2>
                </div>
                
               
                 <div class="info-content text-center padding-top-10px">
                  <p class="info__desc text-center"><?=T::follow_us_desc;?></p>
               </div>
            </div>
        </div>

              


        
         <!--<div class="row">-->
         <!--    <div class="col-lg-8">-->
         <!--        <div class="section-heading">-->
         <!--               <h2 class="sec__title line-height-55 left-linec  padding-bottom-10px">Follow us and get the best offers ever..</h2>-->
         <!--           </div>-->
         <!--    </div>-->
         <!--</div>     -->
         <div class="row">

                    <?php foreach ($app->social as $socials){ //if($socials->status == true){ 
                        $bg = 'bg-rgb';
                        $text_color ='text-color-8';
                        $Solgan = T::instagram_desc; //'Follow us to get more';
                        $socialName = T::instagram;
                    
                            if(strtolower($socials->social_name) == 'facebook'){
                                $bg = 'bg-rgb-5';
                                $text_color ='text-color-7';
                                //$Solgan = 'Dream & follow our facebook page';
                                $Solgan = T::facebook_desc; 
                                $socialName = T::facebook;
                            }
                            
                             if(strtolower($socials->social_name) == 'whatsapp'){
                                $bg = 'bg-rgb-2';
                                $text_color ='text-color-3';
                                //$Solgan = 'Get your answer within 2 minutes';
                                $Solgan = T::whatsapp_desc; 
                                $socialName = T::whatsapp;
                            }
                    ?>

                          <div class="col-lg-4 responsive-column">
                            <a href="<?=$socials->social_link ?>" class="icon-box icon-layout-2 d-flex" target= "_blank">
                                <div class="info-icon flex-shrink-0 <?=$text_color?> <?=$bg?>">
                                    <i class="lab la-<?=strtolower($socials->social_name)?>"></i>
                                </div><!-- end info-icon-->
                                <div class="info-content pt-2">
                                    <h4 class="info__title"><?=strtolower($socialName)?></h4>
                                    <p class="info__desc">
                                       <?=$Solgan?>
                                    </p>
                                </div><!-- end info-content -->
                            </a><!-- end icon-box -->
                        </div><!-- end col-lg-4 -->
                    <?php } ?>
         </div>
        
        <!--<div class="row">-->
        <!--    <div class="col-lg-4 responsive-column">-->
        <!--        <a href="<?=root?>contact" class="icon-box icon-layout-2 d-flex">-->
        <!--            <div class="info-icon flex-shrink-0 bg-rgb text-color-2">-->
        <!--                <i class="la la-phone"></i>-->
        <!--            </div><!-- end info-icon-->
        <!--            <div class="info-content pt-2">-->
        <!--                <h4 class="info__title"><?=T::needhelp?></h4>-->
        <!--                <p class="info__desc">-->
        <!--                   <?=T::helptext?>-->
        <!--                </p>-->
        <!--            </div><!-- end info-content -->
        <!--        </a><!-- end icon-box -->
        <!--    </div><!-- end col-lg-4 -->
        <!--    <div class="col-lg-4 responsive-column">-->
        <!--        <div class="icon-box icon-layout-2 d-flex">-->
        <!--            <div class="info-icon flex-shrink-0 bg-rgb-2 text-color-3">-->
        <!--                <i class="la la-money"></i>-->
        <!--            </div><!-- end info-icon-->
        <!--            <div class="info-content pt-2">-->
        <!--                <h4 class="info__title"><?=T::securepayments?></h4>-->
        <!--                <p class="info__desc">-->
        <!--                   <?=T::securepaymentstext?>-->
        <!--                </p>-->
        <!--            </div><!-- end info-content -->
        <!--        </div><!-- end icon-box -->
        <!--    </div><!-- end col-lg-4 -->
        <!--    <div class="col-lg-4 responsive-column">-->
        <!--        <div class="icon-box icon-layout-2 d-flex">-->
        <!--            <div class="info-icon flex-shrink-0 bg-rgb-3 text-color-4">-->
        <!--                <i class="la la-times"></i>-->
        <!--            </div><!-- end info-icon-->
        <!--            <div class="info-content pt-2">-->
        <!--                <h4 class="info__title"><?=T::cancelpolicy?></h4>-->
        <!--                <p class="info__desc">-->
        <!--                   <?=T::cancelpolicytext?>-->
        <!--                </p>-->
        <!--            </div><!-- end info-content -->
        <!--        </div><!-- end icon-box -->
        <!--    </div><!-- end col-lg-4 -->
        <!--</div><!-- end row -->
    </div><!-- end container -->
</section><!-- end info-area -->
<!-- ================================
    END INFO AREA
================================= -->



