<?php 
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$EmpId)
  {
      if ($op==3)
      {
        $EmpId="";
        $OutsideJob1="";
        $OutsideJob2="";
        $CompJob1="";
        $CompJob2="";
        $op=4;
      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT EmpId,OutsideJob1,OutsideJob2,CompJob1,CompJob2 FROM exp where EmpId='$EmpId'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                        $EmpId=$row['EmpId'];
                        $OutsideJob1=$row['OutsideJob1'];
                        $OutsideJob2=$row['OutsideJob2'];
                        $CompJob1=$row['CompJob1'];
                        $CompJob2=$row['CompJob2'];
              }
                $op=2;
      }
   
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選工作經驗資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
     echo "<form action=exp.php method=post>";
     echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
                    <input type='text' class='form-control' name=EmpId id='EmpId' placeholder='請輸入代號' value=$EmpId>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>在外任職1</label>
                    <input type='text' class='form-control' name=OutsideJob1 id='OutsideJob1' placeholder='請輸入在外任職1' value=$OutsideJob1>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>在外任職2</label>
                    <input type='text' class='form-control' name=OutsideJob2 id='OutsideJob2' placeholder='請輸入在外任職2' value=$OutsideJob2>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>公司任職1</label>
                    <input type='text' class='form-control' name=CompJob1 id='CompJob1' placeholder='請輸入公司任職1' value=$CompJob1>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>公司任職2</label>
                    <input type='text' class='form-control' name=CompJob2 id='CompJob2' placeholder='請輸入公司任職2' value=$CompJob2>
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
              $EmpId=$_REQUEST['EmpId']; 
               display_form($op,$EmpId);
              break;      
        case 2:  //修改資料
                    $EmpId=$_REQUEST['EmpId'];
                    $OutsideJob1=$_REQUEST['OutsideJob1'];
                    $OutsideJob2=$_REQUEST['OutsideJob2'];
                    $CompJob1=$_REQUEST['CompJob1'];
                    $CompJob2=$_REQUEST['CompJob2'];
                 
                    $sql="update exp 
                        set EmpId='$EmpId',
                            OutsideJob1='$OutsideJob1',
                            OutsideJob2='$OutsideJob2',
                            CompJob1='$CompJob1',
                            CompJob2='$CompJob2'
                    where EmpId='$EmpId'";
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
              break;
        case 3: //新增
               $EmpId="";
                display_form($op,$EmpId);
              break;
        case 4: //新增資料
            $EmpId=$_REQUEST['EmpId'];
            $OutsideJob1=$_REQUEST['OutsideJob1'];
            $OutsideJob2=$_REQUEST['OutsideJob2'];
            $CompJob1=$_REQUEST['CompJob1'];
            $CompJob2=$_REQUEST['CompJob2'];

              $sql="insert into exp (EmpId,OutsideJob1,OutsideJob2,CompJob1,CompJob2) values ('$EmpId','$OutsideJob1','$OutsideJob2','$CompJob1','$CompJob2')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;      
        case 5: //刪除資料              
            $EmpId=$_REQUEST['EmpId'];           
              $sql="delete from exp where EmpId='$EmpId'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>工作經驗資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=exp.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                        <th>員工代號</th>
                        <th>在外任職一</th>
                        <th>在外任職二</th>
                        <th>公司任職一</th>
                        <th>公司任職二</th>
                        <th>修改</th>
                        <th>刪除</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>員工代號</th>
                        <th>在外任職一</th>
                        <th>在外任職二</th>
                        <th>公司任職一</th>
                        <th>公司任職二</th>
                        <th>修改</th>
                        <th>刪除</th>
                        </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT EmpId,OutsideJob1,OutsideJob2,CompJob1,CompJob2 FROM exp";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $EmpId=$row['EmpId'];
    $OutsideJob1=$row['OutsideJob1'];
    $OutsideJob2=$row['OutsideJob2'];
    $CompJob1=$row['CompJob1'];
    $CompJob2=$row['CompJob2'];

    echo "<tr><TD>$EmpId<td> $OutsideJob1<TD>$OutsideJob2<td>$CompJob1<TD>$CompJob2";    
    echo "<TD><a href=exp.php?op=1&EmpId=$EmpId><button type='button' class='btn btn-primary'>修改<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$EmpId]嗎?'))location='exp.php?EmpId=$EmpId&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();  

    
?>