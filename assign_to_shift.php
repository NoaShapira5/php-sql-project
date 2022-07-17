<html>

<head>
<link rel="stylesheet" href="styles.css">
</head>

<body class="assignShift">
    <?php
    $cNum=$_POST['CashierNum'];
    $sNumDate=$_POST['ShiftNumDate'];
    $sNum=explode(" ",$sNumDate)[0];
    $sDate=explode(" ",$sNumDate)[1];
    $sql1= "SELECT * 
            FROM `cashiersinshifts` 
            WHERE ShiftNum = $sNum and ShiftDate = '$sDate' and CashierNum = $cNum";
    $conn=mysqli_connect('localhost','root','','chefexpress');
    if(!$conn) {
        echo "Unable to connect to the database server at this time";
        exit(0);
    }
    $rs1=mysqli_query($conn,$sql1);
    if (mysqli_num_rows($rs1) !== 0) { 
        echo "This entry already exists";
        exit(0);
     } 
    $sql2="INSERT INTO `cashiersinshifts`(`CashierNum`, `ShiftNum`, `ShiftDate`) VALUES (" .$cNum ." , '" .$sNum ."' , '". $sDate ."')"; 
    $rs2=mysqli_query($conn,$sql2);
    if(!$rs2) {
        echo "The input was incorrect or caused an error for another reason, please try again";
        exit(0);
    }
    $sql3="SELECT DISTINCT Name
            FROM `employee` AS E JOIN `cashiersinshifts` AS C ON E.EmployeeNum=C.CashierNum 
            WHERE C.CashierNum = $cNum";
    $cName=mysqli_query($conn,$sql3);
    while($row = mysqli_fetch_array($cName))
    {
        echo 'Cashier ' .$cNum.' ' .$row['Name'].' assigned successfully';
    }
    
    ?>

</body>
</html>