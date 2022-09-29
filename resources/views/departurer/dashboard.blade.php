
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
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
    <link rel="stylesheet" type="text/css" href="../datatable/style.css"/>
    
</head>

<body class="has-fixed-sidenav">
    <header>
       @include('departurer.nav')
    </header>
<main>
<div class="progress" id="loading">
      <div class="indeterminate"></div>
  </div>
<div class="container page" >
    <div class="masonry row">
        <div class="col s12">  
        <h4 class="blue-text" >Dashboard</h4>
        <a href="{{route('departurenew')}}">
         <div class="col s12 m6 l4">
         <div class="card">
                <div class="card-stacked">
                    <div class=" card-metrics-static">
                        <div class="card-content">
                        <span><i class="material-icons">open_in_new</i> Domestic New Orders:{{$domesticnew}} </span>
                        <span ></span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         </a>
         <a href="{{route('departurered')}}">
            <div class="col s12 m6 l4">
            <div class="card">
                   <div class="card-stacked">
                       <div class=" card-metrics-static">
                           <div class="card-content">
                           <span><i class="material-icons">refresh</i> Domestic Depatured Orders:{{$domesticdelivering}} </span>
                           <span ></span>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            </a>
         <a href="{{route('dmalldpt')}}">
         <div class="col s12 m6 l4">
         <div class="card">
                <div class="card-stacked">
                    <div class=" card-metrics-static">
                        <div class="card-content">
                        <span><i class="material-icons">select_all</i> Domestic All Orders:{{$domesticall}} </span>
                        <span ></span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         </a>
         <a href="{{route('regionalnew')}}">
            <div class="col s12 m6 l4">
            <div class="card">
                   <div class="card-stacked">
                       <div class=" card-metrics-static">
                           <div class="card-content">
                           <span><i class="material-icons">open_in_new</i> Regional New Created Orders:</span>
                           <span >{{$regionalcreated}} </span>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            </a>
            <a href="{{route('regionalcollected')}}">
                <div class="col s12 m6 l4">
                <div class="card">
                       <div class="card-stacked">
                           <div class=" card-metrics-static">
                               <div class="card-content">
                               <span><i class="material-icons">group_work</i> Regional Collected Orders:</span>
                               <span >{{$regionalcollected}} </span>
                               </div>
                           </div>
                       </div>
                   </div>
                </div>
                </a>
                <a href="{{route('regionalall')}}">
                    <div class="col s12 m6 l4">
                    <div class="card">
                           <div class="card-stacked">
                               <div class=" card-metrics-static">
                                   <div class="card-content">
                                   <span><i class="material-icons">select_all</i> Regional All Orders:</span>
                                   <span >{{number_format($regionalall)}} </span>
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
      <i class="material-icons circle blue">cancel</i>
      <span class="title blue-text">Domestic Cancelled Orders</span>
      <p class="blue-text">{{$domesticcancell}}</p>
      <a href="{{route('domcancelled')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect  blue hoverable"><i class="material-icons">visibility</i></a>
    </li>
    <li class="collection-item avatar">
      <i class="material-icons circle blue">refresh</i>
      <span class="title blue-text">Domestic Departured Orders</span>
      <p class="blue-text">{{$domesticdelivering}}</p>
      <a href="{{route('departurered')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect  blue hoverable">
        <i class="material-icons">visibility</i></a>
    </li>
    <li class="collection-item avatar">
        <i class="material-icons circle blue">incomplete_circle</i>
        <span class="title blue-text">Domestic Incomplete Orders</span>
        <p class="blue-text">{{$domesticincompleted}}</p>
        <a href="{{route('incdptdm')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect  blue hoverable">
        <i class="material-icons">visibility</i></a>
      </li>
      <li class="collection-item avatar">
        <i class="material-icons circle blue">check_circle</i>
        <span class="title blue-text">Domestic Complete Orders</span>
        <p class="blue-text">{{$domesticcompleted}}</p>
        <a href="{{route('dmcomplete')}}" class="secondary-content btn-small btn-floating pulse  halfway-fab waves-effect  blue hoverable">
        <i class="material-icons">visibility</i></a>
      </li>
         </ul>
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
                            <h6 class=" centered-text blue-text">Domestic Order Statistics</h6>
                            <script>
                                   var orderdata = <?php echo $orders; ?>;
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