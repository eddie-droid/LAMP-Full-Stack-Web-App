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

\documentclass[12pt,twocolumn]{article} 

\usepackage{oxycomps} % use the main oxycomps style file

\bibliography{references}

\pdfinfo{
    /Title (Senior Comps Project)
    /Author (Eddie Valdez)
}

\title{Oxy CS Senior Comps Project}

\author{Eddie Valdez}
\affiliation{Occidental College}
\email{evaldez@oxy.edu}

\begin{document}

\maketitle

\begin{abstract}
    This paper describes the design and evaluation of a new location discovery platform. The purpose was to design and develop a location discovery app with a simple to use user interface that contains centralized and more useful information about locations than traditional location discovery apps like Google Maps, Four Square, or Spotted by Los Angeles. I am writing this paper as a part of my final senior comprehensive project. The goal of my project is to determine whether or not I can design a location discovery app that is effective in getting people to go out exploring new places. My project only targets people living in Los Angeles, specifically people of low income and with limited free time, and thus the locations that can be explored in my web app are all from Los Angeles.The web app will use individually researched locations around Los Angeles. Additionally, many locations featured in the web app will be affordable. 

\end{abstract}

\section{Problem Context}
 It is difficult and time consuming for people who want to explore new places to discover relevant locations. The time consuming nature of discovering new locations is especially problematic for people with low amounts of free time. I believe the traditional process of discovering relevant locations is inconvenient and not ideal for many  reasons. One reason is traditional methods for discovering locations are mainly limited to searching by text, with only a few platforms offering other options to quickly access locations based on certain criteria like categories. Additionally, there is a lack of a centralized, easy to navigate interface that contains personalized information about each location informing people of things they can do and any tips that might be useful. This process is even more inconvenient for people looking to find free or low cost things to do. In my findings, affordable locations are not often highlighted and when they are affordable, there is no quick way to know how much money one might spend.  

This would be useful for many people living in Los Angeles as there are many people living in Los Angeles who either have a lack of time, have limited disposable income, or both. For people with plenty of free time and money, this web app might not be very useful.

The inspiration for this project came from my own experiences living in  Los Angeles during college. While at college, I was busy and was often left with very limited time to do things I wanted to do. In my free time, I wanted to explore Los Angeles as it is was a new city for me. When I wanted to go out, it frequently ended up not actually happening because it was hard to find places that I was interested in that were affordable. Places needed to be affordable because I do not come from a wealthy family by any means. In order to find affordable places, I would end up going into a deep google search that would often take up way too much time. This is precious time , because I was always very busy with school, so I could've used to enjoy the locations. Because of this long, unmotivating  process, I often didn't go out because I couldn't find interesting enough places. I have used this method since freshman year and I got tired of it. I also know a lot of people probably feel the same way and would love a better solution. 

That is why I wanted to develop an app for people living in Los Angeles who have limited free time  and low levels of  disposable income and just like everybody else, they want to spend their free time doing things that satisfy their individual needs. This is why I designed my web app to be as easy as possible to find relevant places nearby that are affordable. Additionally, my app includes many locations that can be identified as green spaces. In my research, I found that the majority of green spaces tended to fall under the affordable category. This had the benefit of potentially getting people more exposed to green spaces. This is beneficial because according to increasing research exposure to green spaces have been shown to be beneficial to one’s health\cite{TRAN2022206}. 

For these reasons, I chose to pursue this project of attempting to get people to go out more, regardless of what kind of activities they want to do. This paper describes the process behind the design and  evaluation of a new location discovery that I developed to serve as an alternative to commonly used location Discovery PLatforms Google Search, FourSquare, Spotted by Locals, and Yelp . My proposed web app attempts to make it easier to discover interesting places around LA along with providing relevant, detailed, and centralized information about these locations. Additionally, the web app will attempt to make it easier to discover affordable locations in the web app in order to help those with limited free time and limited disposable income get out more. 


