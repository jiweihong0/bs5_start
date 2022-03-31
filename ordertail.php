<?php 
include("auth.php");
include("template.php");
head("進貨單管理");
    error_reporting(E_ALL & ~E_NOTICE);
    function display_form($op, $PurchaseId)
    {

        if ($op == 3) {
            $seq = "";
            $PurchaseId = "";
            $PurchaseDate = "";
            $op = 4;
        } else {
            include("connectdb.php");
            $sql = "
                SELECT purchaseorder.seq,purchaseorder.PurchaseId,employee.EmpName,purchaseorder.PurchaseDate,supplier.SupplierName,sum(purchasedetail.Qty*purchasedetail.PurchasePrice) as tatal,employee.Empid,supplier.SupplierId
                FROM supplier,pur chaseorder,employee,purchasedetail
                WHERE purchaseorder.SupplierId = supplier.SupplierId
                and purchasedetail.PurchaseId = purchaseorder.PurchaseId
                and employee.EmpId = purchaseorder.EmpId
                and purchaseorder.PurchaseId = $PurchaseId
                GROUP by purchaseorder.PurchaseId ";

            $result = $connect->query($sql);

            /* fetch associative array */
            if ($row = $result->fetch_assoc()) {
                $seq = $row['seq'];
                $PurchaseId = $row['PurchaseId'];
                $PurchaseDate = $row['PurchaseDate'];
                $Empid = $row['Empid'];
                $SupplierId = $row['SupplierId'];
            }
            $op = 2;
        }
        echo "$PurchaseId";
        echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        aria-hidden='true' >";
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Purchase Order</h5>
                        <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span class="fa fa-window-close" style="color:black;"></span></button>
                    </div>';
        echo "<form action=ordertail.php method=post>";
        echo "<input type=hidden name=op value=$op>";
        echo "<div class='mb-3' id =divv5>
                        <label for='exampleFormControlInput1' class='form-label' >序號</label>
                        <input type='text' class='form-control' name=seq id='seq' readonly placeholder='請輸入序號' value=$seq >
                        </div>
                        <div class='mb-3'>
                        <label for='exampleFormControlInput1' class='form-label'>訂單編號</label>
                        <input type='text' class='form-control' name=PurchaseId id='PurchaseId' readonly placeholder='請輸入訂單編號' value=$PurchaseId >
                        </div>
                        ";
        echo  '
            <div class="mb-3">
            <label for="fname" class="form-label">採購人員名稱</label>
            <div class="mb-3">
              <select class="form-select" aria-label="show empname to get empid"
                name="empid" id="empid">
                ';


        include('connectdb.php');
        $sql = "SELECT employee.EmpId, employee.EmpName
                          FROM employee
                          WHERE employee.JobTitle LIKE '%採購%'";

        $result = $connect->query($sql);

        while ($rows = $result->fetch_array()) {

            if ($rows['EmpId'] == $Empid & ($PurchaseId != "")) {
                echo "<option value=" . $rows['EmpId'] . "  selected>" . $rows['EmpName'] . "</option>";
            } else {
                echo "<option value=" . $rows['EmpId'] . ">" . $rows['EmpName'] . "</option>";
            }
        }

        echo  '
              </select>
            </div>
          </div>
            ';

        echo  '
            <div class="mb-3">
            <label for="fname" class="form-label">供應商名稱</label>
            <div class="mb-3">
              <select class="form-select" aria-label="show empname to get empid"
                name="supplierid" id="supplierid">

                ';


        include('connectdb.php');
        $sql = "SELECT supplier.SupplierName,supplier.SupplierId
                  FROM supplier
                  ";

        $result = $connect->query($sql);

        while ($rows = $result->fetch_array()) {
            if ($rows['SupplierId'] == $SupplierId) {
                echo "<option value=" . $rows['SupplierId'] . "  selected>" . $rows['SupplierName'] . "</option>";
            } else {
                echo "<option value=" . $rows['SupplierId'] . ">" . $rows['SupplierName'] . "</option>";
            }
        }

        echo  '
              </select>
            </div>
          </div>
            ';
        echo "   <div class='mb-3'>
                          <label for='exampleFormControlInput1' class='form-label'>採購日期</label>
                        <input type='text' class='form-control' name=PurchaseDate id='PurchaseDate' placeholder='請輸入採購日期' value=$PurchaseDate>
                        </div> ";
        echo '<div class="modal-body">我超屌 王姿雅下去</div>';
        echo '<div class="modal-footer">
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
        echo "   <script>
            $(function () {
                $('#logoutModal2').modal('show')
            });
            $(function () {
                $('#logoutModal3').modal('hide')
            });

            </script> ";
    }


    function display_form2($op, $PurchaseId)
    {
        if ($op == 8) {
            $op = 9;
        }
        else {
            include("connectdb.php");
            $sql = "SELECT purchasedetail.Qty,purchasedetail.PurchasePrice,purchasedetail.seq,purchasedetail.ProdId,purchasedetail.PurchaseId
            FROM purchasedetail,product,purchaseorder
            WHERE product.ProdID = purchasedetail.ProdID
            and purchaseorder.PurchaseId = purchasedetail.PurchaseId
            and purchasedetail.PurchaseId = $PurchaseId";
            $result = $connect->query($sql);
            /* fetch associative array */
            if ($row = $result->fetch_assoc()) {
                $Qty = $row['Qty'];
                $seq = $row['seq'];
                $Proid = $row['ProdId'];
                $PurchasePrice = $row['PurchasePrice'];
                $PurchaseId = $row['PurchaseId'];
            }
            $op = 7;
        }

      
        echo "<div class='modal fade' id='logoutModal3' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
                 aria-hidden='true' >";
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">訂單明細</h5>
                                <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span class="fa fa-window-close" style="color:black;"></span></button>
                            </div>';
        echo "<form action=ordertail.php method=post>";
        echo "<input type=hidden name=op value=$op id =op>
                            <div class='modal-body'>";



        echo "   <div class='form-group row'>
                <label for='exampleFormControlInput1' class='form-label'></label>
                <input type='text' class='form-control' name='PurchaseId' id='PurchaseId'  readonly value='$PurchaseId' style=display:none >
                </div>
                ";
        echo "   <div class='form-group row'>
                <label for='exampleFormControlInput1' class='form-label'></label>
                <input type='text' class='form-control' name='seq' id='seq'  readonly value='$seq' style=display:none >
                </div>
                ";


        echo  "<div class='form-group' id=dss2 >
                        <label for='fname' class='form-label'>產品名稱</label>
                                    <div class='form-group'    >
                                    <select class='form-select' aria-label='show empname to get ProdID'
                                        id='ProdID' name='ProdID'  disabled >
                                        ";
        include('connectdb.php');
        $sql = "SELECT DISTINCT product.ProdName,purchasedetail.ProdId
                                        FROM purchasedetail,product
                                        WHERE purchasedetail.ProdId = product.ProdID;
                                        ";

        $result = $connect->query($sql);

        while ($rows = $result->fetch_array()) {
            if ($Proid == $row['ProdId']) {
                echo "<option value=" . $rows['ProdId'] . " selceted>" . $rows['ProdName'] . "</option>";
            } else {
                echo "<option value=" . $rows['ProdId'] . ">" . $rows['ProdName'] . "</option>";
            }
        }

        echo  '
                                    </select>
                                </div>
                                </div>
                                    ';

        echo "   <div class='form-group row' id=dss0 >
                                    <label for='exampleFormControlInput1' class='form-label'>數量</label>
                                    <input type='text' class='form-control' name=Qty id='Qty'  placeholder='數量' readonly >
                                    </div>
                                    <div class='form-group row' id=dss4>
                                    <label for='exampleFormControlInput1' class='form-label'>單價</label>
                                    <input type='text' class='form-control' name=PurchasePrice id='PurchasePrice' placeholder='單價'  readonly >
                                    </div>
                                    ";

        if($op!=9)
        {
        echo   "<div align='right'>
                                <a href=ordertail.php?op=8&PurchaseId=$PurchaseId><button type='button' class='btn btn-success'>新增訂單 <i class='bi bi-alarm'></i></button></a>
                                        <button type='submit' class='btn btn-info' name='modify' id='modify' style = display:none> <span
                                        class='fa fa-save'></span>修改</button>
                                    <button type='button' class='btn btn-success' name='cancel' id='cancel' style = display:none
                                ><span class=' fa fa-times' onclick=cancel.style='display:none',modify.style='display:none',addnew2.style='',PurchasePrice.value='',Qty.value='',ProdID.value=''>放棄</span></button>
                                    </div>
                            ";
        echo ' <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>產品名稱</th>
                                                    <th>數量</th>
                                                    <th>單價</th>
                                                    <th>總價</th>
                                                    <th>修改</th>
                                                    <th>刪除</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                <th>產品名稱</th>
                                                <th>數量</th>
                                                <th>單價</th>
                                                <th>總價</th>
                                                <th>修改</th>
                                                <th>刪除</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>';
        }
        else{
            echo
            "<div align='right'>
            <a href=ordertail.php?op=8><button type='submit' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>
                    <button type='submit' class='btn btn-info' name='modify' id='modify' style = display:none> <span
                    class='fa fa-save'></span>修改</button>
                <button type='button' class='btn btn-success' name='cancel' id='cancel' style = display:none
            ><span class=' fa fa-times' onclick=cancel.style='display:none',modify.style='display:none',addnew2.style='',PurchasePrice.value='',Qty.value='',ProdID.value=''>放棄</span></button>
                </div>
        ";
        }
        include("connectdb.php");
        $sql = "SELECT product.ProdName,purchasedetail.Qty,purchasedetail.PurchasePrice,(purchasedetail.Qty*purchasedetail.PurchasePrice)as tatal,purchasedetail.PurchaseId
                                            FROM purchasedetail,product,purchaseorder
                                            WHERE product.ProdID = purchasedetail.ProdID
                                            and purchaseorder.PurchaseId = purchasedetail.PurchaseId
                                            and purchaseorder.PurchaseId=$PurchaseId";

        $result = $connect->query($sql);

        /* fetch associative array */
        if ($op != 9){
            while ($row = $result->fetch_assoc()) {
                //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
                $PurchaseId = $row['PurchaseId'];
                $ProdName = $row['ProdName'];
                $Qty = $row['Qty'];
                $PurchasePrice = $row['PurchasePrice'];
                $tatal = $row['tatal'];
                echo "<tr><TD>$ProdName<td> $Qty<TD>$PurchasePrice<td>$tatal";
                echo "<TD><button type='button' name='$ProdName' class='btn btn-primary' onclick=Qty.value=$Qty,PurchasePrice.value=$PurchasePrice,modify.style='',myFunction()>
                                                    <span class='fa fa-edit' style='color:rgb(0,0, 188);'></span><i class='bi bi-alarm'></i></button></a>";
                echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$seq]嗎?'))location='ordertail.php?seq=$seq&op=10'\"><button type='button' class='btn btn-danger'><span class='fa fa-trash' style='color:rgb(188,0, 0);'></span> <i class='bi bi-trash'></i></button>";
            }
        }
         echo "
        <script>
                function myFunction() {
           
            $('#PurchasePrice').removeAttr('readonly');
            $('#Qty').removeAttr('readonly');
            $('#ProdID').removeAttr('disabled');
        }
        </script> ";

        echo '
                                            </tbody>
                                            </table>
                    ';
        echo " </div>
                        </div>
                        </div>
                        </div>
                        </form>";
        echo "   <script>
                        $(function () {
                            $('#logoutModal3').modal('show')
                        });
                        $(function () {
                            $('#logoutModal2').modal('hide')
                        });



                </script> ";

    }
    if (isset($_REQUEST['op'])) {
        $op = $_REQUEST['op'];
        switch ($op) {
            case 1:  //修改
                $PurchaseId = $_REQUEST['PurchaseId'];
                display_form($op, $PurchaseId);
                break;
            case 2:  //修改資料
                $PurchaseId = $_REQUEST['PurchaseId'];
                $PurchaseDate = $_REQUEST['PurchaseDate'];
                $supplierid = $_REQUEST['supplierid'];
                $empid = $_REQUEST['empid'];

                $sql = "UPDATE purchaseorder
                SET purchaseorder.EmpId = '$empid',
                purchaseorder.SupplierId = '$supplierid',
                purchaseorder.PurchaseDate = '$PurchaseDate'
                WHERE purchaseorder.PurchaseId = '$PurchaseId'
                ";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
            case 3: //新增
                $PurchaseId = "";
                echo "
                <script>
                $(function () {
                $('#divv5').hide();
                $('#PurchaseId').removeAttr('readonly');
                    });
                </script> ";

                display_form($op, $PurchaseId);
                break;
            case 4: //新增資料
                $PurchaseId = $_REQUEST['PurchaseId'];
                $empid = $_REQUEST['empid'];
                $supplierid = $_REQUEST['supplierid'];
                $PurchaseDate = $_REQUEST['PurchaseDate'];
                $sql = "insert into purchaseorder (PurchaseId,empid,supplierid,PurchaseDate) values ('$PurchaseId','$empid','$supplierid','$PurchaseDated')";
                include("connectdb.php");
                include('dbutil.php');

                execute_sql($sql);
                break;
            case 5: //刪除資料
                $PurchaseId = $_REQUEST['PurchaseId'];
                $sql = "delete from purchaseorder where PurchaseId='$PurchaseId'";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
            case 6:
              
                $PurchaseId = $_REQUEST['PurchaseId'];
                display_form2($op, $PurchaseId);
                break;
            case 7:
                $PurchaseId = $_REQUEST['PurchaseId'];
                $PurchasePrice = $_REQUEST['PurchasePrice'];
                $Proid = $_REQUEST['ProdID'];
                $Qty = $_REQUEST['Qty'];
                $seq = $_REQUEST['seq'];
                echo $seq;
                echo $Proid;
                $sql = "UPDATE purchasedetail
                SET purchasedetail.PurchasePrice = '$PurchasePrice',
                purchasedetail.Prodid = '$Proid',
                purchasedetail.Qty = '$Qty',
                purchasedetail.PurchaseId = '$PurchaseId'
                WHERE purchasedetail.seq = '$seq'
                ";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
            case 8: //新增
                echo "
                <script>
                $(function () {
                    $('#PurchasePrice').removeAttr('readonly');
                    $('#Qty').removeAttr('readonly');
                    $('#ProdID').removeAttr('disabled');
                });
                </script> ";

                    $PurchaseId = $_REQUEST['PurchaseId'];
                    display_form2($op, $PurchaseId);
                    break;
            case 9: //新增資料
                $ProdID = $_REQUEST['ProdID'];
                $Qty = $_REQUEST['Qty'];
                $PurchasePrice = $_REQUEST['PurchasePrice'];
                $PurchaseId= $_REQUEST['PurchaseId'];
                $sql = "insert into purchasedetail (PurchaseId,ProdID,Qty,PurchasePrice) values ('$PurchaseId','$ProdID','$Qty','$PurchasePrice')";
                include("connectdb.php");
                include('dbutil.php');
                echo  $Qty;
                echo  $ProdID;
                echo  $PurchaseId;
                echo $PurchasePrice;
                execute_sql($sql);
                break;

            case 10:
                $seq = $_REQUEST['seq'];
                $sql = "delete from purchasedetail where seq='$seq'";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;

        }
       
    }
