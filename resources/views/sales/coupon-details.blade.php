<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <title> Sky Park </title>
  <!-- CSS Files -->
  <link id="pagestyle" href="css/app.min.css" rel="stylesheet" />
  <link href="css/font.awesome.css" rel="stylesheet" />
  <!-- data table -->
  <link href="css/datatables.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <!-- ================================ Side Nav ============== -->
  <aside id="sidenav-main"
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#!">
        <img src="img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <!-- <span class="ms-1 font-weight-bold">Sky Park</span> -->
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!-- nav-item  -->
        <li class="nav-item">
          <a href="index.html" class="nav-link active">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <i class="fas fa-home"></i>
            </div>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li>
        <!-- nav-item  -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#familySale" class="nav-link " aria-controls="familySale" role="button"
            aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <i class="fas fa-users-crown"></i>
            </div>
            <span class="nav-link-text ms-1">Family Sale</span>
          </a>
          <div class="collapse  show " id="familySale">
            <ul class="nav ms-4 ps-3">
              <li class="nav-item ">
                <a class="nav-link " href="add-client.html">
                  <span class="sidenav-mini-icon"> A </span>
                  <span class="sidenav-normal"> Add Client </span>
                </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link " href="ticket.html">
                  <span class="sidenav-mini-icon"> T </span>
                  <span class="sidenav-normal"> Ticket </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link " href="family-access.html">
                  <span class="sidenav-mini-icon"> F </span>
                  <span class="sidenav-normal"> Family Access </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- nav-item  -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#groupSale" class="nav-link " aria-controls="groupSale" role="button"
            aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <i class="fad fa-bus-school"></i>
            </div>
            <span class="nav-link-text ms-1">Group Sale</span>
          </a>
          <div class="collapse show" id="groupSale">
            <ul class="nav ms-4 ps-3">
              <li class="nav-item ">
                <a class="nav-link " href="reservations.html">
                  <span class="sidenav-mini-icon"> R </span>
                  <span class="sidenav-normal"> Reservations </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link " href="capacity.html">
                  <span class="sidenav-mini-icon"> C </span>
                  <span class="sidenav-normal"> Capacity </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link " href="group-access.html">
                  <span class="sidenav-mini-icon"> G </span>
                  <span class="sidenav-normal"> Group Access </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <!-- nav-item  -->
        <li class="nav-item">
          <a href="coupon.html" class="nav-link ">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <i class="fas fa-ticket-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Coupon</span>
          </a>
        </li>
        <!-- nav-item  -->
        <li class="nav-item">
          <a href="exit.html" class="nav-link ">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <i class="fad fa-door-open"></i>
            </div>
            <span class="nav-link-text ms-1">Exit</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <!-- ================================ end Side Nav ================== -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- ================================ NavBar ================== -->
    <nav id="navbarBlur"
      class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 p-2 px-3 mx-4 shadow-none border-radius-xl z-index-sticky"
      data-scroll="true">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-2">
          <li class="breadcrumb-item text-sm">
            <a class="opacity-3 text-dark" href="index.html">
              <i class="fas fa-house-day"></i>
            </a>
          </li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">family Access</li>
        </ol>
      </nav>
      <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
        <a href="#!" class="nav-link text-body p-0">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </a>
      </div>
      <div class="collapse navbar-collapse  me-md-0 me-sm-4" id="navbar">
        <ul class="ms-md-auto navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="login.html" class="nav-link text-body font-weight-bold px-0">
              <span class="d-inline">Log In</span>
              <i class="fa fa-user ms-2"></i>
            </a>
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="#!" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- ================================ end NavBar ================== -->
    <content class="container-fluid pt-4">
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <h2 class="MainTiltle mb-5 ms-4"> Coupons </h2>
      <form class="card p-2 py-4 mt-3 ">

        <div class="d-flex justify-content-between align-items-center flex-wrap px-3 pb-3 border-bottom mb-3">
          <h6> Mahmoud elkomy Coupons Visitors </h6>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCoupon">
            <i class="far fa-plus me-1"></i> Add New Visitor
          </button>
        </div>
        <!-- table -->
        <table class=" customDataTable table table-bordered nowrap">
          <thead>
            <tr>
              <th>#</th>
              <th>Sale Number</th>
              <th> Name </th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>80</td>
              <td>SFFR89412</td>
              <td>mahmoud elkomy</td>
              <td>
                <span class="controlIcons">
                  <span class="icon" data-bs-toggle="modal" data-bs-target="#addCoupon"> <i class="far fa-edit"></i>
                  </span>
                  <span class="icon"> <i class="far fa-trash-alt"></i> </span>
                </span>
              </td>
            </tr>
          
          </tbody>
        </table>

      </form>

      <div class="modal fade" id="addCoupon" tabindex="-1" role="dialog" aria-labelledby="addCoupon" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="modal-title-print">Add Coupon</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="fal fa-times text-dark fs-4"></i>
              </button>
            </div>
            <form action="#!">
              <div class="modal-body">

                <div class="row">
                  <div class="col-12 p-2">
                    <label class="form-label"> <i class="fas fa-user me-1"></i> Name </label>
                    <div class="input-group">
                      <input class="form-control" type="text" placeholder="Type here...">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark ml-auto me-2" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-success"> add </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))) -->
      <!-- ================================ Footer ================== -->
      <footer id="loadFooter" class="footer pt-3"></footer>
      <!-- ================================ end Footer ================== -->
    </content>
  </main>
  <!-- ================================================== -->
  <!-- ================================================== -->
  <!-- ================================================== -->
  <!-- ================== JS Files ====================== -->
  <!-- ================================================== -->
  <!-- ================================================== -->
  <!-- ================================================== -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- plugins -->
  <script src="js/plugins/perfect-scrollbar.min.js"></script>
  <script src="js/plugins/smooth-scrollbar.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>
  <script src="js/plugins/threejs.js"></script>
  <script src="js/plugins/orbit-controls.js"></script>
  <script src="js/plugins/choices.min.js"></script>
  <script src="js/plugins/multistep-form.js"></script>
  <!-- data table -->
  <script src="js/plugins/datatables.min.js"></script>
  <!-- dashboard Js -->
  <script src="js/app.min.js"></script>
  <!-- custom Js -->
  <script src="js/custom.js"></script>
  <script>
    $(document).ready(function () {
      var table = $('.customDataTable').DataTable({
        responsive: true,
        // "ordering": true,
        // columnDefs: [{
        //   'targets': [4, 5],
        //   'orderable': false
        // }, ]
      });
      new $.fn.dataTable.FixedHeader(table);
    });
  </script>
</body>

</html>