<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=gmkey?>&libraries=places"></script>-->


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLc1GoviLELroFYgNAOP7MVZPCNI3MnZo&libraries=places"></script>


<script src="<?=root.theme_url?>assets/js/mixitup.min.js"></script>
<script src="<?=root.theme_url?>assets/js/mixitup-pagination.min.js"></script>
<script src="<?=root.theme_url?>assets/js/mixitup-multifilter.min.js"></script>
<script src="<?=root.theme_url?>assets/js/plugins/ion.rangeSlider.min.js"></script>


<?php  foreach ($city_loc_data as $k => $i) { 

 $loc_country = $i->country;
 $loc_city = $i->city;
 $loc_latitude = $i->latitude;
 $loc_longitude = $i->longitude;

}
?>

<?php $nights = round($nights / (60 * 60 * 24)); ?>


<div class="mobileHide" id="myDIV">
    <div class="modify_search">
      <div class="container">
        <?php include 'search.php';?>
      </div>
    </div>
</div>


<script>

$(document).ready(function(){
 $("#sMobile").click(function(){
    $("#arrow-fff").toggleClass("la-angle-up ml-1");
    $("#myDIV").toggle("slow");
  });
});


</script>

<div class="mobileShow" id="myDIV">
<a id="sMobile" class=" btn collapse-btn theme-btn-hover-gray text-center align-items-center font-size-15 border bg-8" style="width:100%;">
 <div class=" text-center align-items-center" id="MobileSearch bg-1">
                <div class="text-center align-items-center">
                     <p class="font-size-14">
                          ( <?=$loc_city?> ) - 
                         <strong><?=$nights?> <?= T::hotels_nights ?> </strong>( <?=$checkin?> - <?=$checkout?> )
                     </p> 
                     <p class="font-size-14">  
                       for 
                         <strong><?=$adults?></strong> <?= T::hotels_adults ?> <strong><?=$childs?></strong> <?= T::hotels_childs ?>    
                     </p>
    </div>
</div><span style="color:red">Modify Search </span><i id="arrow-fff" class="la la-angle-down ml-1" style="color:red"></i></a>
</div>

<script>
    $(document).ready(function(){
     $("#BtnadvanceFilter").click(function(){
        $("#fadein2").toggleClass('d-none');
      });
    });
</script>

<div class="mobileShow">
     <div class="container align-items-center text-center">
         <div class="main_search contact-form-action align-items-center" style="background:#ededed;">
              <div class="row g-1 align-items-center">
                   <div class="col-md-12 align-items-center">
                     <div class="input-wrapper align-items-center">
                             <!--<button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#searchArea">-->
                              <button class="btn btn-outline-dark" id="BtnadvanceFilter">
                                 Sort & Filter
                             </button>
                    
                            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#map">
                             <i class="las la-map-marker"></i> View on Map
                            </button>
                      </div>
                   </div>
              </div>
            </div>
    </div>
</div>

