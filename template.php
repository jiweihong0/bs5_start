<?php

function head($title)
{
    echo "<!DOCTYPE html>
    <html lang='en'>
    
    
    <head>
    
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='description' content=''>
        <meta name='author' content=''>
    
        <title>進貨單管理</title>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>
        <!-- Custom fonts for this template -->
        <link href='front/vendor/fontawesome-free/css/all.min.css' rel='stylesheet' type='text/css'>
    
        <link href='https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>
    
        <!-- Custom styles for this template -->
        <link href='front/css/sb-admin-2.min.css' rel='stylesheet'>
    
        <!-- Custom styles for this page -->
        <link href='front/vendor/datatables/dataTables.bootstrap4.min.css' rel='stylesheet'>
    
    
    </head>
    
    
    
    <body id='page-top'>";


}

function horizontal_bar($name)
{
    echo "  <!-- Page Wrapper -->
    <div id='wrapper'>

        <!-- Sidebar -->
        <ul class='navbar-nav bg-gradient-primary sidebar sidebar-dark accordion' id='accordionSidebar'>

            <!-- Sidebar - Brand -->
            <a class='sidebar-brand d-flex align-items-center justify-content-center' href='home.php'>
                <div class='sidebar-brand-icon rotate-n-15'>
                    <i class='fas fa-laugh-wink'></i>
                </div>
                <div class='sidebar-brand-text mx-3'>$name<sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class='sidebar-divider my-0'>


            <!-- Nav Item - Tables -->
            <li class='nav-item'>
                    <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseTwo'
                            aria-expanded='true' aria-controls='collapseTwo'>
                            <i class='fas fa-fw fa-cog'></i>
                            <span>基本資料管理</span>
                    </a>

                        <div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                            <div class='bg-white py-2 collapse-inner rounded'>
                                <h6 class='collapse-header'>員工</h6>
                                <a class='collapse-item' href='employee.php'>員工基本資料</a>
                                <a class='collapse-item' href='depts.php'>部門基本資料</a>
                                <h6 class='collapse-header'>客戶</h6>
                                <a class='collapse-item' href='sup.php'>供應商基本資料</a>
                                <a class='collapse-item' href='cus.php'>客戶基本資料</a>
                                <h6 class='collapse-header'>產品</h6>
                                <a class='collapse-item' href='product.php'>產品基本資料</a>
                            </div>
                        </div>
                    <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseTwo2'
                            aria-expanded='true' aria-controls='collapseTwo2'>
                            <i class='fas fa-fw fa-cog'></i>
                            <span>員工管理</span>
                    </a>
                        <div id='collapseTwo2' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                            <div class='bg-white py-2 collapse-inner rounded'>
                                <h6 class='collapse-header'>班次</h6>
                                <a class='collapse-item' href='overtime.php'>加班</a>
                                <a class='collapse-item' href='leav.php'>請假</a>
                                <h6 class='collapse-header'>工作專長</h6>
                                <a class='collapse-item' href='exp.php'>修改工作經驗</a>
                                <a class='collapse-item' href='person.php'>修改專長</a>
                            </div>
                        </div>


                    <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseTwo3'
                            aria-expanded='true' aria-controls='collapseTwo3'>
                            <i class='fas fa-fw fa-cog'></i>
                            <span>進銷存管理</span>
                    </a>
                        <div id='collapseTwo3' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                            <div class='bg-white py-2 collapse-inner rounded'>
                                <h6 class='collapse-header'>進貨</h6>
                                <a class='collapse-item' href='ordertail.php'>進貨管理</a>
                                <h6 class='collapse-header'>存貨</h6>
                                <a class='collapse-item' href='stock1.php'>庫存管理</a>
                                <h6 class='collapse-header'>訂單</h6>
                                <a class='collapse-item' href='salorder.php'>訂單管理</a>
                            </div>
                        </div>
                        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseTwo4'
                            aria-expanded='true' aria-controls='collapseTwo4'>
                            <i class='fas fa-fw fa-cog'></i>
                            <span>管理報表</span>
                    </a>
                        <div id='collapseTwo4' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                            <div class='bg-white py-2 collapse-inner rounded'>
                                <h6 class='collapse-header'>人事</h6>
                                <a class='collapse-item' href='report-employees.php'>員工管理</a>
                                <h6 class='collapse-header'>貨品</h6>
                                <a class='collapse-item' href='orderpdf.php'>訂單管理</a>
                            </div>
                        </div>    
                </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class='text-center d-none d-md-inline'>
                <button class='rounded-circle border-0' id='sidebarToggle'></button>
            </div>
           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id='content-wrapper' class='d-flex flex-column'>

            <!-- Main Content -->
            <div id='content'>

                <!-- Topbar -->
                <nav class='navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow'>

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class='form-inline'>
                        <button id='sidebarToggleTop' class='btn btn-link d-md-none rounded-circle mr-3'>
                            <i class='fa fa-bars'></i>
                        </button>
                    </form>
                            <!-- Dropdown - User Information -->
                        <li class='nav-item dropdown no-arrow'>
                            <a class='nav-link dropdown-toggle' href='index.php' id='userDropdown' role='button'
                                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <span class='mr-2 d-none d-lg-inline text-gray-1000 small'>$name</span>
                                <img class='img-profile rounded-circle'
                                    src='front/img/undraw_profile.svg'>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class='dropdown-menu dropdown-menu-right shadow animated--grow-in'
                                aria-labelledby='userDropdown'>
                                <div class='dropdown'></div>
                                <a class='dropdown-item'  data-toggle='modal' data-target='#logoutModal1'>
                               
                                    <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400'></i>
                                    Logout
                                </a>
                            </div>
                        </li>


                </nav>
                <!-- End of Topbar -->";
}
function footer(){
  echo"
  
  <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class='scroll-to-top rounded' href='#page-top'>
<i class='fas fa-angle-up'></i>
</a>

<!-- Logout Modal-->
<div class='modal fade' id='logoutModal1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
aria-hidden='true'>

<div class='modal-dialog' role='document'>
    <div class='modal-content'>
        <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Ready to Leave?</h5>
            <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>×</span>
            </button>
        </div>
        <div class='modal-body'>Select 'Logout' below if you are ready to end your current session.</div>
        <div class='modal-footer'>
            <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
            <a class='btn btn-primary' href='index.php'>Logout</a>
        </div>
    </div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src='front/vendor/jquery/jquery.min.js'></script>
<script src='front/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>

<!-- Core plugin JavaScript-->
<script src='front/vendor/jquery-easing/jquery.easing.min.js'></script>

<!-- Custom scripts for all pages-->
<script src='front/js/sb-admin-2.min.js'></script>

<!-- Page level plugins -->
<script src='front/vendor/datatables/jquery.dataTables.min.js'></script>
<script src='front/vendor/datatables/dataTables.bootstrap4.min.js'></script>

<!-- Page level custom scripts -->
<script src='front/js/demo/datatables-demo.js'></script>

</body>

</html>";
}
?>