\section{Technical Background}
In order to achieve my project goal, I decided to develop a web app. This is different from a mobile app for a couple important reasons.  I decided a web app would be the best format for multiple reasons: (1) Web apps allow for quicker development times. (2)  Web apps offer higher accessibility as they can be accessed on all browsers connected to the internet. (3) Web apps have access to all the same features a mobile app would have access to such as a user's current location or storing and retrieving information on the device. Additionally, for my specific app purposes, I speculate that most people already use web browsers  to discover new locations, so this means they would be able to use my web app in the same app that they would normally use to discover new locations. This could make it more convenient to use my web app. As I will explain later, in my interviews I confirmed this to be true as I found that the vast majority of people simply use Google Search to find new places instead of platforms that were the form of mobile apps. There would definitely be benefits to developing my proposed platform in the form of a mobile app like access app functionality when there is no internet connection. However, for the purposes and time limitations of my project, I decided it was best to use a web app. The development time for mobile apps can be significantly longer than web apps. 
I decided to build my web app using what is known as a LAMP stack. A LAMP stack is a technology stack which consists of different components of a software interacting with each other to create a fully functional application. LAMP is an acronym for the operating system, Linux, the web server, Apache, the database server, MySQL, and the programming language, PHP. I used a LAMP stack as opposed to other stacks like a MERN because it was more efficient in several areas: cost, time of development, speed, and compatibility. JavaScript also runs on the client’s side for essential app functionality and I used CSS for styling my web app. 
Additionally, in order to begin building my MySQL database I used Python to scrape essential location data from Google Place’s Location Details API. I also use several other Google Platform API’s to implement features like a map view of location and to be able to also access live  information about my locations. An API is an acronym for application program interface. API’s basically allow you to get information from servers all over the world via the World Wide Internet. In my case, I am using multiple Google API’s to get information from Google’s servers to the server where my website is being hosted on in order to send them to your browser via a scripting language. In my case, I used PHP as my scripting language. Scripting languages like PHP allow you to embed data from databases or API’s into HTML which is then displayed on your browser. 

\section{Prior Work}
There are other platforms out there already that aim to tackle the problem of making it easier to find  relevant locations around you. The  platforms I determined are similar alternatives to my web app that people might already use  are Google Search, FourSquare, Spotted by Locals, and Yelp. I assessed the design of these apps in order to plan the design of my web app. I compared many features present in these platforms. I found that while there are definitely variations amongst these apps, there are many more notable similarities. However, in all of these, I found a lack of diversity in terms of methods to discover relevant locations, a lack clear labeling of costs of of a location along with locations oftentimes missing data about costs, and a lack of an easy to use UI that tries to provide only the most essential information about each location while also providing a wide variety of relevant and personalized information about each location.


In all the related platforms, I found that there is some kind of map view for viewing locations. You can view where the locations are on a map, however what I found was missing in several of the platforms was a way to glance at a preview of information about a place before viewing the full details of the location when you click on it on a map. Additionally when a preview was available, such as in Spotted by and FourSquare, only basic information like the name of the location is shown but not much is learned about the location. Yelp and Google however stood out in providing more information than all the other options when viewing results. They contained information like rating, hours, and categories. I want to develop an interface where one can click on a pin and it can give you brief details about it like a summary included in the map view of the results. I think this can speed up the process of discovering relevant places near you if you choose to use a map view.

Other notable features are various attempts to make it easier to find relevant places near you by having quick browse filters or categories in the main screen of the platforms. For example, in the mobile app Spotted By’s initial start up screen is a map with all the locations that the app offers loaded on the map with the ability to show only locations of a particular category. I think this is a good idea because it gets the user to see many locations quickly,  but I also want users to be able to quickly browse all locations on our app by other criteria like price, and mood, and not just by category.  

