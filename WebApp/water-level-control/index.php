<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="MTSN 3 Palu">

  <title>Water Level Control</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-info topbar mb-4 static-top shadow">
          <div class="align-items-center justify-content-center">
            <div class="sidebar-brand-icon">
              <i class="fas fa-prescription-bottle fa-2x text-white"></i>
            </div>
          </div>
          <h1 class="h3 mb-0 mx-3 text-white">Water Level Control</h1>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid pb-5 mb-3">

          <!-- Content Row -->
          <div class="row">

            <!-- Kapasitas Tandon -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kapasitas Tandon</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div id="textWater" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div id="percentWater" class="progress-bar bg-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-prescription-bottle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Penggunaan Air -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penggunaan Air</div>
                      <div id="textTotalWater" class="h5 mb-0 font-weight-bold text-gray-800">0 Liter</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-water fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Penggunaan Air Harian -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Penggunaan Air (Harian)</div>
                      <div id="textTotalWaterDay" class="h5 mb-0 font-weight-bold text-gray-800">0 Liter</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-faucet fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Keadaan Pompa</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <i id="indiPump" class="fas fa-stop-circle text-danger">
                        </i>
                        <span id="textPump">OFF</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-gas-pump fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div id="loadingInfo" class="row my-3">
            <div class="col-md-1 mx-auto">
              <i class="fas fa-spinner fa-3x fa-spin text-primary"></i>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white" style="position: fixed; left: 0;bottom: 0; width: 100%;">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; WLC 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
  <script>
    function loadDoc() {
      setInterval(function() {
        var waterLevel, angkaAkhir;
        var data = JSON.stringify({});

        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function() {
          if (this.readyState === 4) {
            waterLevel = this.response.split("-");
            angkaAkhir = (((50 - (waterLevel[0] - 10)) / 50) * 100);
            document.getElementById("textWater").innerHTML = angkaAkhir + "%";
            document.getElementById("percentWater").style.width = angkaAkhir + "%";
            if (angkaAkhir >= 70) {
              $("#percentWater").removeClass("bg-danger bg-warning");
              $("#percentWater").addClass("bg-success");
            } else if (angkaAkhir > 35 && angkaAkhir < 70) {
              $("#percentWater").removeClass("bg-danger bg-success");
              $("#percentWater").addClass("bg-warning");
            } else {
              $("#percentWater").removeClass("bg-warning bg-success");
              $("#percentWater").addClass("bg-danger");
            }
            document.getElementById("textTotalWater").innerHTML = waterLevel[1] + " Liter";
            // document.getElementById("textTotalWaterDay").innerHTML = waterLevel[2] + " Liter";
            if (waterLevel[2] == 1) {
              $("#indiPump").removeClass("fas fa-stop-circle text-danger");
              $("#indiPump").addClass("fas fa-circle text-success");
              document.getElementById("textPump").innerHTML = "ON";
            } else {
              $("#indiPump").removeClass("fas fa-circle text-success");
              $("#indiPump").addClass("fas fa-stop-circle text-danger");
              document.getElementById("textPump").innerHTML = "OFF";
            }
            $('#loadingInfo').remove();
          }
        });

        xhr.open("GET", "http://127.0.0.1/water-level-control/getStatus.php");
        xhr.send(data);
      }, 10000);
    }
    loadDoc();
  </script>

</body>

</html>