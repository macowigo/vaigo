
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
       @include('agents.nav')
    </header>
<main>
<div class="progress" id="loading">
      <div class="indeterminate"></div>
  </div>
<div class="container page" >
    <div class="masonry row">
        <div class="col s12">  
        <h4 class="blue-text" >Dashboard</h4>
         <a href="{{route('agenttodayorders')}}">
            <div class="col s12 m6 l4">
            <div class="card">
                   <div class="card-stacked">
                       <div class=" card-metrics-static">
                           <div class="card-content">
                           <span><i class="material-icons">today</i>Today Regional Orders: {{$ordertoday }}</span>
                           <span ></span>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            </a>
         <a href="{{route('agentmonthlyorders')}}">
         <div class="col s12 m6 l4">
         <div class="card">
                <div class="card-stacked">
                    <div class=" card-metrics-static">
                        <div class="card-content">
                        <span><i class="material-icons">calendar_month</i> {{date('F')}} Regional Orders: {{ $ordermonth }}</span>
                        <span ></span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         </a>
         <a href="{{route('agencommtoday')}}">
            <div class="col s12 m6 l4">
            <div class="card">
                   <div class="card-stacked">
                       <div class=" card-metrics-static">
                           <div class="card-content">
                           <span><i class="material-icons">payments</i> Today Commision:</span>
                           <span >{{number_format(($sumtodaymine/10 )+($sumtoday/20))}}</span>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            </a>
            <a href="{{route('agencommonthly')}}">
                <div class="col s12 m6 l4">
                <div class="card">
                       <div class="card-stacked">
                           <div class=" card-metrics-static">
                               <div class="card-content">
                               <span><i class="material-icons">payments</i> {{date('F')}} Commision:</span>
                               <span >{{number_format(($summonthmine/10 )+($summonth/20))}}</span>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
                </a>

        {{-- <div class="col s12 ">
         <div class="card">
          <div class="card-stacked">
          <div class="card-metrics-static">
          <div class="card-content">
            <h6 class="blue-text centered-text"><i class="material-icons">home</i> Domestic Orders</h6>
            <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle blue">add_to_queue</i>
                    <span class="title blue-text">Domestic Created Orders</span>
                    <p class="blue-text">{{ 8}}</p>
                    <a href="{{route('domesticcreated')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                        <i class="material-icons">visibility</i></a>
                  </li>
                    <li class="collection-item avatar">
                    <i class="material-icons circle blue">cancel</i>
                    <span class="title blue-text">Domestic Cancelled Orders</span>
                    <p class="blue-text">{{ 9}}</p>
                    <a href="{{route('domesticancelled')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                        <i class="material-icons">visibility</i></a>
                    </li>
                    <li class="collection-item avatar">
                    <i class="material-icons circle blue">rotate_right</i>
                    <span class="title blue-text">Domestic Delivering Orders</span>
                    <p class="blue-text">{{ 10}}</p>
                    <a href="{{route('domesticdelivering')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                        <i class="material-icons">visibility</i></a>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle blue">incomplete_circle</i>
                        <span class="title blue-text">Domestic Incomplete Orders</span>
                        <p class="blue-text">{{ 11 }}</p>
                        <a href="{{route('domesticincomplete')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                        <i class="material-icons">visibility</i></a>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle blue">task_alt</i>
                        <span class="title blue-text">Domestic Complete Orders</span>
                        <p class="blue-text">{{ 12 }}</p>
                        <a href="{{route('domesticcomplete')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect blue hoverable">
                        <i class="material-icons">visibility</i></a>
                    </li>
         </ul>
            </div>
          </div>
          </div>
         </div>
        </div> --}}


        <div class="col s12">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-metrics-static">
                        <div class="card-content">
                            <h6 class=" centered-text blue-text">Regional Orders Source Commision Statistics</h6>
                            <script>
                                   var orderdata =<?php echo $source; ?> ;
                                    console.log(orderdata);
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                    var data = google.visualization.arrayToDataTable(orderdata);
                                    var options = { colors:['#2F557F','#00b533']};
                                    var chart = new google.visualization.ColumnChart(document.getElementById('linechart'));
                                    chart.draw(data, options);
                                    }
                            </script>
                            <div id="linechart"></div>  
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
                            <h6 class=" centered-text blue-text">Regional Orders Desination Commision Statistics</h6>
                            <script>
                                   var desinationdata =<?php echo $desination; ?> ;
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
                            <div id="desination"></div>  
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
    <script src='../JS/preloader.js'></script>
</body>
</body>
</html>