Similarly, Yelp and Foursquare offer quick category selections right under the search bar in the main screen of both platforms. You can click on one and it will show you results for all locations in that category near you. However, in my findings I found that the variety of locations you can browse through quick selection is very limited as there are only a few categories that you could browse. The variety of the locations you can find with quick filters is very limited  because the quick browse options themselves seem to mostly revolve around food. Because of this, I want there to be a comprehensive but quick way to browse locations near you in my platform. As an alternative, I thought it would be useful to have a component easily accessible in the main page, that allows you to quickly browse all locations by mood and/or category. Unlike Yelp and Foursquare, I want my platform’s quick browse options to cover a wide variety of activities.


Another thing I noticed in using these different platforms is that  in all of these platforms, there is a consistent lack of  price information for all locations that are not restaurants and when price information is available it is not highlighted. Google searches had the most consistent availability of a labeled cost of location, but even then many places still did not list any price estimates. Additionally, for the platforms that do show price estimates, usually a specific number of dollar symbols is used to represent the average cost of a location. In my experience, it can be confusing knowing exactly how much someone might spend with this method. That is why in my web app, I want there to be clear labeling of location costs when browsing locations using dollar values. 

The last thing I will note about the list of related platforms is that they consistently do not provide anything more than a summary about the locations. Many places do not even have personally researched summaries. In Yelp, when a brief summary is available,it is not placed in a location where users can easily find it. With Spotted By summaries are consistently provided but are also excessively long which makes it more difficult to view other information about that place like hours of operation. With Google search summary information is less consistent. Sometimes summaries are provided but not shown. But many places have no summary at all. At lastly, foursquare offers no summaries about location but instead it highlights user reviews. 

As you can see, many popular location discovery apps struggle with providing high quality researched information about each location like a summary about the location, things to do at a location, and even insider tips for that location. I want this to be an essential part of what makes my web application different. I believe this is important because too often these apps try to fit as many locations into their platform as possible by providing high quality information about each one. I think this can lead to having too many places to browse with not enough relevant information about each one. I think this results in people often being bombarded with a list of places without learning much about each location and what makes each place unique. I believe this lack of personalized information about each location is a major reason people end up not going anywhere. This is why I want to develop a platform that makes it easier to find high quality information about a variety of places around Los Angeles in the hope that it increases the chances that users will go out and explore Los Angeles more.


\section{Methods}
Web App Design Process:

In order to determine how to design a location discovery app that fulfills my project goal, I used assessments of other popular location discovery platforms Google Search, FourSquare, Spotted by Locals, and Yelp. I did this in order to determine common flaws in their design but also useful features.  Once I evaluated the flaws and strengths of each app. I brainstormed and planned several possible solutions. Once I determined possible solutions, I generated questions to ask interview participants  in order to get their opinion on my proposals. Getting user input is an essential part of user centered design which is why interviewing participants was necessary. This supports methods of design that Shasha Constanza check and helps contribute towards design justice\cite{Chock20}. This is also what is typically done professionally when a new app is being developed. However, a notable difference is that each user’s input will have a significant impact on how the app is designed because my interviews will contain a small number of participants. In professional app development, initial interview participant groups for new products are usually significantly larger in terms of number of participants. I decided for the individual constraints of my project, user interviews would be best.

I wanted user input to be very essential in the design of my web app. Because of that I wanted to engage participants in the design process of my web app. In total, I interviewed 14 people. The people that participated were all currently living in Los Angeles. The people I interviewed were a combination of students walking around on Occidental College’s campus, people waiting at a busy stop, and people that I know personally that are currently living in Los Angeles.  I began by asking them several questions to get them familiar with what my app is trying to solve along with their  personal opinion on the topic of location discovery platforms. What was a relief to find out was that everyone agreed that the products that currently exist to find interesting,affordable locations are not very good. Additionally, when I asked if they want to go out more than they currently do, the majority of them said yes. 

