
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-Vendors</title>
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
                               <i class="material-icons">group</i>
                                Vaigo Users List
                            </h6>
                            {{-- delete success notification --}}
                            @if ($message=Session::get('succes'))
                            <h6 class="blue-text">{{$message}}</h6>
                            @endif
                            {{-- delete faild notification --}}
                            @if ($message=Session::get('failed'))
                                   <h6 class="red-text">{{$message}}</h6>
                               @endif
                            {{-- check if vendor exist --}}
                                @if ($stafflist->isEmpty())
                                <span class="red-text">Sorry there is no any Staff list Found</span>
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
                                        <th>Staff Name</th>
                                        <th>Staff Phone</th>
                                        <th>Staff Email</th>
                                        <th>Staff Role</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($stafflist as $staff )
                                    <tr>
                                        <td>{{$staff->name}}</td>
                                        <td>{{$staff->phone}}</td>
                                        <td>{{$staff->email}}</td>
                                        <td>{{$staff->role}}</td>
                                        <td>
                                            <form action="{{ route('deleteuser',$staff->id) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-floating red btn-small"
                                                title="click to delete" onclick="return confirm('Are you sure to delete this user?')">
                                                <i class="material-icons">delete</i>
                                            </button>
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