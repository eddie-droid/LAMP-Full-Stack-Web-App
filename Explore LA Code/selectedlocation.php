<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Wed Nov 30 2022 08:05:05 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="636af04d285d5e1ecc5db2a3" data-wf-site="634669433bd62dda63db2c61">
<head>
  <meta charset="utf-8">
  <title>SelectedLocation</title>
  <meta content="SelectedLocation" property="og:title">
  <meta content="SelectedLocation" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/explore-la-web-app.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Bitter:400,700,400italic","Oswald:200,300,400,500,600,700","Crimson Text:regular,italic,600,600italic,700,700italic","Quicksand:300,regular,500,600,700"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon"><!--  Latest compiled and minified CSS  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!--  jQuery library  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--  Latest compiled JavaScript  -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
   
</head>
<body class="body-4">
  <div class="w-embed">
    <style>
    a {
  text-decoration: none; 
}

.body-4, .tabs-menu-wrapper{
  width: 100%;
  align-items: center;
  justify-content: center;
  background-size: 300% 300%;
  background-image: linear-gradient(-45deg, #fc9c54 0%, #F4C045 25%, #5D9C51 51%, #53B9D0 100%);
  -webkit-animation: AnimateBG 15s ease infinite;
          animation: AnimateBG 15s ease infinite;
}
@-webkit-keyframes AnimateBG {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
@keyframes AnimateBG {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}
</style>
  </div>
  <div class="hero wf-section">
    <div data-collapse="none" data-animation="default" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="nav-bar w-nav">
      <div class="w-container">
        <a href="explorela.html" class="brand-link w-nav-brand">
          <h1 class="logo">EXPLORE LA</h1>
        </a>
        <nav role="navigation" data-w-id="c585de43-5964-e213-392f-6dcb0283a5ec" class="nav-menu w-nav-menu">
          <a href="likedlocations.php" class="navbar-icon navbar-map-icon w-inline-block">
            <div class="div-block"><img src="images/heart-svgrepo-com-2-1.svg" loading="lazy" alt="" class="image"></div>
          </a>
          <a href="#" class="nav-link hide w-nav-link">My Locations</a>
        </nav>
        <div class="menu-button w-nav-button">
          <div class="menu-text hide">MENU</div>
          <a href="#" class="w-inline-block"><img src="images/map-icon.svg" loading="lazy" alt="" class="image-6"></a>
          <a href="#" class="w-inline-block"><img src="images/heart-svgrepo-com-1.svg" loading="lazy" alt="" class="image-6"></a>
          <div class="menu-icon hide w-icon-nav-menu"></div>
        </div>
      </div>
    </div>








<?php

$conn=mysqli_connect("localhost","u330436780_eddievaldez200","a+qxcxh9w#%tP","u330436780_ExploreLA");
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
  //echo "Failed!";
}else{
  //echo "Connected Succesfully <br>";
}


//echo "POST(",json_encode($_POST),")<br>";
$PlaceID = $_GET['PlaceID'];
$sql = "SELECT * FROM `Locations` WHERE  `Place ID` LIKE '%".$PlaceID."%' " ;

$result= mysqli_query($conn, $sql);
    



while($row = $result->fetch_array()){
  $Categories = $row["Categories"];
  $Name = $row["Name"];
  $Rating = $row["Rating"];
  $Types = $row["Types"];
  $Lat = $row["Latitude"];
  $Lng = $row["Longitude"];
  $Summary = $row["Summary"];
  $TotalReviews = $row["Total Reviews"];
  $Website = $row["Website"];
  $Phone = $row["Phone Number"];
  $Total = $row["Total Reviews"];

}
    

echo'<div data-w-id="af7e569e-793e-bde2-1e09-6499a999dce1" style="opacity:0" class="div-block-15 search locationview selectedlocation">
      <div class="div-block-27">
        <div class="div-block-52">';
        
        
        
                             

$LikedLocationsArray =  json_decode($_COOKIE["LikedLocationsArray"], true);
echo $LikedLocationsArray;

$Color = "#DCDCDC";
foreach($LikedLocationsArray AS $IndividualLikedLocationID){
  echo $IndividualLikedLocationID, " ";
  if ($IndividualLikedLocationID == $PlaceID){
      $Color = "#FF69B4";
  }
}

                      
          echo'<a style="background-color:'.$Color.';" onclick="LikeButtonClicked'.$PlaceID.'()" data-w-id="63c9d831-4b45-da88-a047-cc7ccd9cc085" href="#" class="button-5 liked w-button"><span class="text-span-25"></span></a>
          
           <script>
                        
                      function LikeButtonClicked'.$PlaceID.'(){
                      var placeid = "'.$PlaceID.'";
                       console.log("PlaceID in Function: ",placeid );
                      console.log("Function ran");
                      if (JSON.parse(localStorage.getItem("LikedLocations")) == null){
                          var LikedLocations = [];
                          LikedLocations[0]= placeid;
                          console.log("No Liked Locations existed, new array created");
                          localStorage.setItem("LikedLocations", JSON.stringify(LikedLocations));
                      }
                      else{
                          var LikedLocationsList = JSON.parse(localStorage.getItem("LikedLocations"));
                          var alreadyLiked= LikedLocationsList.includes(placeid);
                          if (alreadyLiked == false){
                              LikedLocationsList.push(placeid);
                              localStorage.setItem("LikedLocations", JSON.stringify(LikedLocationsList));
                              console.log(placeid, "added to liked.");
                          }
                          else{
                              for( var i = 0; i < LikedLocationsList.length; i++){ 
    
                                 if ( LikedLocationsList[i] == placeid) { 
    
                                     LikedLocationsList.splice(i, 1); 
                                  }
    
                              }
                              localStorage.setItem("LikedLocations", JSON.stringify(LikedLocationsList));
                              console.log("Succesfully removed from liked");
                          }
                      }
                      
                      
                      }
            </script>
          
          
          
          
          <h1 class="heading-9">'.$Name.'</h1>
          <div class="text-block-34">'.$Categories.'</div>
        </div>
        <div class="div-block-59">
          <div class="div-block-39 result">
            <div data-w-id="63c9d831-4b45-da88-a047-cc7ccd9cc08d" class="div-block-40 rating">
              <div class="text-block-22">'.$Rating.' <span class="text-span-32"></span> | '.$Total.' Reviews </div>
            </div>
            <div id="Open" data-w-id="63c9d831-4b45-da88-a047-cc7ccd9cc093" class="div-block-22">
              <div class="text-block-12">Open <span class="icon"></span></div>
            </div>
            <div id="Closed" data-w-id="63c9d831-4b45-da88-a047-cc7ccd9cc098" class="div-block-22 closed">
              <div class="text-block-12">Closed <span class="icon"></span></div>
            </div>
            <div id="Distance" data-w-id="63c9d831-4b45-da88-a047-cc7ccd9cc09d" class="div-block-22 distance">
              <div class="text-block-12 distance"> <span class="text-span-33"> </span><span id="DistanceTxt"></span> away</div>
            </div>
          </div>
          <div class="text-block-35">Cost:<br> <span id = "cost1"class="text-span-37"></span><br></div>
        </div>
      </div>
      <div data-w-id="63c9d831-4b45-da88-a047-cc7ccd9cc073" style="opacity:0" class="div-block-21">
        <div class="div-block-31">
          <div data-delay="2000" data-animation="slide" class="slider-4 w-slider" data-autoplay="true" data-easing="ease-in-out" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="300" data-infinite="true">
            <div class="mask-3 w-slider-mask">';







$sql2 ="SELECT * FROM `Photos` WHERE `Place ID` LIKE '%".$PlaceID."%';";
$result2= mysqli_query($conn, $sql2);


while($row2 = $result2->fetch_array()){
  $PhotoID = $row2["Photo ID"];


echo'<div class="slide-3 w-slide">
                <a href="#" class="lightbox-link-2 w-inline-block w-lightbox"><img sizes="(max-width: 479px) 330.59375px, 638.65625px" src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyC24u6ihSWFCB89W-hi7rUSRFiIaEID-zI" loading="eager"  alt="" class="image-26 search-result">
                  <script type="application/json" class="w-json">{
  "items": [
    {
      "_id": "example_img",
      "origFileName": "photo0.jpeg",
      "fileName": "photo0.jpeg",
      "fileSize": 71414,
      "height": 366,
      "url": "https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyC24u6ihSWFCB89W-hi7rUSRFiIaEID-zI",
      "width": 550,
      "caption": "",
      "type": "image"
    }
  ],
  "group": "Photos"
}</script>
                </a>
              </div>';}

echo'</div>
            <div class="w-slider-arrow-left">
              <div class="icon-6 w-icon-slider-left"></div>
            </div>
            <div class="w-slider-arrow-right">
              <div class="icon-7 w-icon-slider-right"></div>
            </div>
            <div class="slide-nav w-slider-nav w-shadow w-round"></div>
          </div>
        </div>
      </div>
      
      <div class="div-block-30">
        <div class="div-block-27">
          <div class="div-block-57">
            <div class="div-block-24">
              <a href="tel:'.$Phone.'" class="w-inline-block">
                <div class="div-block-23">
                  <div class="text-block-13">Call <span class="text-span-9 icon"></span></div>
                </div>
              </a>
              <a href="'.$Website.'" target="_blank" class="w-inline-block">
                <div class="div-block-23 website">
                  <div class="text-block-14">Website <span class="icon"></span></div>
                </div>
              </a>
              <div class="wg-element desktop">
                <div class="wg-element-wrapper sw6">
                  <div data-hover="false" data-delay="0" data-w-id="e635f7be-b544-cc04-6e75-870203d553c9" class="wg-dropdown-1 w-dropdown">
                    <div lang="en" class="wg-dd-1-togle w-dropdown-toggle">
                      <div class="wg-selector-text-wrapper">
                        <div class="wg-left-side">
                          <div class="wg-flag"><img src="images/map-svgrepo-com-3.svg" loading="eager" alt="" class="wg-flag-icon"></div>
                          <div class="text-block-24">Directions  <span class="text-span-28"></span></div>
                        </div>
                      </div>
                    </div>
                    <nav style="display:none;opacity:0" class="wg-dd-1-list wg-dropdown-link-flag w-dropdown-list">
                      <div class="wg-dropdown-list">
                        <a lang="es" href="http://maps.apple.com/?q='.$Lat.','.$Lng.'" class="wg-dropdown-1-link w-inline-block">
                          <div class="wg-selector-text-wrapper">
                            <div class="wg-left-side hover">
                              <div class="wg-flag dropdownimg"><img src="images/google-maps_318-326114.jpg.webp" loading="eager" srcset="images/google-maps_318-326114.jpg-p-500.webp 500w, images/google-maps_318-326114.jpg.webp 512w" sizes="100vw" alt="" class="wg-flag-icon"></div>
                              <div class="text-block-37">Google Maps</div>
                            </div>
                          </div>
                        </a>
                        <a lang="es" href="http://maps.apple.com/?q='.$Lat.','.$Lng.'" class="wg-dropdown-1-link w-inline-block">
                          <div class="wg-selector-text-wrapper">
                            <div class="wg-left-side hover">
                              <div class="wg-flag dropdownimg"><img src="images/intro_icon__dfyvjc1ohbcm_large.png" loading="eager" alt="" class="wg-flag-icon"></div>
                              <div>Apple Maps</div>
                            </div>
                          </div>
                        </a>
                        <a lang="es" href="http://maps.apple.com/?q='.$Lat.','.$Lng.'"class="wg-dropdown-1-link w-inline-block">
                          <div class="wg-selector-text-wrapper">
                            <div class="wg-left-side hover last">
                              <div class="wg-flag dropdownimg"><img src="images/106509898_10157557647002634_3090773399820746290_n.jpg" loading="eager" alt="" class="wg-flag-icon"></div>
                              <div>Waze </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </nav>
                  </div>
                </div>
                <div class="wg-code w-embed"></div>
              </div>
            </div>
          </div>
          <div class="div-block-25">
            <div class="div-block-58">
              <h2 class="heading-5 things-to-do">Summary:</h2>
              <p class="paragraph-6">'.$Summary.'</p>
            </div>
            <div class="div-block-29 _50p">
              <div class="div-block-38">
                <h2 class="heading-5 things-to-do">Things to do here:</h2>
                <p class="paragraph-6">Picnics, Sightseeing, Hikes, Run, Birdwatching</p>
              </div>
            </div>
          </div>
        </div>
        <div class="first-example-with-background">
          <div data-current="Tab 1" data-easing="ease" data-duration-in="500" data-duration-out="500" class="tabs w-tabs">
            <div class="tabs-menu-wrapper w-tab-menu">
              <a data-w-tab="Tab 1" data-w-id="a8cb740e-5960-f8bc-7364-622b41777b33" class="tabs-nav-item w-inline-block w-tab-link w--current">
                <div class="tabs-nav-text">Summary</div>
                <div class="tabs-nav-background"></div>
              </a>
              <a data-w-tab="Tab 2" data-w-id="a8cb740e-5960-f8bc-7364-622b41777b37" class="tabs-nav-item w-inline-block w-tab-link">
                <div class="tabs-nav-text"><span class="text-span-21">Reviews &amp; <br>‍</span>All Photos</div>
              </a>
              <a data-w-tab="Tab 3" class="tabs-nav-item _03 w-inline-block w-tab-link">
                <div class="tabs-nav-text">Details &amp; More</div>
              </a>
            </div>
            <div class="tabs-content-wrapper w-tab-content">
              <div data-w-tab="Tab 1" class="tab-content-item w-tab-pane w--tab-active">
                <div class="div-block-43">


                  <div id="mapindividual" class="div-block-60 mapindividual">
                    
                  </div>

                  
                  <div class="div-block-44">
                    <div class="w-layout-grid grid-13">
                      <div id="w-node-f0a7f8fd-045c-4579-7343-2bc2c0725ffd-cc5db2a3" class="div-block-46">
                        <div class="text-block-26">Distance:<br><span id="DistanceTxt2">38 miles</span></div>
                      </div>
                      <div class="div-block-45"><img loading="lazy" src="images/car-compact-svgrepo-com.svg" alt="" class="image-24">
                        <div id="DrivingTime" class="text-block-27">30 min</div>
                      </div>
                      <div class="div-block-45"><img loading="lazy" width="15" src="images/bus-svgrepo-com.svg" alt="" class="image-24">
                        <div id="TransitTime" class="text-block-27">120 min</div>
                      </div>
                      <div class="div-block-45"><img loading="lazy" src="images/bike-svgrepo-com.svg" alt="" class="image-24 bike">
                        <div id="BikingTime"class="text-block-27">110 min</div>
                      </div>
                      <div class="div-block-45"><img loading="lazy" width="15" src="images/walk-svgrepo-com.svg" alt="" class="image-24 walk">
                        <div id="WalkingTime" class="text-block-27">386 min</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="div-block-42">
                  <div class="text-block-23"><span class="text-span-27">Hours: <br></span><span id = "hoursToday"class="text-span-35"><br>9:00am-8pm</span></div>
                  <div class="text-block-25">Cost: <br>‍<span id="cost2" class="text-span-29">$0-$10</span></div>
                </div>
                <div class="div-block-29">
                  <h1 class="heading-5 tips">Insider Tips:</h1>
                  <ul role="list" class="list">
                    <li class="list-item insidertips">A map of this park can be found <a target="_blank" href="https://www.rpvca.gov/DocumentCenter/View/13009/Ab-Cove-Closures">HERE</a>.</li>
                    <li class="list-item">The sea anemones, urchins, and starfish are safe to touch, but do not grab them off of the rocks, as this will injure them.  </li>
                    <li class="list-item">Visit the park during low tide to see the best tide pools.  Click <a target="_blank" href="https://www.surf-forecast.com/breaks/Palos-Verde-Bluff-Cove/tides/latest">HERE</a> to see the tide schedule.</li>
                  </ul>
                </div>
              </div>
              <div data-w-tab="Tab 2" class="tab-content-item w-tab-pane">
                <h1 class="heading-10">Reviews</h1>
                <div>
                  <div data-delay="4000" data-animation="slide" class="slider-7 w-slider" style="height:auto;" data-autoplay="false" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
                    <div class="w-slider-mask" style="height:auto;">
                    
                      <div id = "Review1Element" class="w-slide">
                        <div class="div-block-48"><img sizes="(max-width: 479px) 60px, (max-width: 767px) 75px, 100px"  loading="lazy" src="" alt="" class="image-27">
                          <div id="Review1Name" class="text-block-29"></div>
                          <div class="text-block-30"><span id="Review1Rating"></span> ⭐️ | <span id="Review1Date">About a month ago</span></div>
                          <p class="paragraph-10">&quot;<span id="Review1Text"></span>&quot;</p>
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="w-slider-arrow-left">
                      <div class="icon-4 w-icon-slider-left"></div>
                    </div>
                    <div class="w-slider-arrow-right">
                      <div class="icon-5 w-icon-slider-right"></div>
                    </div>
                    <div class="w-slider-nav w-shadow w-round"></div>
                  </div>
                </div>
                <h1 class="heading-10">All Photos</h1>
                <div class="div-block-50">
                  <div class="div-block-49">';
                  
                  
                   
$sql2 ="SELECT * FROM `Photos` WHERE `Place ID` LIKE '%".$PlaceID."%';";
$result2= mysqli_query($conn, $sql2);


while($row2 = $result2->fetch_array()){
  $PhotoID = $row2["Photo ID"];


echo' <a href="#" class="lightbox-link-3 w-inline-block w-lightbox"><img sizes="(max-width: 479px) 83vw, 300.3203125px" loading="lazy" src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyC24u6ihSWFCB89W-hi7rUSRFiIaEID-zI" alt="" class="image-28">
                      <script type="application/json" class="w-json">{
  "items": [
    {
      "_id": "example_img",
      "origFileName": "Image_4.jpeg",
      "fileName": "Image_4.jpeg",
      "fileSize": 101033,
      "height": 616,
      "url": "https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyC24u6ihSWFCB89W-hi7rUSRFiIaEID-zI",
      "width": 450,
      "caption": "",
      "type": "image"
    }
  ],
  "group": "Photos2"
}</script>
                    </a>';}
                    
                    
                    
                  echo'</div>
                </div>
              </div>
              <div data-w-tab="Tab 3" class="tab-content-item w-tab-pane">
                <div>
                <div id="birdviewmap" style="width:100%; height:300px; display:block;"></div>
                  <div class="div-block-33">
                    <div class="div-block-33">
                    
                      <p class="paragraph-8 address"><span class="text-span-14">Address:<br></span>1008 Elden Way,<br>Beverly Hills, CA<br>90210, USA<br></p>
                    </div>
                    <p class="paragraph-8"><span class="text-span-31">Hours:</span><br>Monday: 9:00 AM-4:00 PM <br>Tuesday: 9:00 AM – 4:00 PM <br>Wednesday: 9:00 AM – 4:00 PM <br>Thursday: 9:00 AM – 4:00 PM <br>Friday: 9:00 AM – 4:00 PM <br>Saturday: 9:00 AM – 4:00 PM <br>Sunday: 9:00 AM – 4:00 PM</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    
    
    
    
    
    '?>


<div id="HTMLInfoWindow"></div>

  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=634669433bd62dda63db2c61" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=634669433bd62dda63db2c61" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>


<script>
          
      // Initialize and add the map
      var map;
function initMap() {
            //user location
            const userLat = parseFloat(window.localStorage.getItem('Lat'));
            const userLng = parseFloat(window.localStorage.getItem('Lng'));
            console.log( userLat,  userLng);
            
            
            map = new google.maps.Map(document.getElementById('mapindividual'), {
                 mapId: "eafe0b1c94cbe9bb",
                zoom: 10,
                center: new google.maps.LatLng(parseFloat(userLat), parseFloat(userLng))
            });
           
            
            //Create a marker for user's current location
           
            new google.maps.Marker({
                
            position:new google.maps.LatLng(parseFloat(userLat), parseFloat(userLng)),
            map: map,
    icon: "images/navigation-5.png",
    animation: google.maps.Animation.DROP
  });
  
    //create position for selected location
    const marker = new  google.maps.Marker({

    position: new google.maps.LatLng(parseFloat("<?php echo"$Lat"?>"), 
                          parseFloat("<?php echo"$Lng"?>")),
                        
 map: map,
icon: "images/pin.png",
animation: google.maps.Animation.DROP
                    
                  
                });
                  //info window
                const infowindow = new google.maps.InfoWindow({ content: document.getElementById("HTMLInfoWindow") });
                //click listener
                 marker.addListener("click", () => {
                  infowindow.open({
                  anchor: marker,
                  map:map,
                });
              });

        //get place details
         var OpenNow;

        var PLACEID = "<?php echo"$PlaceID"?>";
        
        console.log("THIS IS LOG PLACEID", PLACEID); 
    var request = {
        placeId: PLACEID,
        fields: ['opening_hours', 'reviews', 'price_level']
    };


    var service = new google.maps.places.PlacesService(document.createElement('div'));
    service.getDetails(request, (place, status) => {
    if (
      status === google.maps.places.PlacesServiceStatus.OK &&
      place
    ) {


    // CHECK IF OPEN AND CHNAGE BUTTON ACCORDINGLY
      OpenNow = place.opening_hours.open_now;
     console.log(OpenNow);
      if (OpenNow == false){
        console.log("OpenNow is False");
        //turn #open red
        document.getElementById("Open").style.display = "none";
        document.getElementById("Closed").style.display = "block";
      }
      else{
        console.log("OpenNow is True");
        //turn #open green
        document.getElementById("Open").style.display = "block";
        document.getElementById("Closed").style.display = "none";
        
    }
     //Get Price
     var priceLevel = place.price_level;
     console.log("PRICE LEVEL: ", place.price_level);
  
     if (priceLevel == undefined){
         const CostLevel1 = document.getElementById('cost1');
         const CostLevel2 = document.getElementById('cost2');
         CostLevel1.textContent = "Free";
         CostLevel2.textContent = "Free";
         
     }
     
     //id = hoursToday

    var current = new Date();
    var currentDay = current.getDay();
    const hoursToday = document.getElementById('hoursToday');
    hoursToday.textContent =  place.opening_hours.weekday_text[currentDay];
    
     
     
     
     //GET REVIEWS
     
      
      if (place.reviews[0] != undefined){
          document.getElementById("Review1Name").textContent = place.reviews[0].author_name; 
          document.getElementById("Review1Rating").textContent = place.reviews[0].rating; 
          document.getElementById("Review1Date").textContent = place.reviews[0].relative_time_description; 
          document.getElementById("Review1Text").textContent = place.reviews[0].text; 
      }
      else{
          document.getElementById("Review1Element").textContent.style.display = "none";
      }
      
      
      
      
      
      
    }
    
  });


 // initialize services
  const geocoder = new google.maps.Geocoder();
  const service2 = new google.maps.DistanceMatrixService();
  
  
  // BUILD DRIVING DIRECTION REQUEST
  const origin = { lat: parseFloat(userLat), lng: parseFloat(userLng) };
  const destination = { lat: parseFloat("<?php echo"$Lat"?>"), lng: parseFloat("<?php echo"$Lng"?>") };
  const request2 = {
    origins: [origin],
    destinations: [destination],
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    avoidHighways: false,
    avoidTolls: false,
  };

  // get distance matrix response
  service2.getDistanceMatrix(request2).then((response) => {
    // put response
    console.log("DRIVING", response.rows[0].elements[0].distance.text);
    console.log("DRIVING", response.rows[0].elements[0].duration.text);
    
    const MilesAway = document.getElementById('DistanceTxt');
    const MilesAway2 = document.getElementById('DistanceTxt2');
    const MinutesAway = document.getElementById("DrivingTime");

// ✅ Change (replace) the text of the span
    MilesAway.textContent = response.rows[0].elements[0].distance.text;
    MilesAway2.textContent = response.rows[0].elements[0].distance.text;
    MinutesAway.textContent = response.rows[0].elements[0].duration.text;

  });
  
  
  // BUILD SECOND request
  const origin2 = { lat: parseFloat(userLat), lng: parseFloat(userLng) };
  const destination2 = { lat: parseFloat("<?php echo"$Lat"?>"), lng: parseFloat("<?php echo"$Lng"?>") };
  const request3 = {
    origins: [origin2],
    destinations: [destination2],
    travelMode: google.maps.TravelMode.TRANSIT,
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    avoidHighways: false,
    avoidTolls: false,
  };

  // get distance matrix response
  service2.getDistanceMatrix(request3).then((response) => {
    // put response
   
    console.log("TRANSIT ", response.rows[0].elements[0].duration.text);
    id=DistanceTxt
  
    const MinutesAway2 = document.getElementById('TransitTime');

// ✅ Change (replace) the text of the span

    MinutesAway2.textContent = response.rows[0].elements[0].duration.text;

  });

// BUILD BIKING request
  const origin3 = { lat: parseFloat(userLat), lng: parseFloat(userLng) };
  const destination3 = { lat: parseFloat("<?php echo"$Lat"?>"), lng: parseFloat("<?php echo"$Lng"?>") };
  const request4 = {
    origins: [origin3],
    destinations: [destination3],
    travelMode: google.maps.TravelMode.BICYCLING,
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    avoidHighways: false,
    avoidTolls: false,
  };

  // get distance matrix response
  service2.getDistanceMatrix(request4).then((response) => {
    // put response
   
    console.log("Biking: ", response.rows[0].elements[0].duration.text);
    
    id=DistanceTxt
  
    const MinutesAway3 = document.getElementById('BikingTime');

// ✅ Change (replace) the text of the span

    MinutesAway3.textContent = response.rows[0].elements[0].duration.text;

  });
// BUILD WALKING request
  const origin4 = { lat: parseFloat(userLat), lng: parseFloat(userLng) };
  const destination4 = { lat: parseFloat("<?php echo"$Lat"?>"), lng: parseFloat("<?php echo"$Lng"?>") };
  const request5 = {
    origins: [origin4],
    destinations: [destination4],
    travelMode: google.maps.TravelMode.WALKING,
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    avoidHighways: false,
    avoidTolls: false,
  };

  // get distance matrix response
  service2.getDistanceMatrix(request5).then((response) => {
    // put response
   
    console.log("Walking: ", response.rows[0].elements[0].duration.text);
    
    id=DistanceTxt
  
    const MinutesAway4 = document.getElementById('WalkingTime');

// ✅ Change (replace) the text of the span
    MinutesAway4.textContent = response.rows[0].elements[0].duration.text;
   
  });
  
  //id="birdviewmap"
  map2 = new google.maps.Map(document.getElementById("birdviewmap"), {
    center: { lat: parseFloat("<?php echo"$Lat"?>"), lng:parseFloat("<?php echo"$Lng"?>")},
    zoom: 19,
    mapTypeId: "satellite",
    heading: 90,
    tilt: 45,
  });


function rotate90() {
  const heading = map2.getHeading() || 0;

  map2.setHeading(heading + 90);
}

function autoRotate() {
  // Determine if we're showing aerial imagery.
  if (map2.getTilt() !== 0) {
    window.setInterval(rotate90, 3000);
  }
}

autoRotate();

        }
        window.initMap = initMap;




      </script>





    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC24u6ihSWFCB89W-hi7rUSRFiIaEID-zI&libraries=places&callback=initMap&v=weekly" defer >
   </script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>