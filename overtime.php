<?php 
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$EmpId)
  {
      if ($op==3)
      {
        $EmpId="";
        $OverDate="";
        $OverHours="";
        $op=4;
      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT EmpId,OverDate,OverHours FROM overtime where EmpId='$EmpId'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                        $EmpId=$row['EmpId'];
                        $OverDate=$row['OverDate'];
                        $OverHours=$row['OverHours'];
              }
                $op=2;
      }
   
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選加班資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
     echo "<form action=overtime.php method=post>";
     echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
                    <input type='text' class='form-control' name=EmpId id='EmpId' placeholder='請輸入代號' readonly value=$EmpId >
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>加班日期</label>
                    <input type='text' class='form-control' name=OverDate id='OverDate' placeholder='請輸入加班日期' readonly value=$OverDate >
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>加班時數</label>
                    <input type='text' class='form-control' name=OverHours id='OverHours' placeholder='請輸入加班時數' value=$OverHours>
                    </div>";
   
     echo'<div class="modal-body">喵喵喵</div>';
     echo'<div class="modal-footer">
                      <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">儲存</button>           
                        <button type="close" class="btn btn-danger mb-3">取消</button>                            
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
              $EmpId=$_REQUEST['EmpId']; 
               display_form($op,$EmpId);
              break;      
        case 2:  //修改資料
                    $EmpId=$_REQUEST['EmpId'];
                    $OverDate=$_REQUEST['OverDate'];
                    $OverHours=$_REQUEST['OverHours'];
                 
                    $sql="update overtime 
                        set EmpId='$EmpId',
                            OverDate='$OverDate',
                            OverHours='$OverHours'
                    where EmpId='$EmpId'
                    and OverDate='$OverDate'";
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
              break;
        case 3: //新增
               $EmpId="";
               echo "
                <script>
                $(function () {
                $('#EmpId').removeAttr('readonly');
                $('#OverDate').removeAttr('readonly');
                    });
                </script> ";
                display_form($op,$EmpId);
              break;
        case 4: //新增資料
            $EmpId=$_REQUEST['EmpId'];
            $OverDate=$_REQUEST['OverDate'];
            $OverHours=$_REQUEST['OverHours'];

              $sql="insert into overtime (EmpId,OverDate,OverHours) values ('$EmpId','$OverDate','$OverHours')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;      
        case 5: //刪除資料              
            $EmpId=$_REQUEST['EmpId'];           
              $sql="delete from overtime where EmpId='$EmpId'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>加班資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=overtime.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                    <tr>
                    <th>員工代號</th>
                    <th>加班日期</th>
                    <th>加班時數</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>員工代號</th>
                    <th>加班日期</th>
                    <th>加班時數</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT EmpId,OverDate,OverHours FROM overtime";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $EmpId=$row['EmpId'];
    $OverDate=$row['OverDate'];
    $OverHours=$row['OverHours'];

    echo "<tr><TD>$EmpId<td> $OverDate<TD>$OverHours";    
    echo "<TD><a href=overtime.php?op=1&EmpId=$EmpId><button type='button' class='btn btn-primary'>修改<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$EmpId]嗎?'))location='overtime.php?EmpId=$EmpId&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();  

    
  ?>