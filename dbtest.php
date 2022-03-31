<?php

include("connectdb.php");

// $sql="insert into dept (deptid,deptname,managername)
//         values ('Z02','Playing','Mary')" ;

// $sql="update Dept
//         set deptname='Hello'
//         where deptid='Z01'";

// $sql="DELETE from dept
//         where deptid='Z02'";
// execute_sql($sql);

$sql = "SELECT deptid,deptname,managername FROM dept";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $deptid=$row['deptid'];
    $deptname=$row['deptname'];
    $managername=$row['managername'];

    echo "$deptid  $deptname  $managername";
    echo "<BR>";
}




?>
        <tbody>
                                    <?php
                                    

    
                                    include("connectdb.php");
                                    $sql = "SELECT deptid,deptname,managername FROM dept";

                                    $result =$connect->query($sql);

                                    /* fetch associative array */
                                    while ($row = $result->fetch_assoc()) {
                                        //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
                                        $deptid=$row['deptid'];
                                        $deptname=$row['deptname'];
                                        $managername=$row['managername'];

                                        echo "<tr><TD>$deptid<td> $deptname<TD>$managername";    
                                        echo "<TD><a href=dept.php?op=1&deptid=$deptid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
                                        echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$deptname]嗎?'))location='dept.php?deptid=$deptid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
                                    }    

                                
                                    ?>
                                    </tbody>