<?php if ( empty($hotels_data) ) { ?>
<div class="container text-center">
  <img src="<?=root?><?=theme_url?>assets/img/no_results.gif" alt="no results" />
</div>
<?php } else { ?>


<!-- feras map fade  --> 
    <div class="modal fade" id="map" tabindex="-1" aria-labelledby="map" aria-hidden="true"> 
      <div class="modal-dialog container">
        <div class="modal-content" >
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?=T::hotels_hotelsonmap?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="map-canvas" style="height:400px">
               <div id="map123" class="mapMob"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<!-- feras map fade  --> 







<!--    start search feras    -->

<section>
  <div class="cd-main-content container mt-4">
    <!-- end row -->
    <div class="row">
     <div class="col-md-3 d-none d-sm-block" id="fadein2"> <!-- feras changes --> 
       <div class="">
        
 
 <!-- Feras Map -->
 <style>
  .mapMob {
       height: 100%;
       width: 100%;
   }
  .label {
       color: #000;
       background-color: white;
       border: 1px solid #000;
       font-family: "Lucida Grande", "Arial", sans-serif;
       font-size: 13px;
       text-align: center;
       white-space: nowrap;
       border-radius: 4px;
       padding: 2px;
   }
      
 .mapDesk {
    width:100%;
     height:80px;
    }
    
 .modal-dialog {
      max-width: 95%; 
      max-height: 100%;
    }
        
</style>
 
 <?php 

 $datalocpp = ''; $datalocview=''; $datalocviewElement=''; $dataListing =''; 
foreach ($hotels_data as $index => $item) {
  if (empty($item->city_code)) {
     $item->city_code = "0"; 
  }
  
  if (empty($item->country_code)) {
     $item->country_code = "0"; 
  }
  
  $link = root.$session_lang.'/'.strtolower($currency).'/hotel/'.strtolower(str_replace(' ', '-', $city)).'/'.strtolower(str_replace(" ", "-", $item->name)).'/'.$item->hotel_id.'/'.$checkin.'/'.$checkout.'/'.$rooms.'/'.$adults.'/'.$childs.'/'.$item->supplier.'/'.$nationality.'/'.strtoupper($item->country_code).'/'.$item->city_code.'/';
  if ($item->img == "http://test.xmlhub.com/images/noimage.gif") {
    $img = root."app/themes/default/assets/img/data/hotel.jpg";
  } else { 
    $img = $item->img;
  }
    
    if (!file_exists($img)) {
      $hotel_img = $img; 
    } else {
      $hotel_img = root."app/themes/default/assets/img/data/hotel.jpg";
    }
            
    if(isset($_SESSION["user_type"])) 
    { 
        if ($_SESSION["user_type"] == "agent") { 
            $selling_price =  $item->b2b_price;
          }
        else {
          $selling_price = $item->b2c_price;  
          }
    }      
    if (!isset($_SESSION["user_type"])) {
    $selling_price =  $item->b2c_price;
    }

$discountview = '';
$stars = '';
$acutal_price = '';
$discountview2 = '';

$i1 = 0;

for ($i = 1; $i <= $item->stars; $i++) { 
 $stars .= '<div class="stars la la-star"></div>';
 
 $i1 = $i1+1;
  } 
  
for ($n = $i1; $n < 5; $n++) { 
          $stars .= '<div class="stars la la-star-o"></div>';
     }
  

 if (!empty($item->discount)){
     $discountview ='<span class="badge badge-success mt-2 font-size-13 btn-block">'.T::discounts.' '.$item->discount.'%</span>';
     $discountview3 ='<p class="card-meta font-size-13 badge badge-success">'.T::discounts.' '.$item->discount.'%</p>';
     //$selling_price1 = number_format($selling_price*((100-$item->discount)/100),2);
     $selling_price1 = number_format($selling_price*((100+$item->discount)/100),2);
   if(!empty($item->discount) > 0)
   {
    $acutal_price = '<del class="del">'.$selling_price1.'</del>'; 
    $discountview2 = ' <span class="badgeSee">'.T::discounts.'</span>';
   }
} else {
    $discountview3 ='<p class="card-meta font-size-13 badge badge-warning">Standard</p>';
    $selling_price1 =  number_format($selling_price,2);
}

$dataListing .= '
<li class="mix stars_'.$item->stars.' hotels_amenities_" data-a="'.$item->price.'" data-b="" id="'.strtolower($item->name).'"  data-published-date="'.$selling_price1.'">
<a href="'.$link.'" style="text-decoration: none;">
<div class="card-item card-item-list border">
                    <div class="card-img">
                       <img src='.$hotel_img.' alt="hotel-img">
                      '.$discountview2.'
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                             <h3 class="card-title font-weight-bold font-size-18">'.$item->name.'</h3>
                        </div>
                         <div class="col-lg-12">
                              <p class="card-meta font-size-13" style="color:#444444;">'.$item->address.'</p>
                        </div>
                        <div class="col-lg-12">
                             <label class="custom-control-label" for="stars_2">
                              '.$stars.'
                              </label>
                        </div>
                        <div class="col-lg-12">
                            '.$discountview3.'
                        </div>
                        <div class="col-lg-12 text-right" style=" position: absolute; bottom: 0; right: 0;">
                           <p>
                            <span class="text-right">
                                     '.$acutal_price.'
                                       <ins class="ins">
                                        '.number_format($selling_price,2).'  <span  style="font-size: 14px">'.$currency.'</span>
                                      </ins>
                            </span>
                          </p>    
                        </div>
                    </div>
                </div>
            </a>
        </li>';
 
 $datalocviewElement = '<a href="'.$link.'" style="color:#000">
                          <div  class="col-lg-12">       
                                <div class="card-item-list">
                                     <div class="card-img align-items-center text-center">
                                      <img src="'.$hotel_img.'" class="img-fluid align-items-center text-center" alt="hotel-img" style="max-width:auto; max-height:90px;">
                                     </div>
                                    <div class="card-body">
                                         <h6 class="card-title">'.$item->name.'</h6>
                                         <div class="card-rating">
                                            <span class="review__text">'.$stars.'</span>
                                        </div>
                                        <div class="card-price d-flex align-items-center justify-content-between">
                                            <p>'. $discountview.'
                                                '.$acutal_price.' <span class="price__num font-size-14 font-weight-bold">'.$currency.' '.$selling_price1.'</span>
                                                <span class="price__text">for '.$nights.' night</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </a>';   
 
 $datalocpp .= "['".$selling_price1.' '.$currency."',".$item->latitude.",".$item->longitude.","."'orignal'"."]," ;
 
 $datalocview .=  "['". trim(preg_replace('/\s\s+/', ' ',$datalocviewElement))."'],";
 
 } ?>

<script src="https://cdn.sobekrepository.org/includes/gmaps-markerwithlabel/1.9.1/gmaps-markerwithlabel-1.9.1.js" type="text/javascript"></script>
     
<script>



     function initMap() {
       var bp = {lat: <?=$loc_latitude?>, lng: <?=$loc_longitude?>};
       var map = new google.maps.Map(document.getElementById('map123'), {
         zoom: 11,
         center: bp,
         gestureHandling: "greedy",
       });
       
                   
var locations = [<?=$datalocpp?>];
var infoWindowContent = [<?=$datalocview?>];


var icons = {
         'green': {
           url: 'https://goo.gl/qvLZ4R',
           color: '#58D400'
         },
         'orignal': {
            url: 'https://goo.gl/qvLZ4R',
            color: '#000'
            },
         'yellow': {
           url: 'https://goo.gl/G6HyHS',
           color: '#FCCA00'
         },
         'red': {
           url: 'https://goo.gl/6hkqX1',
           color: '#D80027'
         },
         'turquoise': {
           url: 'https://goo.gl/uLRpYZ',
           color: '#00D9D2'
         },
         'brown': {
           url: 'https://goo.gl/XTosFM',
           color: '#BF5300'
         }
       };

   var image = 'https://goo.gl/dqvvFA';

    // Add multiple markers to map
   var infoWindow = new google.maps.InfoWindow(), marker, i;
        
       for (var i = 0; i < locations.length; i++) {
         var item = locations[i];
         var marker = new MarkerWithLabel({
           position: {lat: item[1], lng: item[2]},
           map: map,
           icon: icons[item[3]].url,
           labelContent: item[0],
           labelAnchor: new google.maps.Point(item[4], item[5]),
           // the CSS class for the label
           labelClass: "label " + item[3],
           labelInBackground: true,
           gestureHandling: "greedy",
         });
                // Add info window to marker    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                      return function() {
                                          infoWindow.setContent(infoWindowContent[i][0]);
                                          infoWindow.open(map, marker);
                      } 
                  })(marker, i));
                  // Center the map to fit all markers on the screen
            // map.fitBounds(bounds);
       }
     }

     initMap();

    </script>






