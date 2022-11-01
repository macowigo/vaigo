
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-DomesticOrders</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../datatable/style.css"/>
</head>
<body class="has-fixed-sidenav">
    <header>
        @include('departurer.nav')
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
                            <h6 class="blue-text centered-text">
                               <i class="material-icons">open_in_new</i>
                                New Domestic Orders: </h6>
                                @if ($dmneworders->isEmpty())
                                <span class="red-text">Sorry there is no new Domestic Order Found</span>
                                @else
                                <div class="table-header">
                                    <div class="actions">
                                        <a href="#search" class="search-toggle btn-small btn-floating waves-effect blue hoverable ">
                                        <i class="material-icons">search</i></a>
                                    </div>
                                </div>
                                <table id="datatable" class="responsive-table">
                                    <thead>
                                        <tr>
                                        <th>Details</th>
                                        <th>OrderValues</th>
                                        <th>Transport</th>
                                        <th>Receiver</th>
                                        <th>Payment</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Created</th>
                                        <th>Delivery</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($dmneworders as $values )
                                    <tr>
                                        <td>{{$values->ord_details}}</td>
                                        <td>{{'Order Value:'.number_format($values->item_value).' 
                                        Delivery Fee:'.number_format($values->value)}}
                                        </td>
                                        <td>{{$values->trans}}</td>
                                        <td>{{$values->delv_names.' '.$values->delv_phone}}</td>
                                        <td>{{$values->py_type}}</td>
                                        <td>{{str_ireplace(', Dar es Salaam, Tanzania','',$values->from_location)}}</td>
                                        <td>{{str_ireplace(', Dar es Salaam, Tanzania','',$values->delv_location)}}</td>
                                        <td>{{date('M d, Y  H:i:s',strtotime($values->created_at))}}</td>
                                        <td>{{$values->delivery_type}}</td>
                                        <td>{{$values->oder_status}}</td>
                                        <td>
                                         <a class="btn-floating blue btn-small"   title="click to assign driver"
                                            href="{{ route('departurerview',$values->oderid) }}">
                                            <i class="material-icons">motorcycle</i>
                                            </a>  
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @endif  
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