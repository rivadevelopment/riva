<!-- ================================
    START CONTACT AREA
================================= -->
<section class="contact-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-box">
                    <div class="form-content ">
                        <div class="contact-form-action">
                                <div class="col-lg-12" style="justify-content: center;">
                                    <div class="input-box align-items-center" style="justify-content: center;">
                                        <div class="align-items-center" style="justify-content: center;">
                                            <div class="author-img">
                                                <!--<img src="<?=root.theme_url?>assets/img/user.png" alt="user" -->
                                                <!--style="width:60%; padding:10px;  display: block; margin-left: auto; margin-right: auto;">-->
                                                <img data-wow-duration="0.2s" data-wow-delay="0.2s" src="<?=root.theme_url?>assets/img/Profile-persona.png" class="wow fadeIn center-block" style="width: 60%; padding:10px;  display: block; margin-left: auto; margin-right: auto;" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-12 -->
                                <div class="col-lg-12 align-items-center" style="padding: 10px;">
                                    <div class="input-box align-items-center" style="text-align: center;">
                                          <span class="author__meta text-center align-items-center"><?=T::welcomeback?></span>
                                       <h6 class="author__title" >
                                           <strong style="text-transform:capitalize;">
                                                <?=$_SESSION['user_name']?> 
                                          </strong>
                                       </h6>
                                    </div>
                                </div><!-- end col-lg-12 -->
                                 <div class="col-lg-12">
                                    <div class="sidebar-menu-wrap">
                                        <ul class="sidebar-menu list-items">
                                            <?php if( !($_SESSION['user_type'] == 'guest' || $_SESSION['user_type'] == 'customers')) 
                                             { ?>
                                             <li class="<?php if (isset($dashboard_active)) { echo $dashboard_active; };?>"><a href="<?=root.('account/dashboard')?>"><i class="la la-dashboard mr-2 text-color-10"></i> <?=T::dashboard?></a></li>
                                             <li class="<?php if (isset($add_funds)) { echo $add_funds; };?>"><a href="<?=root.('account/add_funds')?>"><i class="la la-wallet mr-2 text-color-10"></i> <?=T::add_funds?></a></li>
                                            <?php } ?>
                                            <li class="<?php if (isset($bookings_active)) { echo $bookings_active; };?>"><a href="<?=root.('account/bookings')?>"><i class="la la-bookmark mr-2 text-color-10"></i> <?=T::mybookings?></a></li>
                                            <li class="<?php if (isset($profile_active)) { echo $profile_active; };?>"><a href="<?=root.('account/profile')?>"><i class="la la-user mr-2 text-color-10"></i> <?=T::myprofile?></a></li>
                                            <!--<li><a href="user-dashboard-reviews.html"><i class="la la-star mr-2 text-color-3"></i>My Reviews</a></li>-->
                                            <!--<li><a href="user-dashboard-wishlist.html"><i class="la la-heart mr-2 text-color-4"></i>Wishlist</a></li>-->
                                            <!--<li><a href="user-dashboard-settings.html"><i class="la la-cog mr-2 text-color-5"></i>Settings</a></li>-->
                                            <li><a href="<?=root.('account/logout')?>"><i class="la la-power-off mr-2 text-color-10"></i> <?=T::logout?></a></li>
                                        </ul>
                                    </div><!-- end sidebar-menu-wrap -->
                                </div><!-- end col-lg-12 -->
                        </div><!-- end contact-form-action -->
                    </div><!-- end form-content -->
                </div><!-- end form-box -->
            </div><!-- end col-lg-4 -->
      


<!--<div class="sidebar-nav" style="margin-top: 50px;z-index:1">-->
<!--    <div class="sidebar-nav-body">-->
<!--        <div class="side-menu-close">-->
<!--            <i class="la la-times"></i>-->
<!--        </div><!-- end menu-toggler -->
<!--        <div class="author-content" style="padding-top: 40px !important;">-->
<!--            <div class="d-flex align-items-center">-->
<!--                <div class="author-img avatar-sm">-->
<!--                    <img src="<?=root.theme_url?>assets/img/user.png" alt="user" style="height:auto">-->
<!--                </div>-->
<!--                <div class="author-bio">-->
<!--                    <h4 class="author__title"><strong style="text-transform:capitalize"><?=$_SESSION['user_name']?></strong></h4>-->
<!--                    <span class="author__meta"><?=T::welcomeback?></span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="sidebar-menu-wrap">-->
<!--            <ul class="sidebar-menu list-items">-->
<!--                <li class="<?php if (isset($dashboard_active)) { echo $dashboard_active; };?>"><a href="<?=root.('account/dashboard')?>"><i class="la la-dashboard mr-2"></i> <?=T::dashboard?></a></li>-->
<!--                <li class="<?php if (isset($bookings_active)) { echo $bookings_active; };?>"><a href="<?=root.('account/bookings')?>"><i class="la la-shopping-cart mr-2 text-color-3"></i> <?=T::mybookings?></a></li>-->
<!--                <li class="<?php if (isset($add_funds)) { echo $add_funds; };?>"><a href="<?=root.('account/add_funds')?>"><i class="la la-wallet mr-2 text-color-9"></i> <?=T::add_funds?></a></li>-->
<!--                <li class="<?php if (isset($profile_active)) { echo $profile_active; };?>"><a href="<?=root.('account/profile')?>"><i class="la la-user mr-2 text-color-2"></i> <?=T::myprofile?></a></li>-->
                <!--<li><a href="user-dashboard-reviews.html"><i class="la la-star mr-2 text-color-3"></i>My Reviews</a></li>
                <li><a href="user-dashboard-wishlist.html"><i class="la la-heart mr-2 text-color-4"></i>Wishlist</a></li>
                <li><a href="user-dashboard-settings.html"><i class="la la-cog mr-2 text-color-5"></i>Settings</a></li>-->
<!--                <li><a href="<?=root.('account/logout')?>"><i class="la la-power-off mr-2 text-color-6"></i> <?=T::logout?></a></li>-->
<!--            </ul>-->
<!--        </div><!-- end sidebar-menu-wrap -->
<!--    </div>-->
<!--</div><!-- end sidebar-nav -->
<!-- ================================
       END DASHBOARD NAV
================================= -->

<style>
.header-area{position:relative;z-index:9999;}
.info-area.info-bg {display:none}
.cta-area,.header-top-bar,.footer-area{display:none}
.header-menu-wrapper{padding: 0 50px}
</style>

<script>
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
document.getElementById('ct').innerHTML = x;
display_c(); }

// console.log(location.pathname.split("/")[2])
</script>