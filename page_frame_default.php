<html>

<head>
<title>Chef Express</title>
<link rel="stylesheet" href="styles.css">
</head>

<body class="center">
    <center> 
        <h1>
            Chef Express 
        </h1>
        <img src="Capture.PNG" height="50%">
        <p>
            Chef Express offers two different entertainment experiences; <br>
            The ground floor is a bistro with a local bistro menu.
            The underground floor is a bar with a unique alcohol menu.            
        </p>
        <br>
        <hr>
            <table class="ui basic table">
                <tr>
                    <th>Shift Number</th>
                    <th>Shift Date</th>
                    <th>Cashier in Practice </th>
                    <th>Planned</th>
                    <th>Difference</th>
                </tr>
            <?php     
            $conn=mysqli_connect('localhost', 'root', '','chefexpress');
            $sql="SELECT sd.ShiftNum, sd.ShiftDate, COUNT(cs.ShiftNum) as CashiersInShifts, s.NumOfCashiers, (COUNT(cs.ShiftNum) -  s.NumOfCashiers) AS The_Difference 
                    FROM ShiftInDate sd LEFT OUTER JOIN CashiersInShifts cs  ON sd.ShiftNum = cs.ShiftNum and
                     sd.ShiftDate = cs.ShiftDate INNER JOIN Shift s ON sd.ShiftNum = s.ShiftNum
                    WHERE (sd.ShiftDate BETWEEN '2015-01-01' AND '2015-01-05')   
                    GROUP BY sd.ShiftNum, sd.ShiftDate, s.NumOfCashiers "; 
            $rs=mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($rs))
            {
                echo "<tr><td>";
                echo $row['ShiftNum'] . "</td> <td>" . $row['ShiftDate'] . "</td> <td>". $row['CashiersInShifts']. "</td> <td>". $row['NumOfCashiers']. "</td> <td>". $row['The_Difference'];
                echo "</td></tr>";
            }
            ?>
        </table>
    </center>

</body>
</html>