<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Wed Nov 30 2022 08:05:05 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="636af04d285d5e37a95db2a1" data-wf-site="634669433bd62dda63db2c61">
<head>
  <meta charset="utf-8">
  <title>ListView</title>
  <meta content="ListView" property="og:title">
  <meta content="ListView" property="twitter:title">
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
   
  
  
<script>
//get location data
const usrLat = window.localStorage.getItem('Lat');
const usrLng = window.localStorage.getItem('Lng');
const LikedLocationsArray = JSON.parse(localStorage.getItem('LikedLocations'));
   
// Function to create the cookie
function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}



  

   createCookie("usrLat", usrLat, "10");
   createCookie("usrLng", usrLng, "10");
   
   
   
   
const setCookie = (name, json)=>{

  let cookieValue = '';
  let expire = '';
  let period = '';

  //Specify the cookie name and value
  cookieValue = name + '=' + JSON.stringify(json) + ';';

  //Specify the path to set the cookie
  cookieValue += 'path=/ ;';

  //Specify how long you want to keep cookie
  period = 30; //days to store
  expire = new Date();
  expire.setTime(expire.getTime() + 1000 * 3600 * 24 * period);
  expire.toUTCString();
  cookieValue += 'expires=' + expire + ';';

  //Set cookie
  document.cookie = cookieValue;
};

setCookie('LikedLocationsArray', LikedLocationsArray);

   
   
</script>
</head>
<body class="body-4">
  <div class="w-embed">
    <style>
.body-4 {
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
  <div class="hero wf-section">
    <div data-w-id="938fc91d-e92c-4a9d-8f26-7901f3837188" style="opacity:0" class="div-block-2">
      <div class="div-block-53">
        <div class="form-block-3 w-form">
          <form id="email-form-2" name="email-form-2" data-name="Email Form 2" action="searchResult.php" method="get"class="form-4">
            <div class="div-block-54">
              <div class="w-layout-grid grid-14"><input style="color:black;" type="text" class="text-field-6 w-node-b4e67db0-3a81-bfa9-7d2e-a79f281f8786-a95db2a1 w-input" maxlength="256" name="SearchQueryString" data-name="Field" placeholder="Search our locations here" id="field" required=""><input type="submit" value="Search" data-wait="Please wait..." id="w-node-_90db5e56-669e-fcdf-48ef-c0906e54d564-a95db2a1" class="submit-button-10 w-button"></div>
              <div class="div-block-55"></div>
            </div>
          </form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="div-block-64 filterhidden">
      <div id="Filter-Form" class="form-block-4 w-form">
        <form id="wf-form-FilterForm" name="wf-form-FilterForm" data-name="FilterForm" method="get" class="form-5">
          <select id="Moods" name="Moods" data-name="Moods" class="select-field w-select">
            <option value="">Choose Moods</option>
            <option value="First">First choice</option>
            <option value="Second">Second choice</option>
            <option value="Third">Third choice</option>
          </select><select id="Category" name="Category" data-name="Category" class="select-field-2 w-select">
            <option value="">Choose Category</option>
            <option value="First">First choice</option>
            <option value="Second">Second choice</option>
            <option value="Third">Third choice</option>
          </select><input type="submit" id="FIlterSubmitBTN" value="Apply" data-wait="Please wait..." class="submit-button-11 w-button">
        </form>
        <div class="w-form-done">
          <div>Thank you! Your submission has been received!</div>
        </div>
        <div class="w-form-fail">
          <div>Oops! Something went wrong while submitting the form.</div>
        </div>
      </div>
    </div>
    <div class="second-example-with-unterline-2">
      <div data-current="Tab 1" data-easing="ease-in-out" data-duration-in="300" data-duration-out="300" class="tabs-2 w-tabs">
        <div data-w-id="6a9ea167-c498-0be7-78a9-e863bef28c0f" style="opacity:0" class="tabs-menu-underline-wrapper-2 w-tab-menu">
          <a data-w-tab="Tab 1" class="tabs-nav-item-underline _01 w-inline-block w-tab-link w--current">
            <div class="tabs-nav-icon-wrapper"><img loading="lazy" src="images/menu-svgrepo-com.svg" alt="" class="image-21"></div>
            <div class="tabs-nav-text-2">List</div>
            <div class="tabs-nav-unterline"></div>
          </a>
          <a data-w-tab="Tab 2" class="tabs-nav-item-underline _02 w-inline-block w-tab-link">
            <div class="tabs-nav-icon-wrapper"><img loading="lazy" src="images/map-svgrepo-com-2.svg" alt="" class="image-22"></div>
            <div class="tabs-nav-text-2">Map </div>
          </a>
        </div>
        <div class="tabs-content-wrapper w-tab-content">
          <div data-w-tab="Tab 1" class="tab-content-item w-tab-pane w--tab-active">
            <div class="tab-content">




<?php
//start of card

$userLatitude= $_COOKIE["usrLat"]; 
$userLongitude =  $_COOKIE["usrLng"]; 

function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
  $theta = $longitude1 - $longitude2; 
  $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
  $distance = acos($distance); 
  $distance = rad2deg($distance); 
  $distance = $distance * 60 * 1.1515; 
  switch($unit) { 
    case 'miles': 
      break; 
    case 'kilometers' : 
      $distance = $distance * 1.609344; 
  } 
  return (round($distance,2)); 
}


