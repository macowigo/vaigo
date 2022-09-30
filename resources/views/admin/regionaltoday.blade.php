
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-TodayRegionalOrders</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../datatable/style.css"/>
</head>
<body class="has-fixed-sidenav">
    <header>
        @include('admin.nav')
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
                                <i class="material-icons">today</i> 
                                Today Regional Orders: {{$regionaltoday}}
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
                            @if ($message = Session::get('failed'))
                            <h6 class="red-text centered-text">{{ $message }}</h6>
                            @endif
                                @if ($regionalorders->isEmpty())
                                <span class="red-text">Sorry there is no any regional Order Found</span>
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
                                        <th>PercelValues</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Center</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        </tr>
                                    </thead>
                                    @foreach ($regionalorders as $values )
                                    <tr>
                                        <td>{{$values->oderid}}</td>
                                        <td>{{$values->ord_details}}</td>
                                        <td>{{'Percel Value:'.number_format($values->item_value).' Delivery Fee:'.number_format($values->value)}}</td>
                                        <td>{{$values->customernames.' '.$values->customerphone}}</td>
                                        <td>{{$values->delv_names.' '.$values->delv_phone}}</td>
                                        <td>{{$values->from_location}}</td>
                                        <td>{{$values->delv_location}}</td>
                                        <td>{{$values->centername.' '.$values->centerlocation}}</td>
                                        <td>{{date('M d, Y  H:i:s',strtotime($values->created_at))}}</td>
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
       <script type="text/javascript" src="../JS/datatables.min.js"></script>
       <script src="../JS/imagesloaded.pkgd.min.js"></script>
       <script src="../JS/masonry.pkgd.min.js"></script>

       <!-- Initialization script -->
       <script src="../JS/admin-materialize.min.js"></script>
       <script src='../JS/preloader.js'></script>

       <script src='../datatable/jquery.js'></script>
       <script src='../datatable/datatable.js'></script>
       <script src="../datatable/script.js"></script>
       {{-- buttons --}}
       <script src='../datatable/buttonhtml5.js'></script>
       <script src='../datatable/buttonprint.js'></script>
       <script src='../datatable/datatablebuttons.js'></script>
</body>
</html>