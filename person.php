<?php 
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$EmpId)
  {
      if ($op==3)
      {
        $EmpId="";
        $jobtitle="";
        $Expertise1="";
        $Expertise2="";
        $ForeignLang1="";
        $ForeignLang2="";
        $op=4;
      }
      else
      {
              include("connectdb.php");
              $sql = "SELECT EmpId,jobtitle,Expertise1,Expertise2,ForeignLang1,ForeignLang2 FROM person where EmpId='$EmpId'";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                        $EmpId=$row['EmpId'];
                        $jobtitle=$row['jobtitle'];
                        $Expertise1=$row['Expertise1'];
                        $Expertise2=$row['Expertise2'];
                        $ForeignLang1=$row['ForeignLang1'];
                        $ForeignLang2=$row['ForeignLang2'];
              }
                $op=2;
      }
   
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選專長資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
     echo "<form action=person.php method=post>";
     echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
                    <input type='text' class='form-control' name=EmpId id='EmpId' placeholder='請輸入代號' value=$EmpId>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>職稱</label>
                    <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入職稱' value=$jobtitle>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>專長一</label>
                    <input type='text' class='form-control' name=Expertise1 id='Expertise1' placeholder='請輸入專長一' value=$Expertise1>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>專長二</label>
                    <input type='text' class='form-control' name=Expertise2 id='Expertise2' placeholder='請輸入專長二' value=$Expertise2>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>第一外語</label>
                    <input type='text' class='form-control' name=ForeignLang1 id='ForeignLang1' placeholder='請輸入第一外語' value=$ForeignLang1>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>第二外語</label>
                    <input type='text' class='form-control' name=ForeignLang2 id='ForeignLang2' placeholder='請輸入第二外語' value=$ForeignLang2>
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
                    $jobtitle=$_REQUEST['jobtitle'];
                    $Expertise1=$_REQUEST['Expertise1'];
                    $Expertise2=$_REQUEST['Expertise2'];
                    $ForeignLang1=$_REQUEST['ForeignLang1'];
                    $ForeignLang2=$_REQUEST['ForeignLang2'];
                 
                    $sql="update person 
                        set EmpId='$EmpId',
                            Jobtitle='$jobtitle',
                            Expertise1='$Expertise1',
                            Expertise2='$Expertise2',
                            ForeignLang1='$ForeignLang1',
                            ForeignLang2='$ForeignLang2'
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
            $jobtitle=$_REQUEST['jobtitle'];
            $Expertise1=$_REQUEST['Expertise1'];
            $Expertise2=$_REQUEST['Expertise2'];
            $ForeignLang1=$_REQUEST['ForeignLang1'];
            $ForeignLang2=$_REQUEST['ForeignLang2'];

              $sql="insert into person (EmpId,Jobtitle,Expertise1,Expertise2,ForeignLang1,ForeignLang2) values ('$EmpId','$jobtitle','$Expertise1','$Expertise2','$ForeignLang1','$ForeignLang2')";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;      
        case 5: //刪除資料              
            $EmpId=$_REQUEST['EmpId'];           
              $sql="delete from person where EmpId='$EmpId'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>專長資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=product.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                    <tr>
                    <th>員工代號</th>
                    <th>職稱</th>
                    <th>專長一</th>
                    <th>專長二</th>
                    <th>第一外語</th>
                    <th>第二外語</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>員工代號</th>
                    <th>職稱</th>
                    <th>專長一</th>
                    <th>專長二</th>
                    <th>第一外語</th>
                    <th>第二外語</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT EmpId,jobtitle,Expertise1,Expertise2,ForeignLang1,ForeignLang2 FROM person";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $EmpId=$row['EmpId'];
    $jobtitle=$row['jobtitle'];
    $Expertise1=$row['Expertise1'];
    $Expertise2=$row['Expertise2'];
    $ForeignLang1=$row['ForeignLang1'];
    $ForeignLang2=$row['ForeignLang2'];

    echo "<tr><TD>$EmpId<TD>$jobtitle<td>$Expertise1<TD>$Expertise2<td>$ForeignLang1<TD>$ForeignLang2";    
    echo "<TD><a href=person.php?op=1&EmpId=$EmpId><button type='button' class='btn btn-primary'>修改<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$EmpId]嗎?'))location='person.php?EmpId=$EmpId&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();  

    
  ?>