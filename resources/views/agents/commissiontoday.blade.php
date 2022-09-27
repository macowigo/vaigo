
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-TodayOrdersCommision</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../datatable/style.css"/>
</head>
<body class="has-fixed-sidenav">
    <header>
        @include('agents.nav')
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
                                <i class="material-icons">payments</i> Today Commision:
                                {{number_format(($sumtodaymine/10 )+($sumtoday/20))}}
                            </h6>
                            <x-auth-session-status class="red-text centered-text" :status="session('status')" />
                            @if(session('status'))
                            <div class="red-text centered-text">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('success'))
                            <h6 class="blue-text centered-text">{{ $message }}</h6>
                            @endif
                                @if ($orders->isEmpty())
                                <span class="red-text">Sorry there is no any Order Found Today</span>
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
                                        <th>Percel#</th>
                                        <th>Details</th>
                                        <th>PercelValue</th>
                                        <th>DeliveryFee</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Created</th>
                                        <th>Commision</th>
                                        <th>Status</th>
                                        </tr>
                                    </thead>
                                    @foreach ($orders as $values )
                                    <tr>
                                        <td>{{$values->oderid}}</td>
                                        <td>{{$values->ord_details}}</td>
                                        <td>{{number_format($values->item_value)}}</td>
                                        <td>{{number_format($values->value)}}</td>
                                        <td>{{str_ireplace(', Dar es Salaam, Tanzania','',$values->from_location)}}</td>
                                        <td>{{str_ireplace(', Dar es Salaam, Tanzania','',$values->delv_location)}}</td>
                                        <td>{{date('M d, Y  H:i:s',strtotime($values->created_time))}}</td>
                                        @if ($values->oder_status=='cancelled')
                                        <td>0</td>
                                        @else
                                        @if ($values->center==Auth::user()->centerid)
                                        <td>{{number_format($values->value/10)}}</td>
                                         @endif
                                        @if ($values->desination==Auth::user()->centerid)
                                        <td>{{number_format($values->value *5 /100)}}</td>
                                        @endif
                                        @endif
                                        <td>{{$values->oder_status}}</td>
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
       <script src='../datatable/buttonhtml5.js'></script>
       <script src='../datatable/buttonprint.js'></script>
       <script src='../datatable/datatablebuttons.js'></script>
</body>
</html>