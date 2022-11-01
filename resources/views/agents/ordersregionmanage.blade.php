
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-ManageRegionalOrders</title>
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
                                <i class="material-icons">construction</i> Manage Regional Orders
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
                            @if ($message = Session::get('fail'))
                            <h6 class="red-text centered-text">{{ $message }}</h6>
                            @endif
                                @if ($orders->isEmpty())
                                <span class="red-text">Sorry there is no any Order Found</span>
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
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        </tr>
                                    </thead>
                                    @foreach ($orders as $values )
                                    <tr>
                                        <td>{{$values->oderid}}</td>
                                        <td>{{$values->ord_details}}</td>
                                        <td>{{'Percel Value:'.number_format($values->item_value).' Delivery Fee:'.number_format($values->value)}}</td>
                                        <td>{{$values->customernames.' '.$values->customerphone}}</td>
                                        <td>{{$values->delv_names.' '.$values->delv_phone}}</td>
                                        <td>{{$values->from_location}}</td>
                                        <td>{{$values->delv_location}}</td>
                                        <td>{{date('M d, Y  H:i:s',strtotime($values->created_at))}}</td>
                                        <td>{{$values->oder_status}}</td>
                                        <td>
                                            <form>
                                                @csrf
                                                @if ($values->oder_status!='cancelled'&& $values->oder_status!='delivered'
                                                && $values->center==Auth::user()->centerid )
                                                <button class="btn-floating blue btn-small" title="click to resendsms"
                                                onclick="return confirm('Are you sure to resendsms?')"
                                                formaction="{{route('agentresendsms',$values->oderid)}}" formmethod="POST">
                                                <i class="material-icons">sms</i>
                                                </button> 
                                                @endif
                                                @if ($values->oder_status=='created' && $values->center==Auth::user()->centerid)
                                                <button class="btn-floating red btn-small" title="click to cancel"
                                                onclick="return confirm('Are you sure to cancel this order?')"
                                                formaction="{{route('agentcancelorder',$values->oderid)}}" formmethod="POST">
                                                <i class="material-icons">cancel</i>
                                                </button>  
                                                @endif
                                                @if ($values->oder_status=='on the way' && $values->desination==Auth::user()->centerid)
                                                <button class="btn-floating blue btn-small" title="click to receive order"
                                                onclick="return confirm('Are you sure to receive this order?')"
                                                formaction="{{route('agentreceiverorder',$values->oderid)}}" formmethod="POST">
                                                <i class="material-icons">call_received</i>
                                                </button>  
                                                @endif
                                                @if ($values->oder_status=='at delivery center' && $values->desination==Auth::user()->centerid)
                                                <button class="btn-floating blue btn-small" title="click to receive order"
                                                onclick="return confirm('Are you sure to deliver this order?')"
                                                formaction="{{route('agentdeliverorder',$values->oderid)}}" formmethod="POST">
                                                <i class="material-icons">all_inbox</i>
                                                </button>  
                                                @endif
                                               
                                            </form>
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
       <script type="text/javascript" src="../JS/datatables.min.js"></script>
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