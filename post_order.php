<html>
    
<head>
    <link rel="stylesheet" href="styles.css">
</head>
    
<body class="post">
    <h1>Order Details</h1>
    <hr>
    <div class="orderDetails">
    <?php
    $orderNum=$_POST['order'];
      $conn=mysqli_connect('localhost', 'root', '','chefexpress');
      $sql="SELECT DISTINCT o.ShiftNum, o.CashierNum, e.Name AS eName , o.CustomerNum,
                     c.Name AS cName, o.Payment
            FROM orders AS o JOIN customer AS c ON o.CustomerNum = c.CustomerNum
                                JOIN employee AS e ON o.CashierNum = e.employeeNum
                                JOIN coursesinorder AS cio ON cio.OrderNum = o.OrderNum
            WHERE o.OrderNum='". $orderNum."'"; 
      $rs=mysqli_query($conn,$sql);
      if (mysqli_num_rows($rs) == 0) { 
        echo "This order number doesn't exists";
        exit(0);
     } 
     echo "<p class='orderNum'> Order Number " .$orderNum. "  Details</p>";
      while($row = mysqli_fetch_array($rs))
      {
          
          echo "<p> Shift Number: " . $row['ShiftNum']. "<br> </p> <p> Cashier Number: " . $row['CashierNum'] .
           "<br> </p> <p>Cashier Name:  ". $row['eName']. "<br> </p> <p> Customer Number: ". $row['CustomerNum'].
          "<br> </p> <p> Customer Name: ". $row['cName']."<br> </p> <p>Payment Method: ". $row['Payment']."<br> </p>";
      }
      ?>
    </div>
      <table class="Courses">
                <tr>
                    <th>Course Name</th>
                    <th>Course Descriprion</th>
                </tr>
      <?php
      $sql2="SELECT cou.Name AS couName, cou.CourseDesc
            FROM orders AS o JOIN coursesinorder AS cio ON cio.OrderNum = o.OrderNum
                                JOIN course AS cou ON cou.CourseNum = cio.CourseNum
            WHERE o.OrderNum='". $orderNum."'";
      $rs2=mysqli_query($conn,$sql2);
      while($row = mysqli_fetch_array($rs2))
      {
        echo "<tr><td>";
        echo $row['couName']. "</td> <td>" . $row['CourseDesc'] . "</td></tr>";
      }
    ?>
    <p>Courses in order:<br></p>
    </table>
    <?php
    $sql3="SELECT SUM(cou.Price * cio.Quantity) AS cost
    FROM orders AS o JOIN coursesinorder AS cio ON cio.OrderNum = o.OrderNum
                        JOIN course AS cou ON cou.CourseNum = cio.CourseNum
    WHERE o.OrderNum='". $orderNum."'";
    $rs3=mysqli_query($conn,$sql3);
    while($row = mysqli_fetch_array($rs3))
      {
        echo "<p>Total Cost: ". $row['cost']. "</p>";
      }
    ?>
</body>
    
</html>