<!-- feras test search fade  --> 
    <!--<div class="modal fade" id="searchme" tabindex="-1" aria-labelledby="searchme" aria-hidden="false"> -->
    <!--  <div class="modal-dialog container">-->
    <!--    <div class="modal-content" >-->
    <!--      <div class="modal-header">-->
    <!--        <h5 class="modal-title" id="exampleModalLabel">Search</h5>-->
    <!--        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--      </div>-->
    <!--      <div class="modal-body">-->
         
    <!--          Ferassssss-->
       
    <!--      </div>-->
    <!--      <div class="modal-footer">-->
    <!--        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
<!-- feras test search fade  --> 




    <div class="col-md-12 bg-white" style="padding-bottom:10px;">    
        <div class="card-header_map2 align-items-center text-center d-none d-sm-block">
            <a class="align-items-center text-center">
               <button class="btn btn-outline-dark btn-block" data-bs-toggle="modal" data-bs-target="#map">
                  View on Map
               </button>
            </a>
        </div> 
     </div>    
     
     

     <div class="col-md-12" id="fadein" style="padding-bottom:10px;"> 
        <div class="sidebar mt-0"> 
          <div class="sidebar-widget controls">
            <form>
              <div class="sidebar-box mb-4">
                  
                  
                  <div class="sidebar-widget" style="padding-bottom:5px;">
                    <div class="input-box">
                        <div class="sidebar-widget">
                             <h6 class="title stroke-shape font-size-14" style="text-transform:capitalize;">Sorting by</h6>
                             <div class="gap"></div>
                             <button type="button" class="font-size-13 badge badge-secondary" style="border:0px; color:#000;" data-sort="published-date:asc">Low Price</button>
                             <button type="button" class="font-size-13 badge badge-secondary" style="border:0px; color:#000;" data-sort="published-date:desc">High price</button>
                        </div>
                    </div>
                 </div>
                  
                  
                  
                 <div class="sidebar-widget" style="padding-bottom:5px;">
                    <div class="input-box">
                        <div class="sidebar-widget" data-filter-group>
                             <input type="text" class="form-control" placeholder="<?=T::hotels_hotelname?>" value="" data-search-attribute="id" />
                        </div>
                    </div>
                 </div>

             <div class="sidebar-widget">
                   <div class="input-box">
                        <h3 class="title stroke-shape text-black" style="text-transform:capitalize"><?=T::stargrade?></h3>
                        <ul class="list remove_duplication" data-filter-group>
                          <li>
                            <div class="custom-checkbox">
                              <input class="filter" type="checkbox" id="stars_1" value=".stars_1">
                              <label class="ratings" for="stars_1">
                                <span class="color-text-3 font-size-13 ml-1">1</span> &nbsp;
                                <span class="stars la la-star"></span>
                                <div class="stars la la-star-o"></div>
                                <div class="stars la la-star-o"></div>
                                <div class="stars la la-star-o"></div>
                                <div class="stars la la-star-o"></div>
                              </label>
                            </div>
                          </li>
                           <!--2 stars -->
                          <li>
                            <div class="custom-checkbox">
                              <input class="filter" type="checkbox" id="stars_2" value=".stars_2">
                              <label class="custom-control-label" for="stars_2">
                                <span class="color-text-3 font-size-13 ml-1">2</span> &nbsp;
                                <span class="stars la la-star"></span>
                                <span class="stars la la-star"></span>
                                <div class="stars la la-star-o"></div>
                                <div class="stars la la-star-o"></div>
                                <div class="stars la la-star-o"></div>
                              </label>
                            </div>
                          </li>
                           <!--3 stars -->
                          <li>
                            <div class="custom-checkbox">
                              <input class="filter" type="checkbox" id="stars_3" value=".stars_3">
                              <label class="custom-control-label" for="stars_3">
                               <span class="color-text-3 font-size-13 ml-1">3</span> &nbsp;
                                <span class="stars la la-star"></span>
                                <span class="stars la la-star"></span>
                                <span class="stars la la-star"></span>
                                <div class="stars la la-star-o"></div>
                                <div class="stars la la-star-o"></div>
                              </label>
                            </div>
                          </li>
                           <!--4 stars -->
                          <li>
                            <div class="custom-checkbox">
                              <input class="filter" type="checkbox" id="stars_4" value=".stars_4">
                              <label class="custom-control-label" for="stars_4">
                               <span class="color-text-3 font-size-13 ml-1">4</span> &nbsp;
                                <span class="stars la la-star"></span>
                                <span class="stars la la-star"></span>
                                <span class="stars la la-star"></span>
                                <span class="stars la la-star"></span>
                                <div class="stars la la-star-o"></div>
                              </label>
                            </div>
                          </li>
                           <!--5 stars -->
                          <li>
                            <div class="custom-checkbox">
                              <input class="filter" type="checkbox" id="stars_5" value=".stars_5">
                              <label class="custom-control-label" for="stars_5">
                              <span class="color-text-3 font-size-13 ml-1">5</span> &nbsp;
                              <span class="stars la la-star"></span>
                              <span class="stars la la-star"></span>
                              <span class="stars la la-star"></span>
                              <span class="stars la la-star"></span>
                              <span class="stars la la-star"></span>
                              </label>
                            </div>
                          </li>
                        </ul>
                      </div>
                </div>
                    <div class="sidebar-price-range">
                          <div class="main-search-input-item">
                                 <div class="range-sliderrr">
                                    <input type="text" class="js-range-slider" data-ref="range-slider-a" value="" />
                                 </div>
                                 <div class="range-sliderrr" style="display:none">
                                    <input type="text" class="js-range-slider" data-ref="range-slider-b" value="" />
                                 </div>
                          </div>
                    </div>
              </div>
              <div class="sidebar-widget">
                <h3 class="title stroke-shape">Featured</h3>
                <ul class="list remove_duplication" data-filter-group>
                  <li>
                    <div class="custom-checkbox">
                      <input class="filter" type="checkbox" id="Room_withoutbreakfest" value="1">
                      <label class="custom-control-label" for="Room_withoutbreakfest"><strong>Without Breackfast</strong>
                      </label>
                    </div>
                  </li>
                   <li>
                    <div class="custom-checkbox">
                      <input class="filter" type="checkbox" id="Room_breakfest" value="2">
                      <label class="custom-control-label" for="Room_breakfest"><strong>With Breackfast</strong>
                      </label>
                    </div>
                  </li>
                   <li>
                    <div class="custom-checkbox">
                      <input class="filter" type="checkbox" id="Room_halfboard" value="">
                      <label class="custom-control-label" for="Room_halfboard"><strong>Half Board</strong>
                      </label>
                    </div>
                  </li>
                </ul>
                  <!--<button type="button" data-sort="price:asc">Ascending</button>-->
              </div>
            </form>
          </div>
        </div>
      </div>
      
      
     </div>
    </div>  


