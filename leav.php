<?php    
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$EmpID)
  {
      if ($op==3)
      {
        $EmpID="";
        $Vacation="";
        $Year="";
        $Month="";
        $Days="";
        $op=4;
      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT EmpID,Vacation,Year,Month,Days FROM leav where EmpID='$EmpID'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                        $EmpID=$row['EmpID'];
                        $Vacation=$row['Vacation'];
                        $Year=$row['Year'];
                        $Month=$row['Month'];
                        $Days=$row['Days'];
              }
                $op=2;
      }
   
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選請假資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
     echo "<form action=leav.php method=post>";
     echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
                    <input type='text' class='form-control' name=EmpID id='EmpID' readonly placeholder='請輸入代號' value=$EmpID>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>假別</label>
                    <input type='text' class='form-control' name=Vacation id='Vacation' readonly placeholder='請輸入假別' value=$Vacation>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>年</label>
                    <input type='text' class='form-control' name=Year id='Year'readonly placeholder='請輸入年' value=$Year>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>月</label>
                    <input type='text' class='form-control' name=Month id='Month' placeholder='請輸入月' value=$Month>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>天數</label>
                    <input type='text' class='form-control' name=Days id='Days' placeholder='請輸入天數' value=$Days>
                    </div>";
   
     echo'<div class="modal-body">喵喵喵</div>';
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
              $EmpID=$_REQUEST['EmpID']; 
               display_form($op,$EmpID);
              break;      
        case 2:  //修改資料
                    $EmpID=$_REQUEST['EmpID'];
                    $Vacation=$_REQUEST['Vacation'];
                    $Year=$_REQUEST['Year'];
                    $Month=$_REQUEST['Month'];
                    $Days=$_REQUEST['Days'];
                 
                    $sql="update leav 
                        set EmpID='$EmpID',
                            Vacation='$Vacation',
                            Year='$Year',
                            Month='$Month',
                            Days='$Days'
                    where EmpID='$EmpID'";
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
              break;
        case 3: //新增
               $EmpID="";
               echo "
                <script>
                $(function () {
                $('#EmpID').removeAttr('readonly');
                $('#Vacation').removeAttr('readonly');
                $('#Year').removeAttr('readonly');
                    });
                </script> ";
                display_form($op,$EmpID);
              break;
        case 4: //新增資料
            $EmpID=$_REQUEST['EmpID'];
            $Vacation=$_REQUEST['Vacation'];
            $Year=$_REQUEST['Year'];
            $Month=$_REQUEST['Month'];
            $Days=$_REQUEST['Days'];

              $sql="insert into leav (EmpID,Vacation,Year,Month,leav) values ('$EmpID','$Vacation','$Year','$Month','$Days')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;      
        case 5: //刪除資料              
            $EmpID=$_REQUEST['EmpID'];           
              $sql="delete from leav where EmpID='$EmpID'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>請假資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=leav.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                        <th>員工代號</th>
                        <th>假別</th>
                        <th>年</th>
                        <th>月</th>
                        <th>天數</th>
                        <th>修改</th>
                        <th>刪除</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>員工代號</th>
                        <th>假別</th>
                        <th>年</th>
                        <th>月</th>
                        <th>天數</th>
                        <th>修改</th>
                        <th>刪除</th>
                    </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT EmpID,Vacation,Year,Month,Days FROM leav";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $EmpID=$row['EmpID'];
    $Vacation=$row['Vacation'];
    $Year=$row['Year'];
    $Month=$row['Month'];
    $Days=$row['Days'];

    echo "<tr><TD>$EmpID<td> $Vacation<TD>$Year<td>$Month<TD>$Days";    
    echo "<TD><a href=leav.php?op=1&EmpID=$EmpID><button type='button' class='btn btn-primary'>修改<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$Vacation]嗎?'))location='leav.php?EmpID=$EmpID&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();  

    
?>
