<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<h2>Digital Factory - Restaurant Reservations System</h2>



    <a href="make-reservations.php" class="button">Make Reservations</a>
    <a href="view-reservations.php" class="button">View Current Reservations</a>
    <a href="manage-reservations.php" class="button">Manage Reservations</a>
    <br><br>


    
<h4>Current Available Seating</h4>
<?php
        $servername = "localhost:8889";
        $username = "root";
        $password = "root";
        $dbname = "db_restaurant_reservations";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT id, table_type, seats FROM available_seats";
        $result = $conn->query($sql);
    
    
        if ($result->num_rows > 0) {
            echo '<table cellpadding = "10"><tr bgcolor="#f3d268">';
            echo '<th>Table #</th><th>Type</th><th>Seats</th><tr>';
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '';
               // echo "<th>" . $row["id"]. " - " . $row["table_type"]. " - Seats: " . $row["seats"]. "<br>";
                echo "<th> No. " . $row["id"]. " </th><th> " . $row["table_type"]. " </th><th>" . $row["seats"]. "</th><tr>";
                echo '</tr>';
            }
            
            echo '</tbody></table>';
            
        } else {
            echo "None Available";
        }

        $conn->close();
    ?>
    
    

</body>
</html>

