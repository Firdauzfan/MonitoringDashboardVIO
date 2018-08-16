<?php 
// Start the session
session_start();
// Cek Login Apakah Sudah Login atau Belum
if (!isset($_SESSION['ID'])){
// Jika Tidak Arahkan Kembali ke Halaman Login
  header("location: index.php");
} 

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="author" content="videoexpertsgroup" />
  <meta name="copyright" lang="ru" content="videoexpertsgroup" />
  <meta name="description" content="Demo VXG Media Player for Chrome" />
  <meta name="keywords" content=""/>

  <title>VIO Monitoring | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <script type="text/javascript" src="dist/js/vxgplayer-1.8.23.min.js"></script>
  <link href="dist/css/vxgplayer-1.8.23.min.css" rel="stylesheet"/>
  <style type="text/css">
  iframe 
  {
   display: block; 
   width: 100%; 
   border: none; 
   overflow-y: auto; 
   overflow-x: hidden;
  }
  .content-absolute{
    top: 0px;
    padding: 0px;
    margin: 0px;
    height: 100%;
  }

  .content{
    width: 100% !important;
    height: 100%;
    padding: 0px;
    top: -25px;
    text-align: center;
  }

  h1 {
    padding-top: 25px;
    border-bottom: 1px solid #e5e4e4;
    color: #747474;
  }
  </style>
<?php
include('scriptcss.php')
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php 

include('config/connect.php')
?>
<?php
	  $Id_Pegawai=$_SESSION['id_peg'];
	  $sql = mysqli_query($con, "SELECT * FROM users WHERE id_pegawai='$Id_Pegawai'") or die(mysqli_error());
	  $rowe = mysqli_fetch_assoc($sql);
?>

  <!-- Left side column. contains the logo and sidebar -->
<?php
include('header.php');
include('sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

    <?php
       
    ?>

    <div class="content-absolute">
          <?php
          $id = $_GET['cam'];

          if ($id==0) {
              $sql = "SELECT * FROM camera";

              $query = $con->query($sql);
              echo "<h1>Live Streaming CCTV PT VIO Intelligence</h1>";

                while($row = $query->fetch_assoc()){
                  
                    echo '
                        <div id="vxg_media_player'.$row['id_camera'].'" class="vxgplayer" width="500" height="300" url="'.$row['rtsp_camera'].'" aspect-ratio latency="3000000" autostart controls avsync debug></div>
                    ';
                }
          }else{
              $sql = "SELECT * FROM camera WHERE id_camera=$id";

              $query = $con->query($sql);

                while($row = $query->fetch_assoc()){
                    echo "<h1>Live Streaming ".$row['nama_camera']." PT VIO Intelligence</h1>";
                  
                    echo '
                        <div id="vxg_media_player'.$row['id_camera'].'" class="vxgplayer" width="1300" height="650" url="'.$row['rtsp_camera'].'" aspect-ratio latency="3000000" autostart controls avsync debug></div>
                    ';
                }
          }
          
          ?>

      </div>
       
    <script type="text/javascript"></script>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
	include('footer.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php
include('scriptjs.php');
?>
</body>
</html>
