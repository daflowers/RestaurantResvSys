<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<h2>Digital Factory - Restaurant Reservations System</h2>
  

    <a href="index.php" class="button">Main Menu</a>
    <a href="make-reservations.php" class="button">Make Reservations</a>
    <a href="view-reservations.php" class="button">View Current Reservations</a>
    <a href="manage-reservations.php" class="button">Manage Reservations</a>

  <h4>View Reservations</h4>
    <?php 
        echo "Current Time: " . date("h:ia"); 
        echo "<br><br>";
        echo "Select & View Reservations:";
    
        
    ?>
    
        
    <form action="#" method="post">
    <select name="Times">
    <option value="all">All</option>
    <option value="morning">Morning</option>
    <option value="afternoon">Afternoon</option>
    <option value="evening">Evening</option>
    <option value="midnight">After Midnight</option>
    </select>
    <input type="submit" name="submit" value="Submit" />
    </form>
    
    <?php
       
    
    ?>

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

       
    
        if(isset($_POST['submit'])){
            $selected_val = $_POST['Times'];  // Storing Selected Value In Variable
           // echo "You have selected :" .$selected_val;  // Displaying Selected Value
        }
    
        $sql = "SELECT reservation_num, time, last_name, first_name, seats FROM reservations";
        $result = $conn->query($sql);
    
        $current_time = strtotime('now');
       
        echo "<br>";
    
        if ($result->num_rows > 0) {
            echo '<table cellpadding = "10"><tr bgcolor="#f3d268">';
            echo '<th>Reservation #</th><th>Reseravtion Time</th><th>Last Name</th><th>First Name</th><th> Head Count</th><tr>';
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
            
                if( $selected_val == "all" )
                {  
                    echo '';
                    echo "<th> " . $row["reservation_num"]. " </th><th>"  . date('h:i:sa', strtotime($row["time"])). " </th><th>" . $row["last_name"]. " </th><th>" . $row["first_name"]. " </th><th>" . $row["seats"]. "</th><tr>" ;
                    echo '</tr>';
             
                }
                else if( $selected_val == "morning" )
                {
                    $reserv_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime($row["time"])));
                    $start_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("06:00:00")));
                    $end_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("12:00:00")));
                    
                    if ($reserv_time > $start_time && $reserv_time < $end_time)
                    {
                        echo '';
                        echo "<th> " . $row["reservation_num"]. " </th><th>"  . date('h:i:sa', strtotime($row["time"])) . " </th><th>" . $row["last_name"]. " </th><th>" . $row["first_name"]. " </th><th>" . $row["seats"]. "</th><tr>" ;
                        echo '</tr>';
                    }
                }
                else if( $selected_val == "afternoon" )
                {  
                    $reserv_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime($row["time"])));
                    $start_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("12:00:00")));
                    $end_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("16:00:00")));
                    
                    if ($reserv_time > $start_time && $reserv_time < $end_time)
                    {
                        echo '';
                        echo "<th> " . $row["reservation_num"]. " </th><th>"  . date('h:i:sa', strtotime($row["time"])). " </th><th>" . $row["last_name"]. " </th><th>" . $row["first_name"]. " </th><th>" . $row["seats"]. "</th><tr>" ;
                        echo '</tr>';
                    }
                }
                else if( $selected_val == "evening" )
                {
                    $reserv_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime($row["time"])));
                    $start_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("17:00:00")));
                    $end_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("23:00:00")));
                    
                
                    if ($reserv_time > $start_time && $reserv_time < $end_time)
                    {
                        echo '';
                        echo "<th> " . $row["reservation_num"]. " </th><th>"  . date('h:i:sa', strtotime($row["time"])). " </th><th>" . $row["last_name"]. " </th><th>" . $row["first_name"]. " </th><th>" . $row["seats"]. "</th><tr>" ;
                        echo '</tr>';
                    }
                }
                else if( $selected_val == "midnight" )
                {
                    $reserv_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime($row["time"])));
                    $start_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("24:00:00")));
                    $end_time = DateTime::createFromFormat('H:i a', date('h:i:sa', strtotime("06:00:00")));
                    
                    if ($reserv_time > $start_time && $reserv_time < $end_time)
                    {
                        echo '';
                        echo "<th> " . $row["reservation_num"]. " </th><th>"  . date('h:i:sa', strtotime($row["time"])). " </th><th>" . $row["last_name"]. " </th><th>" . $row["first_name"]. " </th><th>" . $row["seats"]. "</th><tr>" ;
                        echo '</tr>';
                    }
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
