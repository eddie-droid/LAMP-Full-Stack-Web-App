# Replication Instructions and Code Architechure Overview

My web app is online and able to be accessed. You can access it by visiting https://eddievaldez.org/explorela/explorela.html

Below are instructions to be able to replicate or build on my project.

# Replication Instructions

In order to replicate my project, you can perform the following steps.

- Download all files in the ExploreLACode folder. You can use any text editor.
- Next you will have to mimic creating a host server and client with your local machine using XAMPP.
- Download a version of XAMPP compatible with your device.
- Install and set up XAMPP.
- On XAMPP create a new MySQL database. Populate this database by importing the provided MySQL file in the Database Folder. 
- Move all files downloaded from XAMPP into the htdocs folder where XAMPP was downloaded.
- Then, in all the PHP pages that you downloaded with ExploreLA, modify MySQL login details to match your account.

You should be all set up and ready to add locations.You can do so by doing the following steps:
-Downlaod and run the Data Collection files provided inside the Data Collection code. You can add locations by finding a the ```place_id``` of a location you want to add. You can use google maps to do this. 

-You will need to create a new google maps api key. Do not use mine please. 

# Code Architecture

```
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
}```
This was an important function in my web app as is solved a huge problem I had was getting my results to be returned by proximity to you. This was aproblem because the order of queries is determined in MySQL, however. It is impossible to get data about distance away from you to be in MySQL because the value changes based onm the user's current location. This function calulates the distance of the line that connects a user's coordionates to the coordinates of the lcoation. The coordinates of the location in MySQL and a current user's lcoation are used to effectly return results by distance but only after reordering the returned array of lcoations by that calulated distance.

```
while($row2 = $result2->fetch_array()){
  $PhotoID = $row2["Photo ID"];

echo '<div class="slide-3 w-slide">
                            <a href="#" class="lightbox-link-2 w-inline-block w-lightbox"><img sizes="(max-width: 479px) 330.59375px, 638.65625px"  src="https://maps.googleapis.com/maps/api/place/photo?maxwidth=600&photoreference='.$PhotoID.'&key=AIzaSyC24u6ihSWFCB89W-hi7rUSRFiIaEID-zI" loading="preload" alt="" class="image-26 search-result">
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
  "group": "'.$counter.'"
}</script>
                            </a>
                          </div>';}
```
I used this code to be able to get Photo Data from Google API. I combined data from MySQL database, which inludes a table with PhotoID's that are tied to a location's PlaceID, with a location's Place ID that was obtained for each location, using PHP and an existing MySQL query.

```<script>
          
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




      </script>```
      This is the JavaScript code that I used to call live data for a specific location using google's api. The place ID is obtained via a GET form result. 