$conn=mysqli_connect("localhost","u330436780_eddievaldez200","a+qxcxh9w#%tP","u330436780_ExploreLA");
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
  //echo "Failed!";
}else{
  //echo "Connected Succesfully <br>";
}


//echo "POST(",json_encode($_POST),")<br>";

$Moods = [];
  if (isset($_POST['Moods'])){
    foreach($_POST ['Moods'] as $value){
      array_push($Moods,$value); 
      //echo $value;
    }}

$query = "";
foreach($Moods AS $Mood){
  //echo $Mood, " ";
  $query .= "`Moods` LIKE '%".$Mood."%' OR " ;
}
$query = substr($query, 0, -4);



$Categories = [];
if (isset($_POST['Categories'])){
    foreach($_POST ['Categories'] as $value){
      array_push($Categories,$value); 
      //echo $value;
    }}

$query2 = "";
foreach($Categories AS $Category){
  //echo $Category, " ";
  $query2 .= "`Categories` LIKE '%".$Category."%' OR " ;
}

$query2 = substr($query2, 0, -4);




$sql = "SELECT * FROM `Locations` WHERE ($query) AND ($query2)";

//echo "SQL QUERY:",$sql,"<<" ;


//$sql = "SELECT * FROM Mood WHERE '.$query.' ";
$result= mysqli_query($conn, $sql);


$LocationArraywithDistanceAway = array();
$iterations = 0;
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    
    //echo "\n ROW SIZE: ", sizeof($row), ". \n";
    //echo "\n ITERATION # ", $iterations, "\n";
    $iterations = $iterations+1;
  
 $locationLatitude = $row["Latitude"];
 //echo "LAT", $locationLatitude;
 $locationLongitude = $row["Longitude"];
 //echo "LONG", $locationLongitude;

 $DistanceAway = getDistanceBetweenPointsNew($userLatitude, $userLongitude,$locationLatitude, $locationLongitude);
 //echo "Distance Away: ", $DistanceAway;
 $row["DistanceAway"] = $DistanceAway;
 //echo "DISTANCE AWAY IN ROW ARRAY ", $row["DistanceAway"];
 array_push($LocationArraywithDistanceAway, $row);


 
}
/*
foreach($LocationArraywithDistanceAway as $location){
    echo $location['Name'], " ", $location["DistanceAway"], "<br>";
}
*/

//echo "size of array: ";
//echo sizeof($LocationArraywithDistanceAway);


usort($LocationArraywithDistanceAway, function($a, $b)
{
   // echo 'COMPARE RUNNING';
   
    return $a['DistanceAway']> $b['DistanceAway'];
});
/*
foreach($LocationArraywithDistanceAway as $location){
    echo $location['Name'], " ", $location["DistanceAway"], "<br>";
}
*/
//echo "NEW ARRAY ORDER";

/*
foreach($LocationArraywithDistanceAway as $LocationArray){
     //echo $LocationArray["Name"];
    
 }
    */
$Markers = array();

$counter = 1;
/*
$temparray = $result->fetch_array();
foreach($temparray as $singlerow){
    echo $singlerow;
}
foreach($temparray as $singlerow){
    echo $singlerow;
}
*/


