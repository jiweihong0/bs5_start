<?php
include("auth.php");
include("template.php");
head("進貨單管理");
error_reporting(E_ALL & ~E_NOTICE);
function display_form($op, $OrderId)
{

    if ($op == 3) {
        $seq = "";
        $OrderId = "";
        $OrderDate = "";
        $op = 4;
    } else {
        include("connectdb.php");
        $sql = "
            SELECT DISTINCT salesorder.seq as seq,
            salesorder.OrderId as orderid,
            ifnull(totalmoney,0)as totalmoney,
            employee.EmpName as empname
            ,customer.CustName as custname
            ,salesorder.OrderDate as datee
            from employee,customer,salesorder left JOIN (SELECT orderdetail.OrderId,ROUND(sum(orderdetail.Qty*saledetail.UnitPrice*orderdetail.Discount))as totalmoney
                                                         FROM saledetail,orderdetail
                                                         WHERE saledetail.ProdId=orderdetail.ProdId
                                                         GROUP by orderdetail.OrderId)R1 on R1.OrderId = salesorder.OrderId
            WHERE employee.EmpId = salesorder.EmpId
            and customer.CustId = salesorder.CustId
            ORDER BY salesorder.OrderId";

        $result = $connect->query($sql);

        /* fetch associative array */
        if ($row = $result->fetch_assoc()) {
            $seq = $row['seq'];
            $OrderId = $row['orderid'];
            $OrderDate = $row['datee'];
            $CustId = $row['custname'];
            $EmpId = $row['empname'];
        }
        $op = 2;
    }
    echo $OrderId;
    echo "<div class='modal fade' id='logoutModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        aria-hidden='true' >";
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Salorder Order</h5>
                        <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span class="fa fa-window-close" style="color:black;"></span></button>
                    </div>';
    echo "<form action=salorder.php method=post>";
    echo "<input type=hidden name=op value=$op>";
    echo "<div class='mb-3' id =divv5>
                        <label for='exampleFormControlInput1' class='form-label' >序號</label>
                        <input type='text' class='form-control' name=seq id='seq' readonly placeholder='請輸入序號' value=$seq>
                        </div>
                        <div class='mb-3'>
                        <label for='exampleFormControlInput1' class='form-label'>訂單編號</label>
                        <input type='text' class='form-control' name=OrderId id='OrderId' readonly placeholder='請輸入訂單編號' value='$OrderId' >
                        </div>
                        ";
    echo  '
            <div class="mb-3">
            <label for="fname" class="form-label">銷貨人員</label>
            <div class="mb-3">
              <select class="form-select" aria-label="show empname to get empid"
                name="empid" id="empid">
                ';


    include('connectdb.php');
    $sql = "SELECT DISTINCT employee.EmpId, employee.EmpName
            FROM employee,salesorder
            WHERE employee.EmpId =salesorder.EmpId  ";

    $result = $connect->query($sql);

    while ($rows = $result->fetch_array()) {

        if ($rows['EmpId'] == $EmpId) {
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
            <label for="fname" class="form-label">客戶名稱</label>
            <div class="mb-3">
              <select class="form-select" aria-label="show empname to get empid"
                name="CustName" id="CustName">

                ';


    include('connectdb.php');
    $sql = "SELECT customer.CustName,customer.CustId
                  FROM customer
                  ";

    $result = $connect->query($sql);

    while ($rows = $result->fetch_array()) {
        if ($rows['CustId'] == $CustId) {
            echo "<option value=" . $rows['CustId'] . "  selected>" . $rows['CustName'] . "</option>";
        } else {
            echo "<option value=" . $rows['CustId'] . ">" . $rows['CustName'] . "</option>";
        }
    }

    echo  '
              </select>
            </div>
          </div>
            ';
    echo "   <div class='mb-3'>
                          <label for='exampleFormControlInput1' class='form-label'>訂單日期</label>
                        <input type='text' class='form-control' name=OrderDate id='OrderDate' placeholder='請輸入銷貨日期' value=$OrderDate>
                        </div> ";
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


function display_form2($op, $OrderId)
{
    if ($op == 8) {
        $op = 9;
    } else {

        $op = 7;
    }
    include("connectdb.php");
    $sql = "SELECT saledetail.Qty,saledetail.UnitPrice,saledetail.seq,saledetail.ProdId,saledetail.OrderId,saledetail.ProdName
        FROM saledetail
        WHERE saledetail.OrderId = $OrderId";
    $result = $connect->query($sql);
    /* fetch associative array */
    if ($row = $result->fetch_assoc()) {
        $Qty = $row['Qty'];
        $seq = $row['seq'];
        $ProdId = $row['ProdId'];
        $UnitPrice = $row['UnitPrice'];
        $OrderId = $row['OrderId'];
        $ProdName = $row['ProdName'];
    }
    echo "$ProdId";
    echo "<div class='modal fade' id='logoutModal3' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
                 aria-hidden='true' >";
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">銷貨明細</h5>
                                <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span class="fa fa-window-close" style="color:black;"></span></button>
                            </div>';
    echo "<form action=salorder.php?ProdId=$ProdId method=post>";
    echo "<input type=hidden name=op value=$op>
                            <div class='modal-body'>";



    echo "   <div class='form-group row'>
                <label for='exampleFormControlInput1' class='form-label'></label>
                <input type='text' class='form-control' name='OrderId' id='OrderId'  readonly value='$OrderId' style=display:none >
                </div>
                ";
    echo "   <div class='form-group row'>
                <label for='exampleFormControlInput1' class='form-label'></label>
                <input type='text' class='form-control' name='seq' id='seq'  readonly value='$seq' style=display:none >
                </div>
                ";
    echo "   <div class='form-group row'>
                <label for='exampleFormControlInput1' class='form-label'></label>
                <input type='text' class='form-control' name='ProdName' id='ProdName'  readonly value='$ProdName' style=display:none >
                </div>
                ";


    echo  "<div class='form-group' id=dss2 >
                        <label for='fname' class='form-label'>產品名稱</label>
                                    <div class='form-group'    >
                                    <select class='form-select' aria-label='show empname to get ProdID'
                                        id='ProdId' name='ProdId'  >
                                        ";
    include('connectdb.php');
    $sql = "SELECT DISTINCT saledetail.ProdName,saledetail.ProdId
        FROM saledetail
                                        ";

    $result = $connect->query($sql);

    while ($rows = $result->fetch_array()) {
        if ($ProdId == $row['ProdId']) {

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

    echo "   <div class='form-group row' id=dss0>
                                    <label for='exampleFormControlInput1' class='form-label'>數量</label>
                                    <input type='text' class='form-control' name=Qty id='Qty'  placeholder='數量'  >
                                    </div>
                                    <div class='form-group row' id=dss4>
                                    <label for='exampleFormControlInput1' class='form-label'>單價</label>
                                    <input type='text' class='form-control' name=UnitPrice id='UnitPrice' placeholder='單價'   >
                                    </div>
                                    
                                    ";


    if ($op != 9) {
        echo   "<div align='right'>
                                <a href=salorder.php?op=8&OrderId=$OrderId><button type='button' class='btn btn-success'>新增銷貨單 <i class='bi bi-alarm'></i></button></a>
                                        <button type='submit' class='btn btn-info' name='modify' id='modify' style = display:none> <span
                                        class='fa fa-save'></span>修改</button>
                                    <button type='button' class='btn btn-success' name='cancel' id='cancel' style = display:none
                                ><span class=' fa fa-times' onclick=cancel.style='display:none',modify.style='display:none',addnew2.style='',UnitPrice.value='',Qty.value='',ProdID.value=''>放棄</span></button>
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
    } else {
        echo
        "<div align='right'>
            <form action=salorder.php?op=9&seq=$seq&ProdName=$ProdName method=post>
            <a href=salorder.php?op=8><button type='submit' class='btn btn-success'>新增
            <i class='bi bi-alarm'></i>
            </button>
            </a>
            <button type='submit' class='btn btn-info' name='modify' id='modify' style = display:none>
            <span
                    class='fa fa-save'></span>修改</button>
                <button type='button' class='btn btn-success' name='cancel' id='cancel' style = display:none
            ><span class=' fa fa-times' onclick=cancel.style='display:none',modify.style='display:none',addnew2.style='',UnitPrice.value='',Qty.value='',ProdID.value=''>放棄</span></button>
            </form>
                </div>
        ";
    }
    include("connectdb.php");
    $sql = "SELECT DISTINCT saledetail.ProdName,saledetail.Qty,saledetail.UnitPrice,(saledetail.Qty*saledetail.UnitPrice)as tatal,saledetail.OrderId,saledetail.ProdId
        FROM saledetail
        WHERE saledetail.OrderId = $OrderId";

    $result = $connect->query($sql);

    /* fetch associative array */
    if ($op != 9) {
        while ($row = $result->fetch_assoc()) {
            //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
            $OrderId = $row['OrderId'];
            $ProdName = $row['ProdName'];
            $ProdId = $row['ProdId'];
            $Qty = $row['Qty'];
            $UnitPrice = $row['UnitPrice'];
            $tatal = $row['tatal'];
            echo "<tr><TD>$ProdName<td> $Qty<TD>$UnitPrice<td>$tatal";
            echo "<TD><button type='button' name='$ProdName' class='btn btn-primary' onclick=Qty.value=$Qty,UnitPrice.value=$UnitPrice,modify.style='',cancel.style='',addnew2.style='display:none'>
                                                    <span class='fa fa-edit' style='color:rgb(0,0, 188);'></span><i class='bi bi-alarm'></i></button></a>";
            echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$seq]嗎?'))location='salorder.php?seq=$seq&OrderId=$OrderId&op=10'\"><button type='button' class='btn btn-danger'><span class='fa fa-trash' style='color:rgb(188,0, 0);'></span> <i class='bi bi-trash'></i></button>";
        }
    }

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

?>
    <?php

    if (isset($_REQUEST['op'])) {
        $op = $_REQUEST['op'];
        switch ($op) {
            case 1:  //修改
                $OrderId = $_REQUEST['OrderId'];
                display_form($op, $OrderId);
                break;
            case 2:  //修改資料
                $empid = $_REQUEST['empid'];
                $CustName = $_REQUEST['CustName'];
                $OrderDate = $_REQUEST['OrderDate'];
                $empid = $_REQUEST['empid'];
                $OrderId = $_REQUEST['OrderId'];

                $sql = "UPDATE salesorder
                SET salesorder.EmpId = '$empid',
                salesorder.CustId = '$CustName',
                salesorder.OrderDate = '$OrderDate '
                WHERE salesorder.OrderId = '$OrderId'
                ";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
            case 3: //新增
                $OrderId = "";
                echo "
                <script>
                $(function () {
                $('#divv5').hide();
                $('#OrderId').removeAttr('readonly');
                    });
                </script> ";

                display_form($op, $OrderId);
                break;
            case 4: //新增資料
                $CustName = $_REQUEST['CustName'];
                $OrderDate = $_REQUEST['OrderDate'];
                $empid = $_REQUEST['empid'];
                $OrderId = $_REQUEST['OrderId'];
                $sql = "insert into salesorder (OrderId,empid,Custid,OrderDate) values ('$OrderId','$empid','$CustName','$OrderDate')";
                include("connectdb.php");
                include('dbutil.php');

                execute_sql($sql);
                break;
            case 5: //刪除資料
                $OrderId = $_REQUEST['OrderId'];
                $sql = "delete from salesorder where OrderId='$OrderId'";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
            case 6:

                $OrderId = $_REQUEST['OrderId'];
                display_form2($op, $OrderId);
                break;
            case 7:
                $OrderId = $_REQUEST['OrderId'];
                $UnitPrice = $_REQUEST['UnitPrice'];
                $ProdId = $_REQUEST['ProdId'];
                echo $ProdId;
                $Qty = $_REQUEST['Qty'];
                $seq = $_REQUEST['seq'];
                $sql = "UPDATE saledetail
                SET saledetail.UnitPrice = '$UnitPrice',
                saledetail.ProdId = '$ProdId',
                saledetail.Qty = '$Qty',
                saledetail.OrderId = '$OrderId'
                WHERE saledetail.seq = '$seq'
                ";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
            case 8: //新增
                $OrderId = $_REQUEST['OrderId'];
                display_form2($op, $OrderId);
                break;
            case 9: //新增資料
                $seq = $_REQUEST['seq'];
                $ProdId = $_REQUEST['ProdId'];
                $Qty = $_REQUEST['Qty'];
                $UnitPrice = $_REQUEST['UnitPrice'];
                $OrderId = $_REQUEST['OrderId'];

                echo $ProdId;
                $sql2 = "SELECT DISTINCT product.ProdName
                FROM product,saledetail
                WHERE product.ProdID =saledetail.ProdID
                and product.ProdID = '$ProdId'";
                include("connectdb.php");
                $result = $connect->query($sql2);

                if ($row = $result->fetch_assoc()) {
                    $ProdName = $row['ProdName'];
                }

                $sql = "insert into saledetail (seq,OrderId,ProdID,Qty,ProdName,UnitPrice) values ('$seq','$OrderId','$ProdId','$Qty','$ProdName','$UnitPrice')";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;

            case 10:
                $seq = $_REQUEST['seq'];
                $OrderId = $_REQUEST['OrderId'];
                $sql = "delete 
                from saledetail 
                where seq= $seq
                and OrderId = '$OrderId'";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
        }
    }
    horizontal_bar($username);
    echo "<div class='container-fluid'>

<!-- Page Heading -->
<h1 class='h3 mb-2 text-gray-800'>銷貨單管理</h1>


<!-- DataTales Example -->
<div class='card shadow mb-4'>
    <div class='card-header py-1'>
        <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
        <p align=right>
            <a href=salorder.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>
        </p>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th>序號</th>
                        <th>訂單編號</th>
                        <th>銷貨人員</th>
                        <th>訂單日期</th>
                        <th>客戶名稱</th>
                        <th>總額</th>
                        <th>編輯(抬頭)</th>
                        <th>編輯(明細)</th>
                        <th>刪除</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>序號</th>
                        <th>訂單編號</th>
                        <th>銷貨人員</th>
                        <th>訂單日期</th>
                        <th>供應商名稱</th>
                        <th>利潤</th>
                        <th>編輯(抬頭)</th>
                        <th>編輯(明細)</th>
                        <th>刪除</th>
                    </tr>
                </tfoot>
                <tbody>";
    include("connectdb.php");
    $sql = "SELECT DISTINCT salesorder.seq ,salesorder.OrderId ,ifnull(totalmoney,0)as totalmoney,employee.EmpName ,customer.CustName 
                ,salesorder.OrderDate 
                from employee,customer,salesorder left JOIN (SELECT  saledetail.OrderId,sum(saledetail.Qty*saledetail.UnitPrice)as totalmoney
                                    FROM saledetail                                                               
                                    GROUP by saledetail.OrderId)R1 on R1.OrderId = salesorder.OrderId
                WHERE employee.EmpId = salesorder.EmpId
                and customer.CustId = salesorder.CustId  
    ORDER BY `salesorder`.`seq` ASC;";

    $result = $connect->query($sql);

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        $seq = $row['seq'];
        $OrderId = $row['OrderId'];
        $EmpName = $row['EmpName'];
        $OrderDate = $row['OrderDate'];
        $CustName = $row['CustName'];
        $tatal = $row['totalmoney'];

        echo "<tr><TD>$seq<td> $OrderId <TD>$EmpName<td>$OrderDate<TD>$CustName<td>$tatal";
        echo "<TD><a href=salorder.php?op=1&OrderId=$OrderId><button type='button' class='btn btn-primary'><span class='fa fa-edit'></span>銷貨抬頭<i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=salorder.php?op=6&OrderId=$OrderId><button type='button' class='btn btn-primary'><span class='fa fa-edit'></span>銷貨明細<i class='bi bi-alarm'></i></button></a>";
        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$EmpName]嗎?'))location='salorder.php?OrderId=$OrderId&op=5'\"><button type='button' class='btn btn-danger'><span class='fa fa-trash'>刪除 <i class='bi bi-trash'></i></button>";
    }
    echo "
                </tbody>
                </div>
                </div>";
    footer();

    ?>
