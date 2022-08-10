<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o&libraries=places"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.js"crossorigin="anonymous"></script> 
 <input id="autocomplete" placeholder="Enter your address" type="text" /><br/> <br/>
 
 <input type="text" id="mainAddress" /><br/><br/>
  <input type="text" id="locality" /><br/> <br/>
   <input type="text" id="postalcode" /><br/><br/>
   <input type="text" id="state"><br/><br/>
   <input type="text" id="city"><br/><br/>
 
 <script>
   service.getDistanceMatrix(request).then((response) => {
            var results = response.rows[0].elements;
            var distancesDOM = document.getElementsByClassName('distance');
            for (var j = 0; j < results.length; j++){
                var distance = results[j].distance.text;
                var duration = results[j].duration.text;
                var htmlContent = `<span><img src="//maps.gstatic.com/tactile/pane/travel-modes/2x/walk_black.png" style="opacity: .6; top: 16px; width: 22px; height: 22px;">${distance} - ${duration}</span>`;
                distancesDOM[j].innerHTML = htmlContent;
            }
        });
   </script>