An interesting result from my interviews was that lot of people said they do not go out because according to own self reporting, they do not know of a lot of places. This made me confident in continuing to pursue my idea.

 I also thought it was significant that the only other two reasons people said they do not go out as much as they'd like is because they are too busy or they can’t afford to go out more. This made me believe my ideas would be well received as part of what I am trying to do differently with my platform is save people time from having to personally research places they are interested in by having one centralized platform that allows you to browse a large variety of free and low cost locations. 

When I asked them what method they use to discover locations, 9 out of the 14 participants said they used Google Search. This was what I hypothesized early on in my app design planning.  Additionally, my interview participants mentioned using 3 of the 4 platforms I analyzed. This was good as it meant my research into other popular alternatives was accurate and also my solutions would be relevant to these participants.

In order to make this platform different from others and actually encourage people to discover locations, I decided to focus on three major areas. As mentioned before, I found a lack of diversity in terms of methods to discover relevant locations, a lack of clear labeling of costs of a location along with locations oftentimes missing data about costs, and a lack of an easy to use UI that only lists essential and personalized information about each location. When I conducted my interviews I asked my participants whether they thought my proposals would be useful or not.  The complete collection of raw interview data can be found in the Interview Data Folder of this Github project. 

In order to address the first problem of lack of ways to discover new places other than search, I proposed the idea to implement browsing by mood, browsing by category, and viewing all the locations with the ability to quickly filter all locations.I also made it clear that I would also include a standard search bar at the top.  When I proposed these features to my interview participants, 13 out of 14 participants supported implementing the feature. 

In order to solve the second problem of  a lack of clear labeling of costs of a location along with locations oftentimes missing data about costs I decided to make sure to include and highlight cost details in  USD  as opposed to more ambiguous values like number of dollar signs for every location listed.  When I proposed these features to my interview participants, 14 out of 14 participants supported implementing the feature. 

Lastly, in order to make the UI simple yet rich, I proposed using a minimalism design approach that provides only  essential details about a place along with personalized information about each location. I think providing things  like a brief summary, things to do, and insider tips for each location would be incredibly useful and effective in getting people to feel confident enough to explore somewhere because they might feel properly informed of what to do at that location. This could be true as many interview participants themselves said they do not go out as much as they would like simply because they do not have the knowledge of where to go.  All 14 interviewees said they  support researching places individually in order to provide personalized information about each location. 

For the last question of my interview I asked my participants if they had any suggestions for features they would use if they were to use my proposed web app. There were many different responses but common responses suggested making my web app really simple to use, showing only the most important things and not other things like advertisements or data input inquiries such as in with Google. Other suggestions included implementing a way to save locations one is interested in for future reference, the ability to view locations on a map, always show you places near you, and to be able to easily view photos of each location. Some of these features are also features I identified similar popular platforms have. Because of this, I decided to implement these suggested features. 
 
Since the majority of participants supported all three of my proposed solutions to this problem, I decided to continue pursuing the project and develop a web application that attempts to address the 3 common faults that I determined are present in existing platforms. I believe the faults I identified in popular location discovery apps contribute to the larger problem at hand. This problem is that people are not satisfied with using current platforms for discovery locations.  I found this reflected in my test results as 12 out of 14 people I interviewed wished there was a better solution to discover new places around you. In addition to implementing the features that the majority of people supported, I decided to  implement features that people suggested. This is part of what is typically done in user centered design.

In addition to the features I decided to implement because of the result of user input, I also decided to add features that other related platforms have like the ability to search by text, easily get directions, website and phone data, search by filter, etc…

Software Development


In order to actually begin software development of  the web app, I used Webflow to design how the web app would look with static content. This allowed me to more quickly develop the front end of my web app because Webflow generates static HTML along  with the CSS styling files. Other methods to design an interface include wireframing and then using some sort of photoshop software to design user interfaces. These methods are effective, however given the time constraints of this project it was not possible.


