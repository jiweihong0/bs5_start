<?php 
include("auth.php");
include("template.php");
head("進銷存系統");
function display_form($op,$Empid)
  {
      if ($op==3)
      {
        $empid="";
        $empname="";
        $jobtitle="";
        $deptid="";
        $address="";
        $phone="";
        $zipcode="";
        $MonthSalary="";
        $AnnualLeave="";
        $op=4;
      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT empid,empname,jobtitle,deptid,address,phone,zipcode,MonthSalary,AnnualLeave FROM employee where Empid='$Empid'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                        $empid=$row['empid'];
                        $empname=$row['empname'];
                        $jobtitle=$row['jobtitle'];
                        $deptid=$row['deptid'];
                        $address=$row['address'];
                        $phone=$row['phone'];
                        $zipcode=$row['zipcode'];
                        $MonthSalary=$row['MonthSalary'];
                        $AnnualLeave=$row['AnnualLeave'];
              }
                $op=2;
      }
   
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選員工資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
     echo "<form action=employee.php method=post>";
     echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
                    <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入代號' value=$empid>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>職員名稱</label>
                    <input type='text' class='form-control' name=empname id='empname' placeholder='請輸入職員名稱' value=$empname>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>所屬職稱</label>
                    <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入職稱' value=$jobtitle>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>部門代號</label>
                    <input type='text' class='form-control' name=deptid id='deptid' placeholder='請輸入部門代號' value=$deptid>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>地址</label>
                    <input type='text' class='form-control' name=address id='address' placeholder='請輸入地址' value=$address>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>電話號碼</label>
                    <input type='text' class='form-control' name=phone id='phone' placeholder='請輸入電話號碼' value=$phone>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>郵遞區號</label>
                    <input type='text' class='form-control' name=zipcode id='zipcode' placeholder='請輸入郵遞區號' value=$zipcode>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>月薪</label>
                    <input type='text' class='form-control' name=MonthSalary id='MonthSalary' placeholder='請輸入月薪' value=$MonthSalary>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>年假天數</label>
                    <input type='text' class='form-control' name=AnnualLeave id='AnnualLeave' placeholder='請輸入年假天數' value=$AnnualLeave>
                    </div>"
                    ;
   
    
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
              $empid=$_REQUEST['empid']; 
               display_form($op,$empid);
              break;      
        case 2:  //修改資料
                    $empid=$_REQUEST['empid'];
                    $empname=$_REQUEST['empname'];
                    $jobtitle=$_REQUEST['jobtitle'];
                    $deptid=$_REQUEST['deptid'];
                    $address=$_REQUEST['address'];
                    $phone=$_REQUEST['phone'];
                    $zipcode=$_REQUEST['zipcode'];
                    $MonthSalary=$_REQUEST['MonthSalary'];
                    $AnnualLeave=$_REQUEST['AnnualLeave'];
                 
                    $sql="update employee 
                        set Empid='$empid',
                            Empname='$empname',
                            Jobtitle='$jobtitle',
                            Deptid='$deptid',
                            Address='$address',
                            Phone='$phone',
                            Zipcode='$zipcode',
                            MonthSalary='$MonthSalary',
                            AnnualLeave='$AnnualLeave'
                    where Empid='$empid'";
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
              break;
        case 3: //新增
               $empid="";
                display_form($op,$empid);
              break;
        case 4: //新增資料
            $empid=$_REQUEST['empid'];
            $empname=$_REQUEST['empname'];
            $jobtitle=$_REQUEST['jobtitle'];
            $deptid=$_REQUEST['deptid'];
            $address=$_REQUEST['address'];
            $phone=$_REQUEST['phone'];
            $zipcode=$_REQUEST['zipcode'];
            $MonthSalary=$_REQUEST['MonthSalary'];
            $AnnualLeave=$_REQUEST['AnnualLeave'];

              $sql="insert into employee (Empid,Empname,Jobtitle,Deptid,Address,Phone,Zipcode,MonthSalary,AnnualLeave) values ('$empid','$empname','$jobtitle','$deptid','$address','$phone','$zipcode','$MonthSalary','$AnnualLeave')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;      
        case 5: //刪除資料              
            $empid=$_REQUEST['empid'];           
              $sql="delete from employee where Empid='$empid'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>員工基本資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=employee.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>員工代號</th>
                            <th>職員姓名</th>
                            <th>職稱</th>
                            <th>部門代號</th>
                            <th>地址</th>
                            <th>電話</th>
                            <th>郵遞區號</th>
                            <th>月薪</th>
                            <th>年假天數</th>
                            <th>修改</th>
                            <th>刪除</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>員工代號</th>
                            <th>職員姓名</th>
                            <th>職稱</th>
                            <th>部門代號</th>
                            <th>地址</th>
                            <th>電話</th>
                            <th>郵遞區號</th>
                            <th>月薪</th>
                            <th>年假天數</th>
                            <th>修改</th>
                            <th>刪除</th>
                        </tr>
                    </tfoot>
                    <tbody>
";

                                       
include("connectdb.php");
$sql = "SELECT empid,empname,jobtitle,deptid,address,phone,zipcode,MonthSalary,AnnualLeave FROM employee";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $empid=$row['empid'];
    $empname=$row['empname'];
    $jobtitle=$row['jobtitle'];
    $deptid=$row['deptid'];
    $address=$row['address'];
    $phone=$row['phone'];
    $zipcode=$row['zipcode'];
    $MonthSalary=$row['MonthSalary'];
    $AnnualLeave=$row['AnnualLeave'];

    echo "<tr><TD>$empid<td> $empname<TD>$jobtitle<td>$deptid<TD>$address<td>$phone<TD>$zipcode<td>$MonthSalary<TD>$AnnualLeave";    
    echo "<TD><a href=employee.php?op=1&empid=$empid><button type='button' class='btn btn-primary'>修改<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$empname]嗎?'))location='employee.php?empid=$empid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}    
echo"
</tbody>
 

</div>
</div>";


footer();

  
    
?>