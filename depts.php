<?php 
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$deptid)
  {
    if ($op==3)
    {
      $deptid="";
      $deptname="";
      $managername="";
      $op=4;

    }
    else
    {
        include("connectdb.php");
        $sql = "SELECT deptid,deptname,managername FROM dept where deptid='$deptid'";

        $result =$connect->query($sql);

        /* fetch associative array */
        if ($row = $result->fetch_assoc()) {
            $deptid=$row['deptid'];
            $deptname=$row['deptname'];
            $managername=$row['managername'];
        }
        $op=2;
    }
      echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選部門資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
      echo "<form action=depts.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=deptid id='deptid' placeholder='請輸入代號' value=$deptid>
              </div>
              <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
              <input type='text' class='form-control' name=deptname id='deptname' placeholder='請輸入代號' value=$deptname>
              </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>主管姓名</label>
              <input type='text' class='form-control' name=managername id='managername' placeholder='請輸入主管姓名' value=$managername>
            </div>";
      echo'<div class="modal-footer">
            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-3">儲存</button>           
              <button type="close" class="btn btn-danger mb-3">
                        <span aria-hidden="true">取消</span></button>                             
          </div>
          </div>
          </div>
          </div>
      </div>';
    echo "</form>";
}
  ?>
<script>
$(function() {
    $('#logoutModal2').modal('show')
});
</script>  
  <?php
     if(isset($_REQUEST['op']))
     {
       $op=$_REQUEST['op'];   
 
       
       switch ($op)
       {
         case 1:  //修改
               $deptid=$_REQUEST['deptid']; 
                display_form($op,$deptid);
               break;      
         case 2:  //修改資料
                 $deptid=$_REQUEST['deptid'];
               $deptname=$_REQUEST['deptname'];
               $managername=$_REQUEST['managername'];
 
                   $sql="update dept 
                           set deptid='$deptid',
                               deptname='$deptname',
                               managername='$managername'
                         where deptid='$deptid'";
                   include("connectdb.php");
                   include('dbutil.php');
                   execute_sql($sql);
               break;
         case 3: //新增
                $deptid="";
                 display_form($op,$deptid);
               break;
         case 4: //新增資料
               $deptid=$_REQUEST['deptid'];
               $deptname=$_REQUEST['deptname'];
               $managername=$_REQUEST['managername'];
 
               $sql="insert into dept (deptid,deptname,managername) values ('$deptid','$deptname','$managername')";
               include("connectdb.php");
               include('dbutil.php');
               execute_sql($sql);
               break;      
         case 5: //刪除資料              
               $deptid=$_REQUEST['deptid'];              
             
               $sql="delete from dept where deptid='$deptid'";
               include("connectdb.php");
               include('dbutil.php');
               execute_sql($sql);
               break;
 
       }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>部門基本資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=depts.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>部門代號</th>
                            <th>部門名稱</th>
                            <th>主管姓名</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>部門代號</th>
                          <th>部門名稱</th>
                          <th>主管姓名</th>
                          <th>edit</th>
                          <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT deptid,deptname,managername FROM dept";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
  //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
  $deptid=$row['deptid'];
  $deptname=$row['deptname'];
  $managername=$row['managername'];
  echo "<tr><TD>$deptid<td> $deptname<TD>$managername";    
  echo "<TD><a href=depts.php?op=1&deptid=$deptid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
  echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$deptname]嗎?'))location='depts.php?deptid=$deptid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();


    
?>