Since the initial designs of my web app that I planned after assessing my participant interview results, the general structure of my web app has not changed. The minor changes that were made were the result of biweekly in class  presentations and one on one progress updates with my computer science senior comprehensive project professor. After formal evaluations of my app  were conducted, more important design choices were made. This will be discussed further in the Evaluation Metrics section of this paper.

In order to create an interface  that has different methods of discovering new places like browsing by mood, browsing by category, search, and filter searches I know I had to implement several forms in the front end which would then query and return data from a database. This is what is known as a full stack app. 

There are several tech stacks that are popular to use in order to build responsive web apps. This is what I need as it would be unnecessary and not the best use of my time because if it were to be static content, I would have to create a separate webpage for each location and it just would not be possible to have all the features that I want to implement. That is why I needed to build a dynamic web app. Common tech stacks that allow this include LAMP, MEAN, and MERN stacks. The main reason I chose to use a LAMP stack as opposed to using a MEAN, MERN, or Python-Django stack is that, given the time constraint of this project, it is the simplest and quickest stack to implement, especially given that I had prior knowledge of PHP. 

Since I decided to use a LAMP stack, my database had to be a MySQL database. In this database I provide essential details about various locations that I researched. Standard location details shout locations were obtained through Google Places API’s and were placed in the MySQL database and identified by a “Place ID”. I used that “Place ID” to combine multiple tables into one to be able to create a table that contains all the information about each location. Additionally, there are other tables in the MySQL relational database that allow for organization and access of other content like reviews, photos, moods, and categories. All of these are connected in a relational database by their “Place ID” as their primary identifying key. MySQL uses primary keys to link different MySQL tables. This allows different tables to be queried at once to generate useful information. In my case I used this to link more complex information like Photos for each location.

I also needed a way to retrieve the location data based on user input and then render that into its proper location in the front end. I decided to use PHP as I am using a LAMP stack. PHP also allows you to store/retrieve information that is stored on the backend of your web app and then render PHP content to contain data from MySQL which essentially allows you to create a fully functional web app. I converted my static HTML pages generated from Webflow into PHP to be able to generate dynamic content with the front end components that I created in Webflow. Since creating them in webflow, I have tweaked and redesigned them to be in PHP. This allowed me to implement many of the features I wanted. PHP allows you to use javascript in your PHP files. This was very useful for both generating dynamic content but also for adding functionality.

In order to implement features like having an interface where you can store liked locations and to be able to show results based on your current location, local storage and cookies were used. They were necessary because my web app needed different ways to be able to store data. Local storage was used to store data for when you’re using it so it does not have to ask you for your location each time it wants to use your location data. Local storage allows you to store a user’s location after you ask for it once so that you do not need to get a user's location for each webpage. Additionally, cookies were used to be able to save locations and then generate content based on that saved information. I wasn't able to simply use local storage because local storage runs on the client side in Javascript and I need php to be able to access. This is not possible however as PHP runs on the server side. This actually was a big issue  that I could not figure out until I used cookies. 

FInally, in order to get live information about locations and other useful interfaces I decided to use multiple Google Platform API’s. The API allowed me to implement multiple map views when viewing location results, get live data like if a location is open now, and automatically calculating and displaying ETA’s for all possible modes of travel from your location to a selected location. I implemented these features mainly using Javascript. I chose to use Google to source place details for two reasons: it was free compared to other alternatives like Trip Advsior and it will contain the same basic information  the majority of people see when they discover new locations. This is because, as stated before, 9 out of 14 of my participants use google to discover new locations. 

All of my testing and debugging of my software was done in the platform where I am hosting all the files necessary for my web app. The platform I used to host my website and all the necessary files in Hostinger. Whenever I would run into a problem, I would mainly just need to print variables or arrays to see where I was going wrong. For example, an issue that took me a while to fix was the ability to automatically return results based on proximity to you. I fixed the issue after lots of print statements that allowed me to see where in my code something was going wrong. In this example, what was going wrong was that a certain PHP sorting method didn't not know how to handle an array of non-object classes. This made it return unexpected results each time which confused me significantly for a while. It was not till I tried printing the values it was reading from the array that I realized it was an issue relating to the type of array it was. Additionally, internet searches were very useful when I ran into various types of issues.

