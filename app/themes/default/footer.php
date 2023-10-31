<!-- loadaing CSS -->
<?php $loading = '<div class="plane-loader"> <div class="cloud cloud1"></div> <div class="cloud cloud4"></div> <div class="cloud cloud3"></div> <div class="plane"></div> <div class="cloud cloud2"></div> <div class="steam steam1"> <div class="c1"></div> <div class="c2"></div> <div class="c3"></div> <div class="c4"></div> <div class="c5"></div> <div class="c6"></div> <div class="c7"></div> <div class="c8"></div> <div class="c9"></div> <div class="c10"></div> </div> <div class="steam steam2"> <div class="c1"></div> <div class="c2"></div> <div class="c3"></div> <div class="c4"></div> <div class="c5"></div> <div class="c6"></div> <div class="c7"></div> <div class="c8"></div> <div class="c9"></div> <div class="c10"></div> </div> <div class="steam steam3"> <div class="c1"></div> <div class="c2"></div> <div class="c3"></div> <div class="c4"></div> <div class="c5"></div> <div class="c6"></div> <div class="c7"></div> <div class="c8"></div> <div class="c9"></div> <div class="c10"></div> </div> <div class="steam steam4"> <div class="c1"></div> <div class="c2"></div> <div class="c3"></div> <div class="c4"></div> <div class="c5"></div> <div class="c6"></div> <div class="c7"></div> <div class="c8"></div> <div class="c9"></div> <div class="c10"></div> </div> </div>'; ?>

<!-- start back-to-top -->
<div id="back-to-top">
 <i class="la la-angle-up" title="Go top"></i>
</div>
<!-- end back-to-top -->



<?php if (isset($newsletter)) { if ($newsletter == 1) {?>

<section class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="section-heading">
                    <h2 class="sec__title font-size-30 text-white"><?=T::subscribetoseesecretdeals?></h2>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="subscriber-box">
                    <div class="contact-form-action">
                        <!-- <form action="#"> -->
                            <div class="input-box">
                                <label class="label-text text-white"><?=T::enteremailaddress?></label>
                                <div class="form-group mb-0">
                                    <span class="la la-envelope form-icon"></span>
                                    <form role="search" onsubmit="return false;"></form>
                                    <input type="email" class="form-control sub_email" id="exampleInputEmail1" placeholder="Enter your email">
                                    <button class="theme-btn theme-btn-small submit-btn sub_newsletter" id="email_subscribe">Subscribe</button>
                                    <span class="font-size-14 pt-1 text-white-50"><i class="la la-lock mr-1"></i><?=T::dontworryyourinformationissafewithus?></span>
                                    <span class="font-size-14 pt-1"><!--<i class="la la-lock mr-1"></i>-->
                                    <a class="newstext" href="javascript:void(0);">
                                        <div class="wow fadeIn subscriberesponse"></div>
                                    </a>
                                    </span>
                                </div>
                            </div>
                        <!-- </form> -->
                    </div>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php } }  ?>


<div class=" padding-top-30px padding-bottom-20px">

</div>