foreach($LocationArraywithDistanceAway as $LocationArray){
//echo "Loop Run";
  $Markers[] = array(
            "lat" =>   $LocationArray["Latitude"],
            "lng" =>   $LocationArray["Longitude"],
            "title" => $LocationArray["Name"],
            "summary" => $LocationArray["Summary"],
            "placeid" => $LocationArray["Place ID"]
        );
        
  $Categories = $LocationArray["Categories"];
  $Name = $LocationArray["Name"];
  $Rating = $LocationArray["Rating"];
  $Types = $LocationArray["Types"];
  $Distance = $LocationArray["Name"];
  $Summary = $LocationArray["Summary"];
  $PlaceID = $LocationArray["Place ID"];
  $Latitude = $LocationArray["Latitude"];
  //echo $Latitude;
  $Longitude = $LocationArray["Longitude"];
  $Total = $LocationArray["Total Reviews"];
  $DistanceAwayFromMe = $LocationArray["DistanceAway"];
  $PriceLevel = $LocationArray["Price Level"];
  
  //echo $Latitude;

++$counter;
$conn2=mysqli_connect("localhost","u330436780_eddievaldez200","a+qxcxh9w#%tP","u330436780_ExploreLA");
if ($conn2->connect_error){
  die("Connection failed: " . $conn2->connect_error);
  //echo "Failed!";
}
//echo "Connected Succesfully <br>";




$sql2 ="SELECT * FROM `Photos` WHERE `Place ID` LIKE '%".$PlaceID."%';";
$result2= mysqli_query($conn2, $sql2);


$row2 = mysqli_fetch_assoc($result2);
foreach ($row2 AS $row){
  //echo "NEW ROW: ", $row, "\n";
} 
$PhotoID = $row2["Photo ID"];




  //start of card
echo '<div data-w-id="6fc6ae30-e1c1-7b8b-1636-a7c6fab385ce" style="opacity:0" class="div-block-15 search locationview query">
                <div class="div-block-51 resultspage">
                  <div class="div-block-21">
                    <div class="div-block-31">
                      <div data-delay="2000" data-animation="slide" class="slider-4 w-slider" data-autoplay="true" data-easing="ease-in-out" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="300" data-infinite="true">
                        <div class="mask-3 w-slider-mask">';





$sql2 ="SELECT * FROM `Photos` WHERE `Place ID` LIKE '%".$PlaceID."%';";
$result2= mysqli_query($conn, $sql2);


while($row2 = $result2->fetch_array()){
  $PhotoID = $row2["Photo ID"];

echo '<div class="slide-3 w-slide">
                            <a href="#" class="lightbox-link-2 w-inline-block w-lightbox"><img sizes="(max-width: 479px) 330.59375px, 638.65625px"  src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyCWupLokFzSpQxB6rEj5HJ_OkJXIFhfWV4" loading="preload" alt="" class="image-26 search-result">
                              <script type="application/json" class="w-json">{
  "items": [
    {
      "_id": "example_img",
      "origFileName": "photo0.jpeg",
      "fileName": "photo0.jpeg",
      "fileSize": 71414,
      "height": 366,
      "url": "https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyCWupLokFzSpQxB6rEj5HJ_OkJXIFhfWV4",
      "width": 550,
      "caption": "",
      "type": "image"
    }
  ],
  "group": "'.$counter.'"
}</script>
                            </a>
                          </div>';}





echo '</div>
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
                    
                      <div class="div-block-52">';
                      
                      

$LikedLocationsArray =  json_decode($_COOKIE["LikedLocationsArray"], true);


$Color = "#DCDCDC";
foreach($LikedLocationsArray AS $IndividualLikedLocationID){
 
  if ($IndividualLikedLocationID == $PlaceID){
      $Color = "#FF69B4";
  }
}

                      
                     
                        echo'<a style="background-color: '.$Color.';" onclick="LikeButtonClicked'.$PlaceID.'()" data-w-id="26784cc5-0861-3a96-d94f-4de8306c1ec6" href="#" class="button-5 liked w-button"><span class="text-span-25"></span></a>
                       
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
                      
                        <h1 class="heading-9 cardresults">'.$Name.'</h1>
                        <div class="text-block-34">'.$Categories.'</div>
                      </div>
                      <div class="div-block-39 result">
                        <div data-w-id="e4cd5a8d-771a-1c40-a91c-306dbf1b641d" class="div-block-40 rating">
                          <div class="text-block-22">'.$Rating.' <span class="text-span-32"></span> | '.$Total.' Reviews </div>
                        </div>
                        <div id="Open" data-w-id="4b13c43b-dcbc-c900-fed7-3452b42fc0c8" class="div-block-22">';
                        
                        
                        if ($PriceLevel==0){
                            $TextPrice="Free";
                        }
                        else if ($PriceLevel==1){
                            $TextPrice= "\$1-\$10";
                        }
                        else if ($PriceLevel==2){
                            $TextPrice= "\$10-\$20";
                        }
                         else if ($PriceLevel==3){
                            $TextPrice= "\$20-\$30";
                        }
                        else if ($PriceLevel==4){
                            $TextPrice= "\$30 or more";
                        }
                         
                          echo'<div class="text-block-12">'.$TextPrice.' </div>
                        </div>
                        <div id="Closed" data-w-id="8da93774-f35a-3971-639f-839e7216e5f0" class="div-block-22 closed">
                          <div class="text-block-12">Closed <span class="icon"></span></div>
                        </div>
                        
                 
                 
    


    
                        
                        
                        
                        <div id="Distance" data-w-id="28431464-4cd1-4c3c-84cf-b86461ebbf59" class="div-block-22 distance">
                          <div class="text-block-12 distance"> <span class="text-span-33"></span> '.$DistanceAwayFromMe.' miles away </div>
                        </div>
                      </div>
                      <div class="div-block-25">
                        <p style="text-align:left;" class="paragraph-6">'.$Summary.'<br></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-form">
                  <form id="email-form" action="selectedlocation.php" method="get" name="PlaceID" data-name="PlaceID"><input style="opacity:0%;" type="submit" data-wait="Please wait..." name="PlaceID" value="'.$PlaceID.'" class="submit-button-7 w-button"></form>
                  <div class="w-form-done">
                    <div>Thank you! Your submission has been received!</div>
                  </div>
                  <div class="w-form-fail">
                    <div>Oops! Something went wrong while submitting the form.</div>
                  </div>
                </div>
              </div>';}?>






            </div>
          </div>
          <div data-w-tab="Tab 2" class="tab-content-item w-tab-pane">
            <div class="tab-content">
              <div id="map" style="" class="mapresult"></div>
              



              <div id="InfoWindowHTMLWrapper" style="display:none;">
                <div  id="InfoWindowHTML" class="div-block-51 infowindowhtmlelement results">
                  <div class="div-block-21">
                    <div class="div-block-31">
                      <div data-delay="1000" data-animation="slide" class="slider-4 w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="false" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="250" data-infinite="true">
                        <div class="mask-3 w-slider-mask">
                          <div class="slide-3 w-slide">
                            <a href="#" class="lightbox-link-2 w-inline-block w-lightbox"><img sizes="(max-width: 479px) 330.59375px, 638.65625px" srcset="images/photo0-p-500.jpeg 500w, images/photo0.jpeg 550w" loading="lazy" src="images/photo0.jpeg" alt="" class="image-26 search-result">
                              <script type="application/json" class="w-json">{
  "items": [
    {
      "_id": "example_img",
      "origFileName": "photo0.jpeg",
      "fileName": "photo0.jpeg",
      "fileSize": 71414,
      "height": 366,
      "url": "images/photo0.jpeg",
      "width": 550,
      "caption": "high quality",
      "type": "image"
    }
  ],
  "group": "Photos"
}</script>
                            </a>
                          </div>
                          <div class="slide-3 w-slide">
                            <a href="#" class="lightbox-link-2 w-inline-block w-lightbox"><img sizes="(max-width: 479px) 165.2578125px, 319.2421875px" srcset="images/team-portrait-03-p-500.jpeg 500w, images/team-portrait-03.jpg 640w" loading="lazy" src="images/team-portrait-03.jpg" alt="" class="image-26 search-result">
                              <script type="application/json" class="w-json">{
  "items": [
    {
      "_id": "example_img",
      "origFileName": "team-portrait-03.jpg",
      "fileName": "team-portrait-03.jpg",
      "fileSize": 91593,
      "height": 852,
      "url": "images/team-portrait-03.jpg",
      "width": 640,
      "type": "image"
    }
  ],
  "group": "Photos"
}</script>
                            </a>
                          </div>
                        </div>
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
                      <div class="div-block-52">
                        <a data-w-id="3b88c349-4609-2195-99fb-3fe5520b8096" href="#" class="button-5 liked w-button"><span class="text-span-25"></span></a>
                        
                        <script>
                      function likeBTNclicked(){
                      var liked = 0;
                      if (liked ==0){
                          function like() {
                            liked = 1;
                            //localStorage.setItem("Saved", '.$PlaceID.');
                      }
                      }
                      else{
                           function unlike() {
                            liked = 0;
                            localStorage.removeItem("Saved"); 
                      }
                      }}
                      </script>
                        <h1 class="heading-9">Abalone Cove State Park</h1>
                        <div class="text-block-34">Parks, Picnics, Trail, Beaches, Views</div>
                      </div>
                      <div class="div-block-39 result">
                        <div data-w-id="3b88c349-4609-2195-99fb-3fe5520b809a" class="div-block-40 rating">
                          <div class="text-block-22">4.8 <span class="text-span-32"></span> | 879 Reviews </div>
                        </div>
                        <div id="Open" data-w-id="3b88c349-4609-2195-99fb-3fe5520b80a0" class="div-block-22">
                          <div class="text-block-12">Open <span class="icon"></span></div>
                        </div>
                        <div id="Open" data-w-id="3b88c349-4609-2195-99fb-3fe5520b80a5" class="div-block-22 closed">
                          <div class="text-block-12">Closed <span class="icon"></span></div>
                        </div>
                        <div id="Open" data-w-id="3b88c349-4609-2195-99fb-3fe5520b80aa" class="div-block-22 distance">
                          <div class="text-block-12 distance"> <span class="text-span-33"></span> 1 mile away </div>
                        </div>
                      </div>
                      <div class="div-block-25">
                        <p class="paragraph-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
   
    <script>

        var positions = <?php echo json_encode($Markers) ?>;
        console.log(positions);
    </script>
     <script>
          
      // Initialize and add the map
      var map;
function initMap() {
            //user location
            const userLat = parseFloat(window.localStorage.getItem('Lat'));
            const userLng = parseFloat(window.localStorage.getItem('Lng'));
            console.log(typeof userLat, typeof userLng);
            
            
            map = new google.maps.Map(document.getElementById('map'), {
                 mapId: "eafe0b1c94cbe9bb",
                zoom: 10,
                center: new google.maps.LatLng(parseFloat(userLat), parseFloat(userLng))
            });
            
            
            
            
            
            
            
            
            
            
            var marker;
            
            //Create a marker for user's current location
           
            new google.maps.Marker({
                
            position:new google.maps.LatLng(parseFloat(userLat), parseFloat(userLng)),
            map: map,
    icon: "images/navigation-5.png",
    animation: google.maps.Animation.DROP
  });
  


            
            
            //Create a new marker for each location  
            positions.forEach(function(position){
                       const marker = new  google.maps.Marker({
                   /* position: {
                        lat : parseInt(position.lat),
                        lng : parseInt(position.lng) }*/
                        position: new google.maps.LatLng(parseFloat(position.lat), parseFloat(position.lng)),
                        
                    map: map,
                    title: position.title,
                    icon: "images/pin.png",
                    animation: google.maps.Animation.DROP
                    
                  
                });
                  //info window
                
                const contentString =
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h2 id="firstHeading" class="firstHeading">'+ position.title +'</h2>' +
    '<div id="bodyContent">' +
    "<p>"+ position.summary +"</p>" +
    '<a href="https://eddievaldez.org/explorela/selectedlocation.php?PlaceID='+ position.placeid+'">' +
    "Click here to view photos and more details about this location " +
    "</div>" +
    "</div>";
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
    maxWidth: 200,
    ariaLabel: position.title,
  });
                //click listener
                 marker.addListener("click", () => {
                  infowindow.open({
                  anchor: marker,
                  map:map,
                });
              });
                
                console.log(position.title);
                console.log(position.lat);
                console.log(position.lng);
                
            
                
                
            });

        }
        window.initMap = initMap;




      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWupLokFzSpQxB6rEj5HJ_OkJXIFhfWV4&libraries=places&callback=initMap&v=weekly" async defer >
    
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=634669433bd62dda63db2c61" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
 
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>