\section{Evaluation Metrics}
In order to evaluate the effectiveness of my web app, I used guided observations and anonymous survey questions. This is similar to what others in the software development field  have used to evaluate the effectiveness of new software that attempts to solve a problem. An example of this can be seen in the field evaluation portion of a published research paper about the effectiveness of a new software design that attempts to solve the existing problem of lack of integration of  Intelligent Decision Support into Critical, Clinical Decision-Making Processes despite Intelligent Decision Support systems already existing \cite{unremarkableAI}. Researchers of this paper were trying to create a new system that Doctors and other medical professionals would actually use in real life. At the time the paper was written, software existed to help doctors make more intelligent decisions. However, the problem was doctors rarely used them and were overall not satisfied with using existing systems. This is why they set out to redesign an Intelligent Decision Support system that takes into account real world identified flaws in existing platforms and user specific needs. In order to test the effectiveness of their software compared against other existing systems, they used a combination of observation of potential users and various types of interviews. This is relevant as this is similar to what my web app is trying to do. To be specific , my location discovery web app attempts to give a solution to the problem of people not being satisfied with existing location discovery software by redesigning a new location discovery app that takes into account the flaws that current location discovery apps were identified to have along with user needs. My hope is that by providing a platform that addresses the flaws that were identified, it  would lead to people going out more because the process of discovering new places would be faster and simpler thanks to my web app.  For these reasons, my method of evaluations was similar. 

In the previously mentioned research team’s paper, they used observations and interviews. However for my project purposes I decided to use observations and anonymous surveys. I decided to use anonymous surveys instead of interviewing people in person because I believe it will make people more inclined to share their true thoughts. I believe the guaranteed anonymity of a post test evaluation survey after they use the web app would make it so that people are less inclined to alter their true thoughts in order to avoid hurting my feelings. The issue of participant bias is also a reason why observations are a better solution sometimes for app evaluation methods. I wanted to remove as much bias as possible especially because I personally knew several of my participants.  

Additionally, I did consider other methods of evaluation, however I determined that they were not feasible given the limited time scope of this project. Because of this, I could not engage in other, possibly more accurate for my purposes, forms of evaluation. The other form of elevation that would've been useful in more accurately determining if my app actually made people go out at a higher rate than before using my app  would be to evaluate user behavior over time. To be specific, I would have participants use the app when they want to discover a new location and researchers and then over time measure the frequency with which they went out. In order to do this method, I would also have to have tracked the frequency with which they went out before using my app. This way we could more accurately determine the  effectiveness of the main project goal which is to get people to go out more. 

I had several questions I wanted to find out from my observations, including: (1) Do people use the non-traditional methods of discovering locations which are discover by mood, discover by category, or quick browse with the ability to filter ? (2) Do they seem interested in the personalized information provided for each location or in the other unique details my app provides about location such as an aerial view of each location?(3) Do people seem to be able to easily navigate the app?(4) Do people think they are more likely to go out and explore locations as a result of discovering said locations on my web app?

Assessment Using Observation

For my assessments via observation, I observed the behavior of 14 people total while using my app. Each observation took place independently meaning each one happened at a different time and place. In each observation I assessed each of the four questions. In order to answer the first question, I observed whether they used the location discovery methods and not just the common search function available in most location discovery apps. In order to answer the second question, I observed what content they would focus on when they would look at a detailed view for each location. In order to answer my third question, I observed whether participants seemed frustrated and also if they use the various features my app has.   It was difficult to answer the fourth question via observation, but I determined I could potential  determine if a participant seemed more interest in going out to visit one of the locations of my app using two cues: if people add location to their favorites in the web app or if if there is any positive change in behavior after viewing the locations on my app.

Additionally, I used observations about which features people used and did not use in order to create a final version of my web app. 

