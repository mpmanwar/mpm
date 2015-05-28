<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Profile Edit</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- fullCalendar -->
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="css/mps_style.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<header class="header"> <a href="index.html" class="logo">
  <!-- Add the class icon to your logo image or logo icon to add the margining -->
  <img src="img/logo.png" class="" alt="User Image" width="100"/></a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
    <div class="navbar-right">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
           </a>-->
          <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                                  <!-- start message -->
                  <a href="#">
                  <div class="pull-left"> <img src="img/avatar3.png" class="img-circle" alt="User Image"/> </div>
                  <h4> Support Team <small><i class="fa fa-clock-o"></i> 5 mins</small> </h4>
                  <p>Why not buy a new awesome theme?</p>
                  </a> </li>
                <!-- end message -->
                <li> <a href="#">
                  <div class="pull-left"> <img src="img/avatar2.png" class="img-circle" alt="user image"/> </div>
                  <h4> AdminLTE Design Team <small><i class="fa fa-clock-o"></i> 2 hours</small> </h4>
                  <p>Why not buy a new awesome theme?</p>
                  </a> </li>
                <li> <a href="#">
                  <div class="pull-left"> <img src="img/avatar.png" class="img-circle" alt="user image"/> </div>
                  <h4> Developers <small><i class="fa fa-clock-o"></i> Today</small> </h4>
                  <p>Why not buy a new awesome theme?</p>
                  </a> </li>
                <li> <a href="#">
                  <div class="pull-left"> <img src="img/avatar2.png" class="img-circle" alt="user image"/> </div>
                  <h4> Sales Department <small><i class="fa fa-clock-o"></i> Yesterday</small> </h4>
                  <p>Why not buy a new awesome theme?</p>
                  </a> </li>
                <li> <a href="#">
                  <div class="pull-left"> <img src="im
                  g/avatar.png" class="img-circle" alt="user image"/> </div>
                  <h4> Reviewers <small><i class="fa fa-clock-o"></i> 2 days</small> </h4>
                  <p>Why not buy a new awesome theme?</p>
                  </a> </li>
              </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>-->
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li><a href="#"> <i class="ion ion-ios7-people info"></i> 5 new members joined today </a> </li>
                <li><a href="#"> <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems </a> </li>
                <li><a href="#"> <i class="fa fa-users warning"></i> 5 new members joined </a> </li>
                <li><a href="#"> <i class="ion ion-ios7-cart success"></i> 25 sales made </a> </li>
                <li><a href="#"> <i class="ion ion-ios7-person danger"></i> You changed your username </a> </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown tasks-menu">
          <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>-->
          <ul class="dropdown-menu">
            <li class="header">You have 9 tasks</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <!-- Task item -->
                  <a href="#">
                  <h3> Design some buttons <small class="pull-right">20%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">20% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
                <li>
                  <!-- Task item -->
                  <a href="#">
                  <h3> Create a nice theme <small class="pull-right">40%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">40% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
                <li>
                  <!-- Task item -->
                  <a href="#">
                  <h3> Some task I need to do <small class="pull-right">60%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">60% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
                <li>
                  <!-- Task item -->
                  <a href="#">
                  <h3> Make beautiful transitions <small class="pull-right">80%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">80% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
              </ul>
            </li>
            <li class="footer"> <a href="#">View all tasks</a> </li>
          </ul>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span>Jane Doe <i class="caret"></i></span> </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue"> <img src="img/avatar3.png" class="img-circle" alt="User Image" />
              <p> Jane Doe - Web Developer <small>Member since Nov. 2012</small> </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="col-xs-4 text-center"> <a href="#">Followers</a> </div>
              <div class="col-xs-4 text-center"> <a href="#">Sales</a> </div>
              <div class="col-xs-4 text-center"> <a href="#">Friends</a> </div>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left"> <a href="#" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> <a href="#" class="btn btn-default btn-flat">Sign out</a> </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image"> <img src="img/avatar3.png" class="img-circle" alt="User Image" /> </div>
        <div class="pull-left info">
          <p>Hello, Jane</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
      </div>
      <!-- search form -->
      
      
       {{ Form::open(array('url' => '/new-pass', 'files' => true)) }}  
       
   <!--   <form action="#" method="get" class="sidebar-form"> -->
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
          <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span> </div>
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active"> <a href="index.html"> <i class="fa fa-angle-double-right"></i> <span>Client List Organisation</span> </a> </li>
        <li> <a href="pages/widgets.html"> <i class="fa fa-angle-double-right"></i> <span>Client List Individual</span>
          <!--<small class="badge pull-right bg-green">new</small>-->
          </a> </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-angle-double-right"></i> <span>Edit Password</span></a></li>
        <li class="treeview"> <a href="#"> <i class="fa fa-angle-double-right"></i> <span>Change Password</span></a></li>
       <!-- <li class="treeview"> <a href="#"> <i class="fa fa-angle-double-right"></i> <span>Notice Board</span>
       
          </a>
          
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-angle-double-right"></i> <span>Companies HSE Data</span>
          
          </a>
         
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-angle-double-right"></i> <span>HMRC Authorisations</span>
         
          </a>
         
        </li>
        <li> <a href="pages/calendar.html"> <i class="fa fa-angle-double-right"></i> <span>CRM</span>
        
          </a> </li>
        <li> <a href="pages/mailbox.html"> <i class="fa fa-angle-double-right"></i> <span>Reports</span>
          
          </a> </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-angle-double-right"></i> <span>Contact & Mass Mail</span>
        
          </a>
         
        </li>
        <li> <a href="pages/mailbox.html"> <i class="fa fa-angle-double-right"></i> <span>Staff Management</span> </a> </li>-->
      </ul>
    </section>
    <!-- sidebar -->
  </aside>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Profile edit</h1>
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     
     <div class="practice_mid">
     <div class="col-xs-12 col-xs-6">
     <div class="col_m2">
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                 @if ( $errors->count() > 0 )
                    <ul>
                        @foreach( $errors->all() as $message )
                          <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                                  <label for="exampleInputPassword1">Name</label>
                                  <input type="text" id="name" name="name" class="form-control">
                                </div>
                              </div>
                              <div class="twobox_2">
                                
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">practice name</label>
                                  <input type="text" id="practicename" name="practicename" class="form-control">
                                </div>
                              </div>
                             
                              <div class="clearfix"></div>
                            </div>
                            <div class="twobox">
                              <div class="twobox_1">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Website</label>
                                  <input type="text" id="website" name="website" class="form-control">
                               
                               
                                </div>
                              </div>
                              
                              
                              
                              
                              <div class="clearfix"></div>
                            </div>
                            <div class="add_client_btn">
                            
                             <button type="submit" class="btn bg-olive btn-block">save</button>
                             
                               </a>
                            </div>
                            <div class="clearfix"></div>
                          </div>
                         
	</div>  <div class="clearfix"></div>    
     </div>
     
   
     
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
 {{ Form::close() }}
<!-- ./wrapper -->
<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FILED</h4>
        <div class="clearfix"></div>
      </div>
      <form action="#" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">ewfef </label>
            <select class="form-control">
              <option>Select Relatioship Type</option>
              <option>Sole Tradership</option>
              <option>Company</option>
              <option>LLP</option>
              <option>Incorporation Charity</option>
              <option>Unincorporation Charity</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Town/City</label>
            <input type="text" id="" class="form-control">
          </div>
          <div class="modal-footer clearfix">
            <div class="email_btns">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              <button type="save" class="btn btn-primary pull-left save_t">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- add new calendar event modal -->
<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- fullCalendar -->
<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="js/AdminLTE/app.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
</body>
</html>