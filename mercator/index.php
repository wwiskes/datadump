
<?php 
include("Mobile_Detect.php");

//mobile detect
$detect = new Mobile_Detect;
if ($detect->isMobile() || $detect->isTablet()) {
?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Map not active</title>
    <style>
      html,body { margin:0; padding:0; }
      html {
        background: Gray;
      }
      body {
        font-family: sans-serif;
        color: #FFF;
        text-align: center;
      }
      h1, h2 { font-weight: normal; }
      h1 { margin: 0 auto;  padding: 0.15em; font-size: 5em; text-shadow: 0 2px 2px #000; }

    </style>
  </head>
  <body>
    <br>
    <h1>⚠</h1>
    <h2>I'm Sorry</h2>
    <p>This map will not function on a tablet or phone.</p>
    <p class="desc">Please try again on a desktop computer.</p>
  </body>
</html>
  
<?php
} else {
  ?>
 <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="a pretty cool map">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>Mercator Map</title>
  
    <link href="https://unpkg.com/normalize.css/normalize.css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/solarized-light.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet" />
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/languages/javascript.min.js"></script>
    <script src="Leaflet.TrueSize.umd.js"></script>
      <script src="Leaflet.CountrySelect.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
  
    <style>
    html,
    body {
      height: 100%;
      height: 100%;
    }
  
    html {
      font-family: 'Roboto', sans-serif;
      color: #212121;
      background: #fefefc;
      line-height: 1.4;
    }
  
    table {
      border-collapse: collapse;
      width: 100%;
    }
  
    table th {
      text-align: left;
      padding: 0 .75em
    }
  
    thead {
      border-bottom: 1px solid #D4D4D4;
    }
  
    thead div {
      padding-bottom: .75em;
    }
  
    tbody tr:nth-child(even) {
      background: #FDF9F7
    }
  
    td {
      padding: 1em .7em;
    }
  
    a {
      color: #64A7D9;
      text-decoration: none;
    }
  
    pre {
      margin: 0;
    }
  
    code, .code {
      font-size: 15px;
      font-family: "Roboto Mono";
    }
  
    .code.option {
      color: #64A7D9;
    }
  
    .hljs {
      background: none;
      padding: 0;
      overflow-x: visible;
      line-height: 1.3;
      color: #64A7D9;
    }
  
    .hljs.shell {
      color: #676788;
    }
  
    .hljs-number {
      color: #D6428D;
    }
  
    .hljs-attr {
      color: #676788;
    }
  
    h1, h2, h3 {
      font-weight: 300;
      margin: 0;
    }
  
    header {
      text-align: center;
      margin: 3em 0 2em 0;
    }
  
    .toparrow {
      display: none;
    }
  
    .subtitle {
      color: #454545;
      margin-top: .5em;
      font-size: 1.2em
    }
  
    .sectiontitle {
      margin: 2em 0 1em 0;
      font-size: 1.2em;
    }
  
    .centered {
      width: 100%;
      margin: 0 auto;
      max-width: 1000px;
      padding: 0 12px;
      box-sizing: border-box;
    }
  
    .bg {
      width: 100%;
      padding: 1.5em 0;
      background: #FDF9F7;
    }
  
    .map-wrapper {
      position: relative;
    }
  
    .activate-btn {
      position: absolute;
      top: 12px;
      left: 12px;
      z-index:1000;
      background: #FDF9F7;
      padding: .5em 1em;
      font-family: 'Roboto', sans-serif;
      border: none;
      border-radius: 1px;
      font-size: 13px;
      box-shadow: 0 0 1px 2px rgba(0, 0, 0, .12);
      font-weight: 700;
      color: #676788;
      cursor: pointer;
      opacity: .5;
      transition: .35s opacity;
    }
  
    .activate-btn:hover {
      opacity: .8;
      box-shadow: 0 0 4px 3px rgba(0, 0, 0, .15);
    }
  
    #map {
      width: 100%;
      height: 100vh;
    }
  
    .leaflet-tile-container img {
      filter: contrast(1.15);
    }
  
    footer {
      padding:4em 0 3em 0;
      position: relative;
    }
  
    @media screen and (min-width: 768px) {
      header {
        margin: 6em 0 6em 0;
        position: relative
      }
  
      .title {
        font-size: 2.8em;
      }
  
      .subtitle {
        margin-top: .3em;
        font-size: 1.2em
      }
  
      .sectiontitle {
        font-size: 1.5em;
        margin:4em 0 1.2em 0;
      }
  
      #map {
        height: 450px;
      }
  
      footer {
        padding:8em 0 70px 0
      }
    }
    </style>
  </head>
  <body>
  
    <div id="docs">
  
      <div class="centered">
  
  
        <div class="map-wrapper">
          <div id="map"></div>
  <!--        <button class="activate-btn">Activate Map</button>-->
        </div>
  
      </div>
  
  
  
   
  
  
    </div>
  
    <script>
      const map = L.map('map', {
        center: [0, 0],
        zoom: 1,
        zoomControl: false,
        zoomDelta: .25,
        zoomSnap: .25
      });
  
      //let isEnabled = false;
      disableMap();
  
      //L.control.zoom({ position: 'bottomright' }).addTo(map);
  
      new L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_nolabels/{z}/{x}/{y}.png', {
        attribution: `by Will Wiskes`,
        detectRetina: true
      }).addTo(map);
        
  //          new L.tileLayer('https://{s}.tile.jawg.io/jawg-light/{z}/{x}/{y}{r}.png?access-token={PuJjo521DGJdetckBeCb8KZp9hnqPuThY11wiowdUMdniqyLkZCMSa6aqsnVtKd3}', {
  //      attribution: `by Will Wiskes`,
  //      subdomains: 'abcd',
  //              accessToken: 'PuJjo521DGJdetckBeCb8KZp9hnqPuThY11wiowdUMdniqyLkZCMSa6aqsnVtKd3'
  //    }).addTo(map);
        ///////////////////////////////////////////////////////////////////////////////////////
        var select = L.countrySelect({exclude:"French Southern and Antarctic Lands"});
  
        select.addTo(map);
        var indi = [];
  
            //  var coun = [];
        select.on('change', function(e){
          if (e.feature === undefined){ //Do nothing on title
            return;
          }
          country = L.geoJson(e.feature);
          if (this.previousCountry != null){
            map.removeLayer(this.previousCountry);
          }
          this.previousCountry = country;
          
      //		map.addLayer(country);
                //  console.log(country._layers)
                  for (var key in country._layers) {
                            if (country._layers.hasOwnProperty(key)) {
                              console.log(key);
                            }
  
                          }
          
                  var upd = country._layers[key]
              //    console.log(upd.feature)
                  var indi = upd.feature
                    
        var color;
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  color= "rgb("+r+" ,"+g+","+ b+")"; 
                  
                        var color2;
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  color2= "rgb("+r+" ,"+g+","+ b+")"; 
  //               var obj = new Object(indi);
    //               console.log(obj)
      //            var user002 = Object.create(obj);
        //          console.log(user002.__proto__)
          //            new L.trueSize(user002.__proto__).addTo(map); 
     
                  
                    //      map.addLayer();
        //    var now = new L.trueSize(indi).addTo(map);
  //				map.fitBounds(country.getBounds());
                    new L.trueSize(indi, {color: color2, fillColor: color}).addTo(map);
          
        });
        ///////////////////////////////////////////
      
  
      // const activateBtn = document.querySelector('.activate-btn');
      // activateBtn.addEventListener('click', () => {
      //   if (isEnabled) {
      //     activateBtn.innerHTML = 'Activate Map';
      //     disableMap()
      //   } else {
      //     activateBtn.innerHTML = 'Deactivate Map';
      //     enableMap()
      //   };
      //   isEnabled = !isEnabled;
      // });
  
      function disableMap() {
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();
        //if (map.tap) map.tap.disable();
        document.getElementById('map').style.cursor='default';
      }
  
      function enableMap() {
        map.dragging.enable();
        map.touchZoom.enable();
        map.doubleClickZoom.enable();
        map.scrollWheelZoom.enable();
        map.boxZoom.enable();
        map.keyboard.enable();
        if (map.tap) map.tap.enable();
        document.getElementById('map').style.cursor='grab';
      }
  
    </script>
  
    <script>
      // create options table
      // const options = [{
      //   option: 'className',
      //   type: 'String',
      //   default: null,
      //   description: 'Custom class name for the geojson feature'
      // }, {
      //   option: 'markerDiv',
      //   type: 'String',
      //   default: null,
      //   description: 'Custom html icon'
      // }, {
      //   option: 'markerClass',
      //   type: 'String',
      //   default: null,
      //   description: 'Custom html icon class'
      // }, {
      //   option: 'iconAnchor',
      //   type: 'Array',
      //   default: '[]',
      //   description: 'Point of the icon which will correspond to marker position'
      // },{
      //   option: 'color',
      //   type: 'String',
      //   default: '#FF0000',
      //   description: 'Stroke color'
      // }, {
      //   option: 'stroke',
      //   type: 'Boolean',
      //   default: true,
      //   description: 'Stroke visibility'
      // }, {
      //   option: 'weight',
      //   type: 'Number',
      //   default: 1,
      //   description: 'Stroke width in pixels'
      // }, {
      //   option: 'opacity',
      //   type: 'Number',
      //   default: 1,
      //   description: 'Stroke opacity'
      // }, {
      //   option: 'lineCap',
      //   type: 'String',
      //   default: 'round',
      //   description: 'A string that defines shape to be used at the end of the stroke'
      // }, {
      //   option: 'lineJoin',
      //   type: 'String',
      //   default: 'round',
      //   description: 'A string that defines shape to be used at the corners of the stroke'
      // }, {
      //   option: 'dashArray',
      //   type: 'String',
      //   default: null,
      //   description: 'A string that defines the stroke dash pattern'
      // }, {
      //   option: 'dashOffset',
      //   type: 'String',
      //   default: null,
      //   description: 'A string that defines the distance into the dash pattern to start the dash'
      // }, {
      //   option: 'fill',
      //   type: 'Boolean',
      //   default: true,
      //   description: 'Fill visibility'
      // }, {
      //   option: 'fillColor',
      //   type: 'String',
      //   default: '#FF0000',
      //   description: 'Fill color'
      // }, {
      //   option: 'fillOpacity',
      //   type: 'Number',
      //   default: 0.3,
      //   description: 'Fill opacity'
      // }, {
      //   option: 'fillRule',
      //   type: 'String',
      //   default: 'evenodd',
      //   description: 'A string that defines how the inside of a shape is determined'
      // }];
  
      // const tbody = document.querySelector('#tbody-options');
  
      // const trs = options.map(o => (`<tr>
      //   <td class="code">${o.option}</td>
      //   <td class="code">${o.type}</td>
      //   <td class="code">${o.default}</td>
      //   <td>${o.description}</td>
      // </tr>`)).join('');
  
      // tbody.innerHTML = trs;
    </script>
  </body>
  </html>

   <?php
} ?>