<!-- Feras Start list -->
      <!-- end col-lg-4 -->
      <div class="col-lg-9" id="markers">

    <div class="col-lg-12">
         <p class="font-size-14">
             <i class="la la-hotel">
             </i> <?= T::total?> 
             <strong><?= count($hotels_data)?></strong>  
             <?= T::hotels_hotelsin?> <?=$city?>
         </p>
         <p class="font-size-14"><strong><?=$nights?> <?= T::hotels_nights ?> </strong>( <?=$checkin?> - <?=$checkout?> )</p>
   </div>

      <?= signupdeals();?>
      
        <section data-ref="container" id="data">
          <ul>
           <?=$dataListing?>
           
            <li class="gap"></li>
            <li class="gap"></li>
            <li class="gap"></li>
          </ul>
            <div class="controls-pagination">
            <div class="mixitup-page-list"></div>
            <div class="mixitup-page-stats"></div>
            </div>
           <p class="fail-message"><i class="las la-info-circle"></i> <strong><?=T::noresultsfound?></strong></p>
        </section>
      </div>
    </div>
  </div>
   <br/>
</section>
 <br/>

<script>
// remove dupicate contents
var seen = {};
$(".remove_duplication").find("li").each(function(index, html_obj) { txt = $(this).text().toLowerCase();
if(seen[txt]) { $(this).remove(); } else { seen[txt] = true; } });

