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

  <script src="bower_components/jquery/dist/jquery.js"></script>
 
<?php
include('scriptcss.php')
?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php 

include('config/connect.php');
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

    <div class="content-absolute">

            <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pengguna</th>
                      <th>NIP</th>
                      <th>Unit</th>
                      <th>Plat Nomor</th>
                      <th>Waktu Datang</th>
                      <th>Waktu Pergi</th>
                      <th>Gambar Kedatangan</th>
                      <th>Gambar Kepergian</th>
                    </tr>
                  </thead>
                  <tbody>
                  <div id="pageone" data-role="main" class="ui-content">
                  <?php
                   include ('config/smartparkdb.php');

                   if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                   $no_of_records_per_page = 10;
                   $offset = ($pageno-1) * $no_of_records_per_page;
                   $total_pages_sql = "SELECT COUNT(*) FROM track_plat";
                   $result = $conalpr->query($total_pages_sql); 
                   $total_rows = mysqli_fetch_array($result)[0];
                   $total_pages = ceil($total_rows / $no_of_records_per_page);

                   $sqlalpr = "SELECT pengguna.id_pengguna, pengguna.nama_pengguna, pengguna.nip, pengguna.unit,plat_nomor.text_plat,track_plat.waktu_datang,track_plat.waktu_pergi FROM pengguna,plat_nomor,track_plat WHERE pengguna.id_pengguna=plat_nomor.kepunyaan AND DATE(track_plat.waktu_datang) = DATE(CURDATE()) AND track_plat.plat_no=plat_nomor.text_plat ORDER BY pengguna.id_pengguna DESC LIMIT $offset, $no_of_records_per_page";          

                   $query = $conalpr->query($sqlalpr);         
                   
                   // $time=date("Y-m-d");
                   // echo $time;
                   
                   $no=1;
                   $noe=1;
                   while ($row = $query->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>'. $noe++ . '</td>';
                            echo '<td>'. $row['nama_pengguna'] . '</td>';
                            echo '<td>'. $row['nip'] . '</td>';
                            echo '<td>'. $row['unit'] . '</td>';
                            echo '<td>'. $row['text_plat'] . '</td>';
                            echo '<td>'. $row['waktu_datang'] . '</td>';
                            echo '<td>'. $row['waktu_pergi'] . '</td>';
                            echo '<td width=250>';                          
                            echo '<img style="width:50%;height:10%" id="'.$no++.'" data-toggle="modal" data-target="#myModal" src="hasil_parksystem/'. $row['text_plat'] . ''. str_replace(' ', '', $row['waktu_datang']) . '.png" alt="'. $row['text_plat'] . '" />';
                            echo '</td>';
                            echo '<td width=250>';                          
                            echo '<img style="width:50%;height:10%" id="'.$no++.'" data-toggle="modal" data-target="#myModal" src="hasil_parksystem/'. $row['text_plat'] . ''. str_replace(' ', '', $row['waktu_pergi']) . '.png" alt="'. $row['text_plat'] . '" />';
                            echo '</td>';
                            echo '</tr>';

                   }

                  ?>

                  </tbody>
            </table>
                  <ul class="pagination">
                      <li><a href="?pageno=1">First</a></li>
                      <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                          <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                      </li>
                      <?php
                      for($i = 1; $i<=$total_pages; $i++)
                      {
                          $pageLink = "?pageno=$i";
                          print("<li><a href=$pageLink>$i</a></li>");
                      }

                      ?>
                      <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                          <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                      </li>
                      <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                  </ul>
      </div>
      <!-- <img height="100" width="80" id="1" data-toggle="modal" data-target="#myModal" src='http://tympanus.net/Tutorials/CaptionHoverEffects/images/1.png' alt='Text dollar code part one.' />
      <img height="100" width="80" id="2" data-toggle="modal" data-target="#myModal" src='http://tympanus.net/Tutorials/CaptionHoverEffects/images/2.png' alt='Text dollar code part one.' /> -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="img-responsive" src="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>

      <script>
      // Get the modal
      jQuery(document).ready(function () {
        jQuery('#myModal').on('show.bs.modal', function (e) {
            var image = jQuery(e.relatedTarget).attr('src');
            jQuery(".img-responsive").attr("src", image);
        });
      });
      </script>

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
