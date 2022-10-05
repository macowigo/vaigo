
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-Dashboard</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <!-- Materialize-->
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <!-- Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
    <link rel="stylesheet" type="text/css" href="../datatable/style.css"/>
    
</head>

<body class="has-fixed-sidenav">
    <header>
       @include('admin.nav')
    </header>
<main>
<div class="progress" id="loading">
      <div class="indeterminate"></div>
  </div>
<div class="container page" >
    <div class="masonry row">
        <div class="col s12">  
        <h4 class="blue-text" >Dashboard</h4>
        <a href="{{route('centerlist')}}">
         <div class="col s12 m6 l4">
         <div class="card">
                <div class="card-stacked">
                    <div class=" card-metrics-static">
                        <div class="card-content">
                        <span><i class="material-icons">adjust</i> Vaigo Centers:</span>
                        <span >{{$centers}}</span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         </a>
         <a href="{{route('vendors')}}">
         <div class="col s12 m6 l4">
         <div class="card">
                <div class="card-stacked">
                    <div class=" card-metrics-static">
                        <div class="card-content">
                        <span><i class="material-icons">group</i> Vaigo Vendors:</span>
                        <span >{{$vendors}}</span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         </a>
         <a href="{{route('vaigoagents')}}">
            <div class="col s12 m6 l4">
            <div class="card">
                   <div class="card-stacked">
                       <div class=" card-metrics-static">
                           <div class="card-content">
                           <span><i class="material-icons">support_agent</i> Vaigo Agents:</span>
                           <span >{{number_format($agents)}}</span>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            </a>
         <a href="{{route('admdomestictoday')}}">
         <div class="col s12 m6 l4">
         <div class="card">
                <div class="card-stacked">
                    <div class=" card-metrics-static">
                        <div class="card-content">
                        <span><i class="material-icons">home</i> Today Domestic Orders:</span>
                        <span >{{$domestictoday}}</span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         </a>
         <a href="{{route('admregionaltoday')}}">
            <div class="col s12 m6 l4">
            <div class="card">
                   <div class="card-stacked">
                       <div class=" card-metrics-static">
                           <div class="card-content">
                           <span><i class="material-icons">apartment</i> Today Regional Orders:</span>
                           <span >{{number_format($regionaltoday)}}</span>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            </a>
         <div class="col s12 ">
            <div class="card">
             <div class="card-stacked">
             <div class="card-metrics-static">
             <div class="card-content">
               <h6 class="blue-text centered-text"><i class="material-icons">home</i> Domestic Orders</h6>
               <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle blue">pending_actions</i>
                    <span class="title blue-text"> Pending Orders</span>
                    <p class="blue-text">{{ $domesticpending}}</p>
                    <a href="{{route('admdompending')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                        <i class="material-icons">visibility</i></a>
                    </li>
                <li class="collection-item avatar">
                <i class="material-icons circle blue">add_to_queue</i>
                <span class="title blue-text"> Created Orders</span>
                <p class="blue-text">{{ $domesticcreated}}</p>
                <a href="{{route('admdomcreated')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                    <i class="material-icons">visibility</i></a>
                </li>
                <li class="collection-item avatar">
                <i class="material-icons circle blue">cancel</i>
                <span class="title blue-text"> Cancelled Orders</span>
                <p class="blue-text">{{ $domesticancel}}</p>
                <a href="{{route('admdomcancelled')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                    <i class="material-icons">visibility</i></a>
                </li>
                <li class="collection-item avatar">
                <i class="material-icons circle blue">rotate_right</i>
                <span class="title blue-text"> Delivering Orders</span>
                <p class="blue-text">{{ $domesticdeliver}}</p>
                <a href="{{route('admdomdeliver')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                    <i class="material-icons">visibility</i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="material-icons circle blue">incomplete_circle</i>
                    <span class="title blue-text"> Incomplete Orders</span>
                    <p class="blue-text">{{ $domesticinc}}</p>
                    <a href="{{route('admdominc')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                    <i class="material-icons">visibility</i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="material-icons circle blue">task_alt</i>
                    <span class="title blue-text"> Complete Orders</span>
                    <p class="blue-text">{{ $domesticcomp}}</p>
                    <a href="{{route('admdomcomp')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                    <i class="material-icons">visibility</i></a>
                </li>
            </ul>
               </div>
             </div>
             </div>
            </div>
           </div>

           <div class="col s12 m6 l6">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-metrics-static">
                        <div class="card-content">
                            <h6 class=" centered-text blue-text">Vaigo Staff Statistics</h6>
                            <script>
                                   var userdata = <?php echo $users; ?>;
                                    console.log(userdata);
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                    var data = google.visualization.arrayToDataTable(userdata);
                                    var options = {
                                        is3D:true,  
                                         pieHole: 0.4,
                                         colors:['#2F557F','#00b533','#40A8DD','#26A69A','#26A69A']
                                        };
                                    var chart = new google.visualization.PieChart(document.getElementById('users'));
                                    chart.draw(data, options);
                                    }
                            </script>
                      <div id="users"></div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-metrics-static">
                        <div class="card-content">
                            <h6 class=" centered-text blue-text">Vaigo Domestic Delivery Fee Statistics</h6>
                            <script>
                                   var orderdata = <?php echo $oders; ?>;
                                    console.log(orderdata);
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                    var data = google.visualization.arrayToDataTable(orderdata);
                                    var options = {
                                        is3D:true,  
                                         pieHole: 0.9,
                                         //colors:['#2F557F','#00b533','#40A8DD','#26A69A','#26A69A']
                                        };
                                    var chart = new google.visualization.PieChart(document.getElementById('orders'));
                                    chart.draw(data, options);
                                    }
                            </script>
                      <div id="orders"></div> 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col s12">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-metrics-static">
                        <div class="card-content">
                            <h6 class=" centered-text blue-text">Regional Orders Statistics</h6>
                            <script>
                                   var desinationdata =<?php echo $regionalorders; ?> ;
                                    console.log(desinationdata);
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                    var data = google.visualization.arrayToDataTable(desinationdata);
                                    var options = { colors:['#2F557F','#00b533']};
                                    var chart = new google.visualization.ColumnChart(document.getElementById('desination'));
                                    chart.draw(data, options);
                                    }
                            </script>
                             @if ($regional>0)
                             <div id="desination"></div> 
                             @else
                              <div>
                                <p class=" centered-text red-text">Sorry there is no any Desination Commision Statistics Found</p>
                                </div>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>  


    </div> 
</div>
            
</main>

    <!-- Scripts -->
    <script src="../JS/jquery.min.js"></script>
    <script src="../JS/moment.min.js"></script>

    <script type="text/javascript" src="../JS/Chart.js"></script>
    <script type="text/javascript" src="../JS/Chart.Financial.js"></script>


    <script src="../JS/fullcalendar.min.js"></script>
    <script type="text/javascript" src="../JS/datatables.min.js"></script>
    <script src="../JS/imagesloaded.pkgd.min.js"></script>
    <script src="../JS/masonry.pkgd.min.js"></script>


    <!-- Initialization script -->
    <script src="../JS/admin-materialize.min.js"></script>

    <script src='../datatable/jquery.js'></script>
    <script src='../datatable/datatable.js'></script>
    <script src="../datatable/script.js"></script>
    <script src='../datatable/buttonhtml5.js'></script>
    <script src='../datatable/buttonprint.js'></script>
    <script src='../datatable/datatablebuttons.js'></script>
    <script src='../JS/preloader.js'></script>
</body>
</body>
</html>