<?php
include("auth.php");
include("template.php");
head("公司系統");
function display_form($op,$custid)
  {
    if ($op==3)
    {
      $custid="";
      $custname="";
      $city="";
      $address="";
      $contact="";
      $jobtitle="";
      $phone="";
      $industry="";
      $taxno="";
      $op=4;

    }
    else
    {
        include("connectdb.php");
        $sql = "SELECT CustName,CustId,City,Address,ZipCode, Contact, JobTitle, Phone, Industry, TaxNo  FROM customer where CustId='$custid'";

        $result =$connect->query($sql);

        /* fetch associative array */
        if ($row = $result->fetch_assoc()) {
            $custid=$row['CustId'];
            $custname=$row['CustName'];
            $city=$row['City'];
            $address=$row['Address'];
            $zipcode=$row['ZipCode'];
            $contact=$row['Contact'];
            $jobtitle=$row['JobTitle'];
            $phone=$row['Phone'];
            $industry=$row['Industry'];
            $taxno=$row['TaxNo'];
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
      echo "<form action=cus.php method=post>";
      echo "<input type=hidden name=op value=$op>";
      echo "<div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品代號</label>
              <input type='text' class='form-control' name=custid id='custid' placeholder='請輸入代號' value=$custid>
              </div>
              <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品名稱</label>
              <input type='text' class='form-control' name=custname id='custname' placeholder='請輸入代號' value=$custname>
              </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品價格</label>
              <input type='text' class='form-control' name=city id='city' placeholder='請輸入主管姓名' value=$city>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=address id='address' placeholder='請輸入主管姓名' value=$address>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=zipcode id='zipcode' placeholder='請輸入主管姓名' value=$zipcode>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=contact id='contact' placeholder='請輸入主管姓名' value=$contact>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=jobtitle id='jobtitle' placeholder='請輸入主管姓名' value=$jobtitle>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=phone id='phone' placeholder='請輸入主管姓名' value=$phone>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=industry id='industry' placeholder='請輸入主管姓名' value=$industry>
            </div>
            <div class='mb-3'>
              <label for='exampleFormControlInput1' class='form-label'>產品成本</label>
              <input type='text' class='form-control' name=taxno id='taxno' placeholder='請輸入主管姓名' value=$taxno>
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
               $custid=$_REQUEST['custid']; 
                display_form($op,$custid);
               break;      
         case 2:  //修改資料
               $custname=$_REQUEST['custname'];
               $custid=$_REQUEST['custid'];
               $city=$_REQUEST['city'];
               $address=$_REQUEST['address'];
               $zipcode=$_REQUEST['zipcode'];
               $contact=$_REQUEST['contact'];
               $jobtitle=$_REQUEST['jobtitle'];
               $phone=$_REQUEST['phone'];
               $industry=$_REQUEST['industry'];
               $taxno=$_REQUEST['taxno'];
 
                   $sql="update customer 
                           set CustName='$custname',
                               CustId='$custid',
                               City='$city',
                               Address='$address',
                               ZipCode='$zipcode',
                               Contact='$contact',
                               JobTitle='$jobtitle',
                               Phone='$phone',
                               Industry='$industry',
                               TaxNo='$taxno'
                         where CustId='$custid'";
                   include("connectdb.php");
                   include('dbutil.php');
                   execute_sql($sql);
               break;
         case 3: //新增
                $custid="";
                 display_form($op,$custid);
               break;
         case 4: //新增資料
               $custid=$_REQUEST['custid'];
               $custname=$_REQUEST['custname'];
               $city=$_REQUEST['city'];
               $address=$_REQUEST['address'];
               $zipcode=$_REQUEST['zipcode'];
               $contact=$_REQUEST['contact'];
               $jobtitle=$_REQUEST['jobtitle'];
               $phone=$_REQUEST['phone'];
               $industry=$_REQUEST['industry'];
               $taxno=$_REQUEST['taxno'];
               $sql="insert into customer (CustId,CustName,City,Address,ZipCode,Contact,JobTitle,Phone,Industry,TaxNo) values ('$custid','$custname','$city','$address','$zipcode','$contact','$jobtitle','$phone','$industry','$taxno')";
               include("connectdb.php");
               include('dbutil.php');
               execute_sql($sql);
               break;      
         case 5: //刪除資料              
               $custid=$_REQUEST['custid'];              
             
               $sql="delete from customer where CustId='$custid'";
               include("connectdb.php");
               include('dbutil.php');
               execute_sql($sql);
               break;
 
       }      
  
    }
horizontal_bar($username);
echo "
    <!-- Page Heading -->
    <h1 class='h3 mb-2 text-gray-800'>客戶基本資料</h1>
    <!-- DataTales Example -->
    <div class='card shadow mb-4'>
        <div class='card-header py-1'>
            <h6 class='m-0 font-weight-bold text-primary'>以下修改行為，皆會影響本公司，請謹慎修改</h6>
            <p align=right>
            <a href=cus.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>客戶寶號</th>
                            <th>客戶代號</th>
                            <th>縣市</th>
                            <th>地址</th>
                            <th>郵遞區號</th>
                            <th>聯絡人</th>
                            <th>職稱</th>  
                            <th>電話</th>
                            <th>產業別</th> 
                            <th>統一編號</th>  
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>客戶寶號</th>
                          <th>客戶代號</th>
                          <th>縣市</th>
                          <th>地址</th>
                          <th>郵遞區號</th>
                          <th>聯絡人</th>
                          <th>職稱</th>  
                          <th>電話</th>
                          <th>產業別</th> 
                          <th>統一編號</th>  
                          <th>edit</th>
                          <th>delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
";                                      
include("connectdb.php");
$sql = "SELECT CustName,CustId,City,Address,ZipCode, Contact, JobTitle, Phone, Industry, TaxNo  FROM customer";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {   
  //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
  $custid=$row['CustId'];
  $custname=$row['CustName'];
  $city=$row['City'];
  $address=$row['Address'];
  $zipcode=$row['ZipCode'];
  $contact=$row['Contact'];
  $jobtitle=$row['JobTitle'];
  $phone=$row['Phone'];
  $industry=$row['Industry'];
  $taxno=$row['TaxNo'];
  echo "<tr><TD>$custid<td>$custname<TD>$city<TD>$address<TD>$zipcode<TD>$contact<TD>$jobtitle<TD>$phone<TD>$industry<TD>$taxno";    
  echo "<TD><a href=cus.php?op=1&custid=$custid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
  echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$custname]嗎?'))location='cus.php?custid=$custid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
}
echo"
</tbody>
</div>
</div>";


footer();


    
?>