<?php
include("auth.php");
include("template.php");
head("公司系統");
  function display_form($op,$ProdID)
  {
      if ($op==3)
      {
        $ProdName="";
        $Stock="";
        $SafeStock="";
        $Cost="";
        $UnitPrice="";
        $ProdID="";
        $op=4;
      }
      else
      {
              include("connectdb.php");
             
              $sql = "SELECT product.ProdName,inv.Stock,inv.SafeStock,product.Cost,product.UnitPrice,(product.UnitPrice*inv.Stock) as tatal,product.ProdID
              FROM product,inv
              WHERE product.ProdID =inv.ProdId
              and product.ProdID ='$ProdID';";

              $result =$connect->query($sql);

              /* fetch associative array */
              if ($row = $result->fetch_assoc()) {
                    $ProdName=$row['ProdName'];
                    $Stock=$row['Stock'];
                    $SafeStock=$row['SafeStock'];
                    $Cost=$row['Cost'];
                    $UnitPrice=$row['UnitPrice'];
                    $tatal=$row['tatal'];
                    $ProdID=$row['ProdID'];
              }
                $op=2;
      }
      echo"$ProdID";
   
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
      aria-hidden='true'>";
      echo '<div class="modal-dialog" role="document">';
      echo '<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">所選資料如下</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>';
     echo "<form action=stock1.php method=post>";
     echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>產品名稱</label>
                    <input type='text' class='form-control' name=ProdName id='ProdName' placeholder='請輸入產品名稱' readonly value=$ProdName>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
                    <input type='text' class='form-control' name=ProdID id='ProdID' placeholder='請輸入產品名稱' readonly value=$ProdID>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>現有庫存量</label>
                    <input type='text' class='form-control' name=Stock id='Stock' placeholder='請輸入現有庫存量' value=$Stock>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>安全庫存量</label>
                    <input type='text' class='form-control' name=SafeStock id='SafeStock' placeholder='請輸入安全庫存量' value=$SafeStock>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>成本</label>
                    <input type='text' class='form-control' name=Cost id='Cost' placeholder='請輸入成本' value=$Cost>
                    </div>
                    <div class='mb-3'>
                    <label for='exampleFormControlInput1' class='form-label'>單價</label>
                    <input type='text' class='form-control' name=UnitPrice id='UnitPrice' placeholder='請輸入單價' value=$UnitPrice>
                    </div>
                  "
                    ;
   
     echo'<div class="modal-body">我超屌 王姿雅下去</div>';
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
              $ProdID= $_REQUEST['ProdID']; 
               display_form($op,$ProdID);
              break;      
        case 2:  //修改資料
                    $ProdName=$_REQUEST['ProdName'];
                    $Stock=$_REQUEST['Stock'];
                    $SafeStock=$_REQUEST['SafeStock'];
                    $Cost=$_REQUEST['Cost'];
                    $UnitPrice=$_REQUEST['UnitPrice'];
                    $ProdID=$_REQUEST['ProdID'];
                    
                    $sql="update product,inv
                        set inv.Stock='$Stock',
                            inv.SafeStock='$SafeStock',
                            product.Cost='$Cost',
                            product.UnitPrice='$UnitPrice'
                            where product.ProdID='$ProdID'
                    and product.ProdID=inv.ProdId;";
                  include("connectdb.php");
                  include('dbutil.php');
                  execute_sql($sql);
              break;
        case 3: //新增
            
               $ProdID="";
               echo "
               <script>
               $(function () {
               $('#ProdName').removeAttr('readonly');
               $('#ProdID').removeAttr('readonly');
                   });
               </script> ";
                display_form($op,$ProdID);
              break;
        case 4: //新增資料
            $ProdName=$_REQUEST['ProdName'];
            $Stock=$_REQUEST['Stock'];
            $SafeStock=$_REQUEST['SafeStock'];
            $Cost=$_REQUEST['Cost'];
            $UnitPrice=$_REQUEST['UnitPrice'];
            $ProdID=$_REQUEST['ProdID'];
              $sql="INSERT 
              INTO product (product.ProdName,product.ProdID,product.UnitPrice,product.Cost)
                        VALUES ('$ProdName','$ProdID','$UnitPrice','$Cost')
             ";
             $sql2 ="INSERT 
             INTO inv (inv.ProdID,inv.Stock,inv.SafeStock)
                       VALUES ('$ProdID','$Stock','$SafeStock')
            ";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              execute_sql($sql2);
              break;      
        case 5: //刪除資料              
            $ProdID=$_REQUEST['ProdID'];     
            echo "$ProdID";
              $sql="DELETE p1 FROM product p1,
              inv p2
                WHERE
              p1.ProdID = p2.ProdID AND p1.ProdID='$ProdID';";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
              break;

      }      
  
    }
horizontal_bar($username);
echo"<!-- Page Heading -->
                    <h1 class='h3 mb-2 text-gray-800'>庫存管理</h1>
                    

                    <!-- DataTales Example -->
                    <div class='card shadow mb-4'>
                        <div class='card-header py-1'>
                            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
                            <p align=right>
                            <a href=stock1.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
                        </div>
                        <div class='card-body'>
                            <div class='table-responsive'>
                                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>產品名稱</th>
                                            <th>現有存貨量</th>
                                            <th>安群存貨量</th>
                                            <th>成本</th>
                                            <th>單價</th>
                                            <th>庫存成本</th>>
                                            <th>修改</th>
                                            <th>刪除</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>產品名稱</th>
                                            <th>現有存貨量</th>
                                            <th>安群存貨量</th>
                                            <th>成本</th>
                                            <th>單價</th>
                                            <th>庫存成本</th>>
                                            <th>修改</th>
                                            <th>刪除</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>";
                                    include("connectdb.php");
                                    $sql = "SELECT product.ProdName,inv.Stock,inv.SafeStock,product.Cost,product.UnitPrice,(product.UnitPrice*inv.Stock) as tatal,product.ProdID
                                    FROM product,inv
                                    WHERE product.ProdID =inv.ProdId;";

                                    $result =$connect->query($sql);

                                    /* fetch associative array */
                                    while ($row = $result->fetch_assoc()) {
                                        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
                                        $ProdName=$row['ProdName'];
                                        $Stock=$row['Stock'];
                                        $SafeStock=$row['SafeStock'];
                                        $Cost=$row['Cost'];
                                        $UnitPrice=$row['UnitPrice'];
                                        $tatal=$row['tatal'];
                                        $ProdID=$row['ProdID'];

                                        echo "<tr><TD>$ProdName<td> $Stock<TD>$SafeStock<td>$Cost<TD>$UnitPrice<td>$tatal";    
                                        echo "<TD><a href=stock1.php?op=1&ProdID=$ProdID><button type='button' class='btn btn-primary'>修改<i class='bi bi-alarm'></i></button></a>";
                                        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$ProdID]嗎?'))location='stock1.php?ProdID=$ProdID&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
                                    } 
                                    echo"
                                    </tbody>
                                    </div>
                                    </div>";

footer();
?>