<!--<section class="footer-area padding-top-10px padding-bottom-10px">-->
<section class="info-area padding-top-30px padding-bottom-20px bg-8"> <!--    bg-8-->
    <div class="container padding-top-20px"> <!--  border-top-dgray -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="term-box footer-item text-center">
                    <div class="footer-logo padding-bottom-10px">
                      <a href="<?=root;?>" class="foot__logo padding-right-40px"><img style="max-width: 150px;background:transparent" src="<?=api_url;?>uploads/global/logo.png" alt="logo"></a>
                    </div><!-- end logo -->
                </div>
            </div><!-- end col-lg-8 -->
        </div>
        
        
        <div class="row">
            <!--<div class="col-lg-3 responsive-column">-->
            <!--    <div class="footer-item">-->
            <!--        <div class="footer-logo padding-bottom-10px">-->
            <!--        <a href="<?=root;?>" class="foot__logo"><img style="max-width: 150px;background:transparent" src="<?=api_url;?>uploads/global/logo.png" alt="logo"></a>-->
            <!--        </div><!-- end logo -->
            <!--        <ul class="list-items pt-3">-->
            <!--          <li><strong> <?=$app->app->phone?> </strong></li>-->
            <!--          <li><strong><a href="mailto:<?=$app->app->email?>"><?=$app->app->email?></a></strong></li>-->
            <!--          <li><a href="<?=root?>contact"><strong><?=T::contactus?></strong></a></li>-->
            <!--        </ul>-->
            <!--    </div><!-- end footer-item -->
            <!--</div><!-- end col-lg-3 -->
            
            
            <div class="col-lg-12 responsive-column align-items-center footer-section_links">
                    <ul class="foot_menu w-100 align-items-center text-center ">
                        <li class="footm align-items-center text-center">
                          <a href="<?=root?>about-us" class="btn-text waves-effect"><?=T::cms_about?></a>
                        </li>
                         <li class="footm align-items-center text-center"> <!-- border-rightc padding-right-5px border-leftc padding-left-5px -->
                          <a href="<?=root?>terms-of-use" class="btn-text waves-effect"><?=T::cms_terms?></a>
                        </li>
                         <li class="footm align-items-center text-center"> <!-- border-rightc  padding-right-5px-->
                          <a href="<?=root?>privacy-policy" class="btn-text waves-effect"><?=T::cms_policy?></a>
                        </li>
                         <li class="footm align-items-center text-center">
                           <a href="<?=root?>contact" class="btn-text waves-effect"><?=T::contactus?></a>
                        </li>
                     </ul>
            </div>  
            
            <!-- <div class="col-lg-12 responsive-column">-->
            <!--<ul class="foot_menu w-100">-->
            <!-- header manue -->
            <!--<?php foreach ($app->cms->footer as $key => $value) {
            foreach ($value as $k => $v) { ?>-->
            <!--<li class="footm">-->
            <!--    <?php if ($k == $v[0]->title){ ?>-->
            <!--        <a href="<?=$v[0]->href?>"><?= $k ?> <i class="la la-angle-down"></i></a>-->
            <!--    <?php  }?>-->
            <!--    <?php if (count($v) > 1) {?>-->
            <!--   <ul class="dropdown-menu-item">-->
            <!--<?php foreach ($v as $mk => $mv) { if ($mv->title != $k) {?>-->
            <!--<li><a  href="<?=$root;?><?= $mv->href ?>"><?= $mv->title ?></a>-->
            <!--</li> <?php }} ?> </ul> <?php } ?>-->
            <!-- </li> <?php } } ?>-->
            <!--</ul>-->
            <!--</div>-->
            
            
        </div><!-- end row -->
        <div class="row">
                <div class="col-lg-3 "></div>
                <div class="col-lg-6  padding-top-30px">
                    <div class="term-box footer-item text-center"> <!-- border-top-dgray -->
                        <ul class="list-items list--items align-items-center font-size-14 text-color-8">
                         <?=T::allrightsreservedby?> <?=$app->app->copyright?>
                         </ul>
                    </div>
                </div><!-- end col-lg-8 -->
                <div class="col-lg-3">
                    <img src="<?=apiurl;?>/app/themes/default/assets/img/payment-img2.png" class="img-fluid" alt="payment"></a>
                </div>
            
            
            <!-- <div class="col-lg-4">-->
            <!--    <div class="footer-social-box text-right">-->
            <!--        <ul class="social-profile">-->
                    <?php foreach ($app->social as $socials){ //if($socials->status == true){ ?>
            <!--        <li><a href="<?=$socials->social_link ?>" target="_blank"><i class="lab la-<?=strtolower($socials->social_name)?>"></i></a></li>-->
            <!--        <?php } ?>-->
            <!--       </ul>-->
            <!--    </div>-->
            <!--</div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <!--<div class="section-block mt-4"></div>-->
    <!--<div class="container">-->
    <!--    <div class="row align-items-center">-->
    <!--        <div class="col-lg-12">-->
                <!--<div class="copy-right-content d-flex align-items-center justify-content-end padding-top-30px">-->
                    <!--<h3 class="font-size-15" style="width:100%">-->
                    <!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->
                    <!--<div class="d-none d-md-block" style="padding:0px;position:relative">-->
                    <!--<div class="container">-->
                    <!--<div class="text-center">Powered by &nbsp;<a href="http://www.phptravels.com" target="_blank"> <img src="<?=api_url;?>uploads/global/phptravels.png" style="height:22px;display: inline-block; -webkit-transform: translateY(0px);transform: translateY(0px);" height="22" alt="PHPTRAVELS"> <strong>&nbsp;PHPTRAVELS</strong></a></div>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!-- ********************   Removing powered by linkback will result to cancellation of your support service.    ********************  -->
                    <!--</h3>-->
                    <!--<img src="<?=root;?><?=theme_url;?>assets/img/payment-img.png" alt="">-->
                <!--</div><!-- end copy-right-content -->
    <!--        </div><!-- end col-lg-5 -->
    <!--    </div><!-- end row -->
    <!--</div><!-- end container -->
</section>

