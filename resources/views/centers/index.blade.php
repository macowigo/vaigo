
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-Orders</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../datatable/style.css"/>
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
                        <div class="card material-table">
                        <div class="receipt-main card-content">
                            <h6 class="blue-text centered-text">All Orders</h6>
                            @if ($message = Session::get('success'))
                            <div class="green-text">
                            <p class="green-text">{{ $message }}</p>
                            </div>
                            @endif
                            <div class="table-header">
                                <div class="actions">
                                    <a href="#search" class="search-toggle btn-small btn-floating waves-effect blue hoverable ">
                                    <i class="material-icons">search</i></a>
                                </div>
                            </div>
                            <table id="datatable" class="responsive-table">
                                <thead>
                                    <tr>
                                    <th>Order#</th>
                                    <th>OrderType</th>
                                    <th>OrderDetails</th>
                                    <th>Value</th>
                                    <th>OrderReceiver</th>
                                    <th>PickUp</th>
                                    <th>Desination</th>
                                    <th>PercelSize</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                @foreach ($orders as $ordervalues )
                                <tr>
                                    <td>{{$ordervalues->oderid}}</td>
                                    <td>{{$ordervalues->order_type}}</td>
                                    <td>{{$ordervalues->ord_details}}</td>
                                    <td>{{number_format($ordervalues->value)}}</td>
                                    <td>{{$ordervalues->delv_names.', '.$ordervalues->delv_phone}}</td>
                                    <td>{{$ordervalues->pick_up}}</td>
                                    <td>{{$ordervalues->desination}}</td>
                                    <td>{{$ordervalues->parcel_size}}</td>
                                    <td>{{$ordervalues->oder_status}}</td>
                                </tr>
                                @endforeach
                            </table>
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
       <script 
       type="text/javascript" src="../JS/datatables.min.js"></script>
       <script src="../JS/imagesloaded.pkgd.min.js"></script>
       <script src="../JS/masonry.pkgd.min.js"></script>

       <!-- Initialization script -->
       <script src="../JS/admin-materialize.min.js"></script>
       <script src='../JS/preloader.js'></script>

       <script src='../datatable/jquery.js'></script>
       <script src='../datatable/datatable.js'></script>
       <script src="../datatable/script.js"></script>
</body>
</html>