<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Wed Nov 30 2022 08:05:05 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="636af04d285d5e4ebd5db29b" data-wf-site="634669433bd62dda63db2c61">
<head>
  <meta charset="utf-8">
  <title>Categories</title>
  <meta content="Categories" property="og:title">
  <meta content="Categories" property="twitter:title">
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
    <div data-w-id="bd313082-f89d-eff3-276a-f3c8cb3caf34" style="opacity:0" class="div-block-15 explore">
      <h2 class="heading-2">Categories  <br></h2>
      <div class="text-block-7" style="font-size: 18px;">Please select one or more category   😄</div>
      <div class="w-form">
        <form id="wf-form-Categories[]" name="wf-form-Categories[]" data-name="Categories[]" action="result.php" method="post">
          <div class="checkbox_wrap-3">



            

<?php
//echo "POST(",json_encode($_POST),")<br>";
$conn=mysqli_connect("localhost","u330436780_eddievaldez200","a+qxcxh9w#%tP","u330436780_ExploreLA");
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
  //echo "Failed!";
}
//echo "Connected Succesfully <br>";

$Moods = []; 

if(isset ($_POST['NextBTN'])){
  if (isset($_POST['Moods'])){
    foreach($_POST ['Moods'] as $value){
      array_push($Moods,$value); 
      //echo $value;
    }}
}
$query = "";
foreach($Moods AS $Mood){
  //echo $Mood, " ";
  $query .= "`Mood` LIKE '%".$Mood."%' OR " ;
}

$query = substr($query, 0, -4);

$sql = "SELECT DISTINCT Categories FROM `MoodsCategories` WHERE $query";

//echo "SQL QUERY:",$sql,"<<" ;


//$sql = "SELECT * FROM Mood WHERE '.$query.' ";
$result= mysqli_query($conn, $sql);

while($row = $result->fetch_array()){

$Category = $row["Categories"];

/*
$conn2=mysqli_connect("localhost","root","","Explore LA Database");
$sql2 ="SELECT * FROM `Photos` WHERE `Place ID` LIKE '%.$PhotoID.%';";
$result2= mysqli_query($conn2, $sql2);

$row2 = mysqli_fetch_assoc($result2);

$PhotoID = $row2["Photo ID"];

*/

echo '<label class="w-checkbox checkbox-field-2 form12_checkbox_field-3"><input type="checkbox" id="Categories[]" name="Categories[]" value="'.$Category.'" data-name="Categories[]" data-w-id="bd313082-f89d-eff3-276a-f3c8cb3caf41" class="w-checkbox-input checkbox-2"><img  style="display:none;" src="images/leaves-svgrepo-com-1.svg" width="60" alt="" class="checkbox-image">
              <div class="text-block-10">'.$Category.'</div><span for="Categories[]" class="checkbox-title-3 w-form-label">Website Design</span>
            </label>';}
foreach($Moods AS $Mood){



echo '<div style="display:none;" id="CategoryBTN-Template" class="div-block-19 w-node-_709979e3-f8b8-9d25-97ef-9183f20dbddc-94b6243a"><label class="w-checkbox checkbox-field"><input type="checkbox" id="Moods[]" name="Moods[]" value="'.$Mood.'" data-name="Moods[]" class="w-checkbox-input checkbox" checked><span class="checkbox-label w-form-label" for="Moods[]" checked>'.$Mood.'</span></label></div>';}?>

<label class="w-checkbox checkbox-field-2 form12_checkbox_field-3 all-moods"><input type="checkbox" id="Categories[]-2" name="Categories[]-2" value="" data-name="Categories 2" data-w-id="494e68d8-0019-44ff-baf2-207f7685717d" class="w-checkbox-input checkbox-2">
<div class="text-block-10 all-moods">Browse <br>All Categories</div><span for="Categories[]-2" class="checkbox-title-3 w-form-label">Website Design</span>
</label>


          </div><input type="submit" data-wait="Please wait..." value="Next" class="submit-button-2 w-button">
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
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=634669433bd62dda63db2c61" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <script >

  
    getLocation();
    function getLocation(){
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getPosition)

      } else{
         locationAlert.style.display = 'block';

      }
    function getPosition(position){
      console.log(position.coords.latitude);
      window.localStorage.setItem('Lat',  JSON.stringify(position.coords.latitude));

      console.log(position.coords.longitude);
      window.localStorage.setItem('Lng', JSON.stringify(position.coords.longitude));

    }
    }

  </script>
  <script >
    const coordinates = JSON.parse(window.localStorage.getItem('Lng'));
    console.log(coordinates);
  </script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>