<?php if (dev == 1 ) {
include "dev.php";
} else {}; ?>

<?php if (!isset($_COOKIE["disclaimer"])){?>

<div id="cookie_disclaimer" data-wow-duration="0.5s" data-wow-delay="5s" role="dialog" class="wow  fadein_ fadeIn cc-window cc-banner cc-type-info cc-theme-block cc-color-override--1961008818">
<div class="container">
<div class="cookies_bg">
<span id="cookieconsent:desc" class="cc-message"><?=T::thiswebsiteusescookies?> <a aria-label="learn more about cookies" role="button" tabindex="0" class="cc-link" href="<?=root;?>cookies-policy" rel="noopener noreferrer nofollow" target="_blank"><?=T::learnmore?></a></span>
<div class="cc-compliance text-right float-right">
<button class="cc-btn cc-dismiss" id="cookie_stop"><?=T::gotit?></button></div>
</div>
</div>
</div>

<?php }?>

<script type="text/javascript">
$(function(){
     $('#cookie_stop').click(function(){
        $('#cookie_disclaimer').slideUp();
        var nDays = 999;
        var cookieName = "disclaimer";
        var cookieValue = "true";
        var today = new Date();
        var expire = new Date();
        expire.setTime(today.getTime() + 3600000*24*nDays);
        document.cookie = cookieName+"="+escape(cookieValue)+";expires="+expire.toGMTString()+";path=/";
     });

});
</script>

<!-- javascript resouces and libs -->
<script src="<?=root?><?=theme_url?>assets/js/jquery-ui.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/moment.min.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/owl.carousel.min.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/jquery.fancybox.min.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/jquery.countTo.min.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/animated-headline.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/quantity-input.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/select2.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/main.js"></script>
<script src="<?=root?><?=theme_url?>assets/js/app.js"></script>

<script>
// homepage tab rearrange and make first one active default
$(".listitems li").sort(sort_li).appendTo('.listitems'); function sort_li(a, b) { return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;};
$('.nav-tabs .nav-item:first-child button').addClass('active');
$('.search_tabs .tab-pane:first-child').addClass('show active');

// select 2 location init for hotels search 
var $ajax = $(".city");
function formatRepo(t) {  return t.loading ? t.text : (console.log(t), '<i class="flag ' + t.icon.toLowerCase() + '"></i>' + t.text) }
function formatRepoSelection(t) { return t.text }
$ajax.select2({
    ajax: {
        url: "<?php echo $root; ?>hotels_locations",
        dataType: "json",
        data: function(t) {
            return {
                q: $.trim(t.term)
            }
        },
        processResults: function(t) {
            var e = [];
            return t.forEach(function(t) {
                e.push({
                    id: t.id,
                    text: t.text,
                    icon: t.icon
                })
            }), console.log(e), {
                results: e
            }
        },
        cache: !0
    },
    escapeMarkup: function(t) {
        return t
    },
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
    dropdownPosition: 'below',
    cache: !0
});
</script>

<script>
$('.select_').select2({ placeholder: { id: '1', text: 'Select Category' } });
$('.select2-container').css('width','100%')
$('#select').select2({ placeholder: { id: '1', text: 'Select Category' } });

$('#email_subscribe').click(function() { 
    let S_email = $('#exampleInputEmail1').val();
        if(S_email != 0)
        {
            if(isValidEmailAddress(S_email))
            {$.ajax({type: "GET",
                url: "<?php echo $root; ?>subscribe",
                data: {S_email:S_email},
                success: function(response)
                {res= JSON.parse(response);
                if (res.error) {
                $('.wow').text("<?=T::newsletter_empty?>");
                $(".newstext").fadeIn(3000);$(".newstext").fadeOut(3000);
                }else{if(res.status == true){
                $('.wow').text("<?=T::newsletter_true?>");
                $(".newstext").fadeIn(3000);$(".newstext").fadeOut(3000);
                $('#exampleInputEmail1').val('');
                }else{
                $('.wow').text("<?=T::newsletter_false?>");
                $(".newstext").fadeIn(3000);$(".newstext").fadeOut(3000);
                $('#exampleInputEmail1').val('');}}}
                });
            } else {
            $('.wow').text("<?=T::email_correct?>");
            $(".newstext").fadeIn(3000);$(".newstext").fadeOut(3000);
            }
        } else {
            $('.wow').text("<?=T::newsletter_empty?>");
            $(".newstext").fadeIn(3000);$(".newstext").fadeOut(3000);}
    });

function isValidEmailAddress(emailAddress) {
var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}

</script>

</body>
</html>