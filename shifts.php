<html>

<head>
    <title> Assign cashier to shift </title> 
    <link rel="stylesheet" href="styles.css">
</head>

<body class=shifts>
    <center>
    <h1>
        Assign cashier to shift
    </h1>
    <center>
    <hr>
    <form action="assign_to_shift.php" method="post">
        Cashier number:
        <select name="CashierNum">
        <option disabled selected value> -- select an option -- </option>
        <?php   
        $conn=mysqli_connect('localhost', 'root', '','chefexpress');
        $sql="SELECT EmployeeNum FROM cashier"; 
        $eNum=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($eNum))
        {
            echo "<option value='". $row['EmployeeNum'] ."'>" .$row['EmployeeNum'] ."</option>";
        }
        ?>
        </select>
        <br>
        <br>
        Shift number + Shift date:
        <select name="ShiftNumDate">
        <option disabled selected value> -- select an option -- </option>
        <?php
        $sql="SELECT DISTINCT ShiftNum, ShiftDate FROM shiftindate ORDER BY ShiftDate DESC, ShiftNum DESC";
        $sNum=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($sNum))
        {
            echo "<option value='". $row['ShiftNum'] .' '. $row['ShiftDate'] ."'>" .$row['ShiftNum'] .' '.$row['ShiftDate']."</option>";
        }
        ?>
        </select>
        <br>
        <br>
        <button type="assign">Assign</button>
    </form>
</body>

</html>