// price range and filteration
var $rangeA = $('[data-ref="range-slider-a"]');
var $rangeB = $('[data-ref="range-slider-b"]');

$rangeA.ionRangeSlider({
    skin: "round",
    type: "double",
    // min : <?php foreach ($hotels_data as $index => $item) {$result[$index] = $item->price;} echo $min_price = min($result); ?>,
    // max:  <?php foreach ($hotels_data as $index => $item) {$result[$index] = $item->price;} echo $min_price = max($result); ?>,
    // from: <?php foreach ($hotels_data as $index => $item) {$result[$index] = $item->price;} echo $min_price = min($result); ?>,
    // to:   <?php foreach ($hotels_data as $index => $item) {$result[$index] = $item->price;} echo $min_price = max($result); ?>,
    min: 0,
    max: <?php foreach ($hotels_data as $index => $item) {$result[$index] = $item->price;} echo $min_price = max($result); ?>,
    from: 0,
    to: <?php foreach ($hotels_data as $index => $item) {$result[$index] = $item->price;} echo $min_price = max($result); ?>,
    onChange: handleRangeInputChange
    
});

$rangeB.ionRangeSlider({
    skin: "round",
    type: "double",
    min: 0,
    max: 10,
    from: 0,
    to: 10,
    onChange: handleRangeInputChange
});