horizontal_bar($username);
echo"<!-- DataTales Example -->
<div class='card shadow mb-4'>
    <div class='card-header py-1'>
        <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
        <p align=right>
            <a href=ordertail.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>
        </p>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th>Seq</th>
                        <th>訂單編號</th>
                        <th>採購人員</th>
                        <th>採購日期</th>
                        <th>供應商名稱</th>
                        <th>總額</th>
                        <th>編輯(抬頭)</th>
                        <th>編輯(明細)</th>
                        <th>刪除</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Seq</th>
                        <th>訂單編號</th>
                        <th>採購人員</th>
                        <th>採購日期</th>
                        <th>供應商名稱</th>
                        <th>總額</th>
                        <th>編輯(抬頭)</th>
                        <th>編輯(明細)</th>
                        <th>刪除</th>
                    </tr>
                </tfoot>
                <tbody>
";
include("connectdb.php");
$sql = "SELECT purchaseorder.seq,purchaseorder.PurchaseId,ifnull(tatal,0)as tatal,employee.EmpName,supplier.SupplierName,purchaseorder.PurchaseDate
from employee,supplier,purchaseorder left JOIN (SELECT  purchasedetail.PurchaseId,sum(purchasedetail.Qty*purchasedetail.PurchasePrice)as tatal
                    FROM purchasedetail
                    GROUP by purchasedetail.PurchaseId)R1
on R1.PurchaseId = purchaseorder.PurchaseId
WHERE employee.EmpId = purchaseorder.EmpId
and supplier.SupplierId = purchaseorder.SupplierId;";

$result = $connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $seq = $row['seq'];
    $PurchaseId = $row['PurchaseId'];
    $EmpName = $row['EmpName'];
    $PurchaseDate = $row['PurchaseDate'];
    $SupplierName = $row['SupplierName'];
    $tatal = $row['tatal'];

    echo "<tr><TD>$seq<td> $PurchaseId<TD>$EmpName<td>$PurchaseDate<TD>$SupplierName<td>$tatal";
    echo "<TD><a href=ordertail.php?op=1&PurchaseId=$PurchaseId><button type='button' class='btn btn-primary'><span class='fa fa-edit'></span>訂單抬頭<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=ordertail.php?op=6&PurchaseId=$PurchaseId><button type='button' class='btn btn-primary'><span class='fa fa-edit'></span>訂單明細<i class='bi bi-alarm'></i></button></a>";
    echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$EmpName]嗎?'))location='ordertail.php?PurchaseId=$PurchaseId&op=5'\"><button type='button' class='btn btn-danger'><span class='fa fa-trash'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";
footer();
    

    
    
?>

