
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-CreateOrder</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o&libraries=places"></script>
    <script type="text/javascript" src="../JS/googlemap.js"></script>
   <script>
    
function desinationlocation(){
    var options = {
    componentRestrictions: {country: "TZ"}
 };
    var input=document.getElementById('fromlocation');
    var fromlocation=new google.maps.places.Autocomplete(input,options);
    google.maps.event.addListener(fromlocation, 'place_changed', function () {
        var place = fromlocation.getPlace();
        document.getElementById('fromLat').value = place.geometry.location.lat();
        document.getElementById('fromLng').value = place.geometry.location.lng();
    });
}
    function deliverylocation() {
        var options = {
    componentRestrictions: {country: "TZ"}
      };
    var input = document.getElementById('deliverylocation');
    var autocomplete = new google.maps.places.Autocomplete(input,options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('delvLat').value = place.geometry.location.lat();
        document.getElementById('delvLng').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', deliverylocation);
google.maps.event.addDomListener(window, 'load', desinationlocation);

function getDistance()
  {
     //Find the distance
     var distanceService = new google.maps.DistanceMatrixService();
     distanceService.getDistanceMatrix({
        origins: [$("#fromlocation").val()],
        destinations: [$("#deliverylocation").val()],
        travelMode: google.maps.TravelMode.WALKING,
        unitSystem: google.maps.UnitSystem.METRIC,
        durationInTraffic: true,
        avoidHighways: false,
        avoidTolls: false
    },
    function (response, status) {
        if (status !== google.maps.DistanceMatrixStatus.OK) {
            console.log('Error:', status);
        } else {
            console.log(response);
            $("#distance").text(response.rows[0].elements[0].distance.text).show();
            $("#duration").text(response.rows[0].elements[0].duration.text).show();
        }
    });
  }
  jQuery(document).ready(function(){
            jQuery('#domesticbutton').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('centerorder/calculate') }}",
                  method: 'post',
                  data: {
                     name: jQuery('#name').val(),
                     type: jQuery('#type').val(),
                     price: jQuery('#price').val()
                  },
                  success: function(result){
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success);
                  }});
               });
            });

            //find total
            function findTotal(){
    var arr = document.getElementsByName('value');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot =parseFloat(arr[i].value)/10;
    }
    document.getElementById('ordercost').value = tot;
}

      
   </script>