Assessment Using Anonymous Surveys

For my assessments via anonymous surveys, I instructed each of my participants to complete a survey shortly after using the web app. I assured them survey responses would be anonymous to encourage them to answer with how they truly felt. I instructed them to fill it out as soon as possible so they do not forget their experience using the web app but also not to feel rushed to do so immediately. In the survey questions, I attempted to answer each of the four questions mentioned previously. In order to answer the first question, I asked them if they found the ability to browse by mood, category, or quick filters in the home screen more useful than just containing a search bar. In order to answer the second question, I asked whether they found the personalized and thorough details about each location useful in feeling like they learned useful information about the location and whether or not they felt confident enough to actually visit any specific locations. In order to answer my third question, I simply asked them about their personal thoughts on the ease of use of the web app.    Finally, in order to answer the fourth question, I also simply asked people if they believe they are more likely to go out and explore new locations via discovering them on my web app. Additionally, I asked participants if they had any suggestions or comments for the app to let me know there. I took these considerations into account along with my user observations in order to create a final version of my web app. 


\section{Results and Discussion}



It seems as though my web app was successful in potential getting people to go out more according to the results of my evaluations. What I found was that according to participant users of the web app, they would go out more often  if they were to start using this app  to discover new locations. I will list some notable findings.

Specifically, the majority (8/10)  of the participants of my anonymous surveys said that they are more likely to go out and discover new locations now that they know they can use my web app. Additionally, I found that users were indeed using the alternate approaches to discover locations, especially discover by mood. This was confirmed with my findings in both observation and in survey responses. 
Lastly, participants overwhelmingly liked the researched details about each location with several of my participants commenting that they like they are excited to go to a location and because of an insider tip provided at a location. 


In conclusion I believe that my app, and larger project goal, was achieved. I developed a web app that makes it easier to discover and learn about new locations in order to get people to go out more according to the results of my evaluations.

However it is important to note two important facts: specific data like the increase in frequency of users going out before and after using the app is not available and my participant group sizes are very small. As stated before, this was only because of the limited time frame of the project. In the future with more resources and time, a more accurate evaluation of my app that includes measures of  the rates at which people go out  and more participants.



\section{Ethical Considerations}
There might be bias in evaluation and design because I personally knew some of my participants. Also it is important to note that my methods of determining effectiveness of my app may also be biased because of the methods of evaluation. If I had more time I could more accurately determine if people actually went out at a higher rate. Instead, currently methods of evaluation could also be biased to do with the fact that we are replying on user feedback This is even more likely because I personally knew some of the participants of my interviews, observations, and surveys. However, in an attempt to combat this I used two different methods to evaluate my project goal: observation evaluations and anonymous surveys. 


Additionally, my app requires an active internet connection which disadvantages lower income people. However, it attempts to combat any disadvantages for low income people by offering a platform that makes it easier to discover affordable locations.  

Additionally, potential ethical issues in data bias could exist. I am a straight cisgender middle class male Latino Computer Science major who was raised Catholic and am attending a prestigious private liberal arts college. I am not an expert by any on locations around Los Angeles. The places I selected could be very bias to things I enjoy. There could also be bias is what moods I determined corresponded with each category in my database. This could lead to false information being incorporated into my app. I am aware of my privileges as a male cisgender identity as well as my ethnicity as a Latino person. Because of this, I will try to be actively aware of designing my app to be as unbiased as possible. To this point, Sasha Costanza-Chock in her book design justice talks about how when we design products, we must design them with the community it is intended to help in order to meet their needs and remove our own biases\cite{Chock20}. Chock notes that most designers "do not think of themselves as sexist, racist, homophobic, etc..", however, their own perspectives may inhibit their ability to see how their design choices negatively affect oppressed communities\cite{Chock20}. I included user input input in planning the design of my app so that is useful in making sure potential users are included in the design process.


\printbibliography 

\end{document}
