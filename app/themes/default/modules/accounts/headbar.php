<?php
use Curl\Curl;
$req = new Curl();
$req->get(api_url.'api/login/dashboard?appKey='.api_key.'&user_id='.$_SESSION['user_id']);
$res = json_decode($req->response);
$dashboard_details = $res->response;
?>

<div class="dashboard-bread">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--<div class="col-lg-6">-->
            <!--    <div class="breadcrumb-content">-->
            <!--        <div class="section-heading">-->
            <!--            <h2 class="sec__title font-size-30 text-white"><?=T::hi?>, <span style="text-transform:capitalize"><?=$_SESSION['user_name']?></span> <?=T::welcomeback?></h2>-->
            <!--        </div>-->
            <!--    </div><!-- end breadcrumb-content -->
            <!--</div><!-- end col-lg-6 -->
            <div class="col-lg-12">
                <div class="breadcrumb-list text-right">
                    <p style="font-weight:bold;" id="ct"></p>
                </div><!-- end breadcrumb-list -->
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
         <?php if( !($_SESSION['user_type'] == 'guest' || $_SESSION['user_type'] == 'customers')) 
              { ?>
        <div class="row mt-3">
            <div class="col-lg-4 responsive-column-m">
                <div class="icon-box icon-layout-2 dashboard-icon-box" style="background-color: #ffaa0324;" >
                    <div class="d-flex">
                        <div class="info-icon icon-element bg-white flex-shrink-0" 
                             style="border: 2px solid #ffaa02; width:50px;height:50px;line-height:50px;font-size:24px;">
                           <i class="la la-wallet text-color-10"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content">
                            <p class="info__desc font-size-14"><?=T::walletbalance?></p>
                            <h4 class="info__title font-size-14"><?=$dashboard_details->currency.' '.$dashboard_details->balance?></h4>
                        </div><!-- end info-content -->
                    </div>
                </div>
            </div><!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-m">
                <div class="icon-box icon-layout-2 dashboard-icon-box" style="background-color: #ffaa0324;">
                    <div class="d-flex">
                        <div class="info-icon icon-element bg-white flex-shrink-0" 
                             style="border: 2px solid #ffaa02; width:50px;height:50px;line-height:50px;font-size:24px;">
                           <i class="la la-bookmark text-color-10"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content">
                            <p class="info__desc font-size-14"><?=T::totalbookings?></p>
                            <h4 class="info__title font-size-14"><?=$dashboard_details->totel_booking?></h4>
                        </div><!-- end info-content -->
                    </div>
                </div>
            </div><!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-m">
                <div class="icon-box icon-layout-2 dashboard-icon-box" style="background-color: #ffaa0324;">
                    <div class="d-flex">
                        <div class="info-icon icon-element bg-white flex-shrink-0"
                             style="border: 2px solid #ffaa02; width:50px;height:50px;line-height:50px;font-size:24px;">
                           <i class="la la-clock text-color-10"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content">
                            <p class="info__desc font-size-14"><?=T::pending?></p>
                            <h4 class="info__title font-size-14"><?=$dashboard_details->pending_nvoices?></h4>
                        </div><!-- end info-content -->
                    </div>
                </div>
            </div><!-- end col-lg-3 -->
            <!--<div class="col-lg-3 responsive-column-m">-->
            <!--    <div class="icon-box icon-layout-2 dashboard-icon-box">-->
            <!--        <div class="d-flex">-->
            <!--            <div class="info-icon icon-element bg-4 flex-shrink-0">-->
            <!--               <i class="la la-star"></i>-->
            <!--            </div><!-- end info-icon-->
            <!--            <div class="info-content">-->
            <!--                <p class="info__desc"><?=T::reviews?></p>-->
            <!--                <h4 class="info__title">0</h4>-->
            <!--            </div><!-- end info-content -->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div><!-- end col-lg-3 -->
        </div><!-- end row -->
        <?php } else { ?>
                              
        <div class="row mt-2">
            <div class="col-lg-6 responsive-column-m">
                <div class="icon-box icon-layout-2 dashboard-icon-box" style="background-color: #ffaa0324;">
                    <div class="d-flex">
                        <div class="info-icon icon-element bg-white flex-shrink-0" 
                             style="border: 2px solid #ffaa02; width:50px;height:50px;line-height:50px;font-size:24px;">
                           <i class="la la-bookmark text-color-10"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content">
                            <p class="info__desc font-size-14"><?=T::totalbookings?></p>
                            <h4 class="info__title font-size-14"><?=$dashboard_details->totel_booking?></h4>
                        </div><!-- end info-content -->
                    </div>
                </div>
            </div><!-- end col-lg-3 -->
            <div class="col-lg-6 responsive-column-m">
                <div class="icon-box icon-layout-2 dashboard-icon-box" style="background-color: #ffaa0324;">
                    <div class="d-flex">
                        <div class="info-icon icon-element bg-white flex-shrink-0"
                             style="border: 2px solid #ffaa02; width:50px;height:50px;line-height:50px;font-size:24px;">
                           <i class="la la-clock text-color-10"></i>
                        </div><!-- end info-icon-->
                        <div class="info-content">
                            <p class="info__desc font-size-14"><?=T::pending?></p>
                            <h4 class="info__title font-size-14"><?=$dashboard_details->pending_nvoices?></h4>
                        </div><!-- end info-content -->
                    </div>
                </div>
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
        
        
        <?php } ?>
    </div>
</div><!-- end dashboard-bread -->