</head>
<body class="has-fixed-sidenav">
    <header>
        @include('centers.nav')
    </header>
    {{-- main --}}
    <main>
        <div class="progress" id="loading">
            <div class="indeterminate"></div>
        </div>   
            <div class="container page" style="display: none;">
                <div class="row">
                    <div class="col s12">
                        <div class="receipt-main card-content">
                            <h6 class="blue-text centered-text">Create New Order</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('failed'))
                            <div class="red-text">
                            <h6 class="red-text">{{ $message }}</h6>
                            </div>
                            @endif
                            <form method="" action="">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">subtitles</i>
                                        <select id="ordertype" name="ordertype"class="validate" required>
                                            <option value="" disabled selected>Please select Order Type</option>
                                            <option value="domestic">Domestic</option>
                                            <option value="regional">Regional</option>
                                            <option value="international">International</option>
                                        </select>
                                        <label for="ordertype">Order Type</label>
                                        <span class="helper-text" data-error="please enter your password" data-success="right"></span>
                                    </div>
                                    <div id="domestic" style="display: none;">
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">subtitles</i>
                                            <select id="transport" name="transport"class="validate" >
                                                <option value="" disabled selected>Please select Transportation Type</option>
                                                <option value="motocyle">Motocyle</option>
                                                <option value="carry">Carry</option>
                                                {{-- <option value="kenter">Kenter</option> --}}
                                            </select>
                                            <label for="transport">Transportation Type</label>
                                            <span class="helper-text" data-error="please enter your password" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">location_on</i>
                                            <input id="fromlocation" name="fromlocation" type="text" class="validate" >
                                            <label for="fromlocation">From location</label>
                                            <input type="hidden" id="fromLat" name="fromLat" />
                                            <input type="hidden" id="fromLng" name="fromLng" />
                                            <input type="hidden" id="distance" name="distance" />
                                            <span class="helper-text" data-error="please select valid location" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">location_on</i>
                                            <input id="deliverylocation" name="deliverylocation" type="text" class="validate" >
                                            <label for="deliverylocation">Delivery location</label>
                                            <input type="hidden" id="delvLat" name="delvLat" />
                                            <input type="hidden" id="delvLng" name="delvLng" />
                                            <span class="helper-text" data-error="please enter valid location" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">money</i>
                                            <input id="ordervalue" name="ordervalue" type="number" class="validate" >
                                            <label for="ordervalue">Order value</label>
                                            <span class="helper-text" data-error="please enter valid order value" data-success="right"></span>
                                           </div>
                                        {{-- <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">schedule</i>
                                            <input id="delvltime" name="delvltime" type="text" class="timepicker" >
                                            <label for="delvltime">Delivery Time</label>
                                            <span class="helper-text" data-error="please enter valid delivery time" data-success="right"></span>
                                        </div> --}}
                                    </div>
                                    <div id="regional" style="display: none;">
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">location_on</i>
                                            <input id="pickup" name="pickup" type="text" class="validate" >
                                            <label for="pickup">Pick up location</label>
                                            <span class="helper-text" data-error="please enter valid pickup location" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">location_on</i>
                                            <input id="dellocation" name="dellocation" type="text" class="validate" >
                                            <label for="dellocation">Delivery location</label>
                                            <span class="helper-text" data-error="please enter valid delivery location" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">category</i>
                                            <input id="percelsize" name="percelsize" type="text" class="validate" >
                                            <label for="percelsize">Percel Size</label>
                                            <span class="helper-text" data-error="please enter valid percel size" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">money</i>
                                        <input id="value" name="value" type="number" class="validate" onblur="findTotal()" >
                                        <label for="value">Order value</label>
                                        <span class="helper-text" data-error="please enter valid order value" data-success="right"></span>
                                       </div>
                                       <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">money</i>
                                        <input id="ordercost" name="ordercost" type="number" class="validate" >
                                        <label for="ordercost">Transport Cost</label>
                                        <span class="helper-text" data-error="please enter valid order value" data-success="right"></span>
                                    </div>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">subtitles</i>
                                        <input id="details" name="details" type="text" class="validate" >
                                        <label for="details">Order Details</label>
                                        <span class="helper-text" data-error="please enter valid order details" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">payment</i>
                                        <select id="paymentype" name="paymentype"  class="validate">
                                            <option value="" disabled selected>Please select Payment Type</option>
                                            <option value="Order Fully Paid">Order Fully Paid</option>
                                            <option value="Customer Pay Full">Customer Pay Full</option>
                                            <option value="Customer Pay Order">Customer Pay Order</option>
                                            <option value="Customer Pay Delivery">Customer Pay Delivery</option>
                                        </select>
                                        <label for="paymentype">Payment Type</label>
                                        <span class="helper-text" data-error="please enter valid payment method" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="receivernames" name="receivernames" type="text" class="validate" >
                                        <label for="receivernames">Receiver names</label>
                                        <span class="helper-text" data-error="please enter valid names" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="receiverphone" name="receiverphone" type="text" 
                                       pattern="[0]{1}[1-9]{1}[0-9]{8}" class="validate" >
                                        <label for="receiverphone">Receive Phone Number</label>
                                        <span class="helper-text" data-error="please enter valid phone number" data-success="right"></span>
                                    </div>
                                    <input class="btn right blue" type="submit" formmethod="POST" formaction="{{route('orders.store')}}" value="Create">
                                    <div></div>
                                    <button class="btn left blue" formaction="{{route('calculate')}}" 
                                     formmethod="POST" id="domesticbutton" style="display:none ;">GET COST
                                    </button>
                                </div>
                            </form>
                            @if ($message = Session::get('cost'))
                            <div class="blue-text">
                            <p class="blue-text">{{ $message }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </main>
       <!-- Scripts -->
       <script src="../JS/jquery.min.js"></script>
       <script src="../JS/moment.min.js"></script>
       <script src="../JS/selector.js"></script>

       <script type="text/javascript" src="../JS/Chart.js"></script>
       <script type="text/javascript" src="../JS/Chart.Financial.js"></script>
       <script src="../JS/fullcalendar.min.js"></script>
       <script 
       type="text/javascript" src="../JS/datatables.min.js"></script>
       <script src="../JS/imagesloaded.pkgd.min.js"></script>
       <script src="../JS/masonry.pkgd.min.js"></script>

       <!-- Initialization script -->
       <script src="../JS/admin-materialize.min.js"></script>
       <script src='../JS/preloader.js'></script>
       <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
      </script>

</body>
</html>