<?php  
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$prodid)
  {
    if ($op==3)
    {
      $prodid="";
      $prodname="";
      $unitprice="";
      $cost="";
      $op=4;

    }
    else
    {
        include("connectdb.php");
        $sql = "SELECT prodid,prodname,unitprice,cost FROM product where prodid='$prodid'";

        $result =$connect->query($sql);

        /* fetch associative array */
        if ($row = $result->fetch_assoc()) {
            $prodid=$row['prodid'];
            $prodname=$row['prodname'];
            $unitprice=$row['unitprice'];
            $cost=$row['cost'];
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
      echo "<form action=product.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=prodid id='prodid' placeholder='請輸入代號' value=$prodid>
              </div>
              <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品名稱</label>
              <input type='text' class='form-control' name=prodname id='prodname' placeholder='請輸入代號' value=$prodname>
              </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品價格</label>
              <input type='text' class='form-control' name=unitprice id='unitprice' placeholder='請輸入主管姓名' value=$unitprice>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=cost id='cost' placeholder='請輸入主管姓名' value=$cost>
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
               $prodid=$_REQUEST['prodid']; 
                display_form($op,$prodid);
               break;      
         case 2:  //修改資料
                $prodid=$_REQUEST['prodid'];
               $prodname=$_REQUEST['prodname'];
               $unitprice=$_REQUEST['unitprice'];
               $cost=$_REQUEST['cost'];
 
                   $sql="update product 
                           set Prodid='$prodid',
                               Prodname='$prodname',
                               Unitprice='$unitprice',
                               Cost='$cost'
                         where prodid='$prodid'";
                   include("connectdb.php");
                   include('dbutil.php');
                   execute_sql($sql);
               break;
         case 3: //新增
                $prodid="";
                 display_form($op,$prodid);
               break;
         case 4: //新增資料
               $prodid=$_REQUEST['prodid'];
               $prodname=$_REQUEST['prodname'];
               $unitprice=$_REQUEST['unitprice'];
               $cost=$_REQUEST['cost'];
               $sql="insert into product (Prodid,Prodname,Unitprice,Cost) values ('$prodid','$prodname','$unitprice','$cost')";
               include("connectdb.php");
               include('dbutil.php');
               execute_sql($sql);
               break;      
         case 5: //刪除資料              
               $prodid=$_REQUEST['prodid'];              
             
               $sql="delete from product where Prodid='$prodid'";
               include("connectdb.php");
               include('dbutil.php');
               execute_sql($sql);
               break;
 
       }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>商品基本資料</h1>
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
                            <th>序號</th>
                            <th>產品名稱</th>
                            <th>單價</th>
                            <th>成本</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>序號</th>
                            <th>產品名稱</th>
                            <th>單價</th>
                            <th>成本</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT ProdID,ProdName,UnitPrice,Cost FROM product";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
  //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
  $prodid=$row['ProdID'];
  $prodname=$row['ProdName'];
  $unitprice=$row['UnitPrice'];
  $cost=$row['Cost'];
  echo "<tr><TD>$prodid<td> $prodname<TD>$unitprice<TD>$cost";    
  echo "<TD><a href=product.php?op=1&prodid=$prodid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
  echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$prodname]嗎?'))location='product.php?prodid=$prodid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();


    
?>