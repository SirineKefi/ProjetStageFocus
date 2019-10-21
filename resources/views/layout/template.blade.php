<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IBM POWER Generator</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{action('ClientController@welcome')}}">

        <div >
        <img src="{{asset('img/Logo_Focus1.png')}}" width="150" height="60" style="margin-top:70px;" alt="focus">
        <p>
        <div class="sidebar-brand-text mx-3"> </div>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" style="margin-top:50px;">

       <!-- Nav Item - Dashboard -->
       <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{action('ClientController@welcome')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     

      <!-- Nav Item - Pages Collapse Menu -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" id="clients"   first-click="true" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-folder"></i>
         
        <span>Clients</span></a>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded" id="clients-header">
            <a class="collapse-item"></a>
         
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" id="servers"  first-click="true"  data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-folder"></i>
          <span>Servers</span></a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">     
        <div class="bg-white py-2 collapse-inner rounded" id="servers-header">
            <a class="collapse-item"></a>
          </div>
        </div>
      </li>



     <li class="nav-item">
        <a class="nav-link collapsed" tp id="templates" first-click="true"  href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Templates</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded" id="templates-header">
            <a class="collapse-item"></a>
          </div>
        </div>
      </li>


     
    
     

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     


     
      <!-- Nav Item - Pages Collapse Menu -->
     

      <!-- Nav Item - Charts -->
      <li  class="nav-item active">
        <a class="nav-link" href="{{action('ClientContoller@ListClient')}}">
        <i class="fas fa-fw fa-table"></i>
          <span >Clients List</span></a>
      </li>
     
     

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
            <B style="color:black"> IBM POWER Generator</B>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            
           
              

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="{{asset('https://source.unsplash.com/QAB-WJcbgJk/60x60')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        @yield('content')
</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
   
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
  <script type="text/javascript">
  var http="http://localhost/IBMPower/public/";
  $(document).ready(function() {
    $("#servers").on('click',function() {

        if($(this).attr('first-click') == 'true')
        {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'post',
            url : '/IBMPower/public/template',
            data: {},
            success : function(data) {
                data.forEach((item) => {
                        $.ajax({
                          method: 'post',
                          url : '/IBMPower/public/servers/'+item.id,
                          data1: {},
                          success : function(data1) {
                            console.log("yess");
                              $("#servers-header").append("<a class=\"collapse-item client-elem\">"+"<label style='font-size:12px;color:gray'>"+item.Client_name+"</label>"+"</a>")
                              data1.forEach((item1) => {
                                console.log(item1.id)
                                $("#servers-header").append("<a href=\"http://localhost/IBMPower/public/server/"+item1.id+"\" class=\"collapse-item client-elem\">"+"<label style='font-size:10px'>"+item1.Server_name+"</label>"+"</a>")
                              });
                          },
                          error: function(data1) {
                              console.log("no");
                          }
                      });
                });
            },
            error: function(data) {
                console.log("no");
            }
        });
        $(this).attr('first-click','false');
    
    
    
      }
    else
    {
        $(".client-elem").remove();
        $(this).attr('first-click','true');
    }
  });


    /////////////////////////////////////templates_menu
    $("#templates").on('click',function() {

if($(this).attr('first-click') == 'true')
{
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    method: 'post',
    url : '/IBMPower/public/template',
    data: {},
    success : function(data) {
        data.forEach((item) => {
                $.ajax({
                  method: 'post',
                  url : '/IBMPower/public/templates/'+item.id,
                  data1: {},
                  success : function(data1) {
                    console.log("yess");

                      
                      $("#templates-header").append("<a  class=\"collapse-item client-elem\">"+"<label style='font-size:12px;color:gray'>"+item.Client_name+"</label>"+"</a>")
                      data1.forEach((item1) => {
                        $("#templates-header").append("<a href=\"http://localhost/IBMPower/public/Template/"+item1.id+"\" class=\"collapse-item client-elem\">"+"<label style='font-size:10px'>"+item1.template_name+"</label>"+"</a>")
                      });
                  },
                  error: function(data1) {
                      console.log("no");
                  }
              });
        });
    },
    error: function(data) {
        console.log("no");
    }
});
$(this).attr('first-click','false');
}
else
{
$(".client-elem").remove();
$(this).attr('first-click','true');
}
});
/////////////////////////////
$("#clients").on('click',function() {

if($(this).attr('first-click') == 'true')
{
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    method: 'post',
    url : '/IBMPower/public/template',
    data: {},
    success : function(data) {
        data.forEach((item) => {
                
                      
                      $("#clients-header").append("<a href=\"http://localhost/IBMPower/public/view_client/Client/"+item.id+"\"  class=\"collapse-item client-elem\">"+"<label style='font-size:12px;color:gray'>"+item.Client_name+"</label>"+"</a>")
                
        });
    },
    error: function(data) {
        console.log("no");
    }
});
$(this).attr('first-click','false');
}
else
{
$(".client-elem").remove();
$(this).attr('first-click','true');
}
});
  




});
  </script>

    </body>
</html>
© 2019 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About