var instanceA = $rangeA.data("ionRangeSlider");
var instanceB = $rangeB.data("ionRangeSlider");

var container = document.querySelector('[data-ref="container"]');
var mixer = mixitup(container, {
    animation: { duration: 350, queueLimit: 10, effectsIn: 'fade translateY(-100%)' },
    pagination: { limit: 25 },
    multifilter: { enable: true  },
    callbacks: {
    onMixStart: function(){ $('.fail-message').fadeOut(0); $('.controls-pagination').css('display','block'); },
    onMixFail: function(){ $('.fail-message').fadeIn(0); $('.controls-pagination').css('display','none'); },
    onMixEnd: function(state) { paginationCallback();  }
    },
});


var mixer = mixitup(container, {
    load: {
        sort: 'published-date:desc'
    }
});


// to scroll up on data content
function paginationCallback() { $("body,html").animate({ scrollTop: $("#data").offset().top - 80  }, 10); }

function getRange() {
    var aMin = Number(instanceA.result.from);
    var aMax = Number(instanceA.result.to);
    var bMin = Number(instanceB.result.from);
    var bMax = Number(instanceB.result.to);
    return {
        aMin: aMin,
        aMax: aMax,
        bMin: bMin,
        bMax: bMax,
    };
}

function handleRangeInputChange() {
    mixer.filter(mixer.getState().activeFilter);
}

function filterTestResult(result, target) {
    var a = Number(target.dom.el.getAttribute('data-a'));
    var b = Number(target.dom.el.getAttribute('data-b'));
    var range = getRange();

    console.log(range);

    if (a < range.aMin || a > range.aMax || b < range.bMin || b > range.bMax) {
        result = false;
    }
    return result;
}

mixitup.Mixer.registerFilter('testResultEvaluateHideShow', 'range', filterTestResult);

/*
fetch('https://yasen.hotellook.com/autocomplete?term=lahore')
    .then(response => {
        // handle the response
        console.log(response->cities)
    })
    .catch(error => {
        // handle the error
    });

let citylonglat = fetch('');
*/
</script>
<?php } ?>