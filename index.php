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

        $sql = "SELECT id, table_type, seats, availablility FROM available_seats";
        $result = $conn->query($sql);
    
    
        if ($result->num_rows > 0) {
            echo '<table cellpadding = "10"><tr bgcolor="#f3d268">';
            echo '<th>Table #</th><th>Type</th><th>Seats</th><tr>';
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
            
                if( $row["availablility"] == TRUE)
                {
                    echo '';
                    echo "<th> No. " . $row["id"]. " </th><th> " . $row["table_type"]. " </th><th>" . $row["seats"]. "</th><tr>";
                    echo '</tr>';
                }
            }
            
            echo '</tbody></table>';
            
        } else {
            echo "None Available";
        }

        $conn->close();
    ?>
    
    <br><br>
    <h4>Incoming Reservations:</h4>
    
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

        $sql = "SELECT reservation_num, time, last_name, first_name, seats FROM reservations";
        $result = $conn->query($sql);
    
        $current_time = strtotime('now');
        echo "Current Time: " . date("h:ia");
    
        if ($result->num_rows > 0) {
            echo '<table cellpadding = "10"><tr bgcolor="#f3d268">';
            echo '<th>Reservation #</th><th>Reseravtion Time</th><th>Last Name</th><th>First Name</th><th> Head Count</th><tr>';
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
            
                if ($row["time"] > date("h:i:s") )
                {
                    echo '';
                    echo "<th> " . $row["reservation_num"]. " </th><th>"  . $row["time"]. " </th><th>" . $row["last_name"]. " </th><th>" . $row["first_name"]. " </th><th>" . $row["seats"]. "</th><tr>" ;
                    echo '</tr>';
                }
            }
            
            echo '</tbody></table>';
            
        } else {
            echo "None Available";
        }

        $conn->close();
    ?>
    

</body>
</html>

