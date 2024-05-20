<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        nav {
            background-color: #3498db;
            padding: 20px;
            width: 200px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
        }

        nav ul {
            list-style-type: none;
            margin: 10px;
            padding: 0;
        }

        nav ul li {
            margin-bottom: 20px;
        }

        nav ul li a {
            color: #000;
            text-decoration: none;
        }

        nav ul li:hover {
            background-color: #fff; /* Highlight the item */
        }

        section {
            margin-bottom: 40px;
            display: none; /* Initially hide all sections */
        }

       h1{
        text-align:center;
        font-size:50px;
       }

        .all {
            margin-left: 220px; /* Adjust to match nav width + some padding */
            padding: 40px;
            display:block; /* Use flexbox */
        }
       

        table {
            border-collapse: collapse;
            width: 100%;
            margin-right:0;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px; 
            text-align: left;
            font-size: 15px; 
            margin-left:0;
        }

        th {
            background-color: #f2f2f2;
        }

        .menu, .content {
            flex: 1; /* Take up equal space */
            margin: 0 0; /* Add some spacing between them */
        }

        /* Define CSS classes for different status */
        .status-delete {
            background-color: #FFCCCC !important; /* Light red for delete */
        }

        .status-cancel {
            background-color: #FFD700 !important; /* Gold for cancel */
        }

        .status-confirm {
            background-color: #90EE90 !important; /* Light green for confirm */
        }

        .status-pending {
            background-color: #ADD8E6 !important; /* Light blue for pending */
        }
       form{
        text-align: right;
            margin-bottom: 10px; /* Add some space below the form */
       }
       /* css payment */

       .container {
           
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Two columns with equal width */
            grid-gap: 40px; /* Gap between the cards */
        }

        .card {
            border: 2px solid #ccc;
            padding: 10px;
            height: 400px; /* Set a specific height for the card */
            overflow: auto; /* Hide any content that exceeds the specified height */
            border-radius:15px;
        }

        .card img {
            width:95%;
            height: auto;
            border: 2px solid #ccc;
            padding: 10px;
        }
        button{
            padding:50px;
            font-size:30px;
            margin:30px;
            width:350px;
            height:200px;
            border-radius:20px;
            cursor: pointer;
            background: linear-gradient(to right, #4CAF50, #2E8B57);
            
        }
        button:hover {
           transform: translateY(-1.7px);
        }
        .search  {
           padding: 10px 20px; 
           font-size: 16px;
           width:150px;
           height:30px; 
           border-radius:10px;
           background: linear-gradient(to right, #4CAF50, #2E8B57);
        }
        #searchInput{
         width:250px;
         height:auto;
         padding: 5px 20px;
         border-radius:10px;
         
        }
    </style>
</head>
<body>
    <div class="all">
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="#page1">Admin</a></li>
                    <li><a href="#page2">Manage Bookings</a></li>
                    <li><a href="#page3">Check Payments</a></li>
                    <li><a href="#page4">Manage users</a></li>
                  
                    
                </ul>
            </nav>
        </div>
        <div class="content" >

            <section id="page1" class="page active" style="display:block">
            <button onclick="showPage('page1')">Admin</button>
            <button onclick="showPage('page2')">Manage Bookings</button>
            <button onclick="showPage('page3')">Check Payments</button>
            <button onclick="showPage('page4')">Manage users</button>
              
            </section>

            <section id="page2" class="page">
                <h1>Manage Bookings</h1>
                <!-- Search bar -->
                <form method="GET">
                    <input type="text" name="search" placeholder="Search..." id="searchInput">
                    <button type="submit" class="search">Search</button>
                </form>

                <?php
                // Database credentials
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "some";

                // Create a connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve bookings data from the database
                $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM bookings WHERE 
                        name LIKE '%$searchTerm%' OR 
                        email LIKE '%$searchTerm%' OR 
                        id LIKE '%$searchTerm%' OR 
                        attraction LIKE '%$searchTerm%' OR 
                        start_date LIKE '%$searchTerm%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Name</th><th>Email</th><th>Attraction</th><th>Hotel</th><th>Visitors</th><th>Couple Type</th><th>Group Size</th><th>Visitation</th><th>Duration</th><th>Start Date</th><th>Status</th><th>Action</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        // Determine the CSS class based on the status
                        $statusClass = '';
                        switch ($row['status']) {
                            case 'deleted':
                                $statusClass = 'status-delete';
                                break;
                            case 'canceled':
                                $statusClass = 'status-cancel';
                                break;
                            case 'confirmed':
                                $statusClass = 'status-confirm';
                                break;
                            case 'pending...':
                                $statusClass = 'status-pending';
                                break;
                            default:
                                $statusClass = ''; // No specific class for other statuses
                        }
                    
                        // Output table row with appropriate CSS class
                        echo "<tr class='$statusClass'>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['attraction']."</td>";
                        echo "<td>".$row['hotel']."</td>";
                        echo "<td>".$row['visitors']."</td>";
                        echo "<td>".$row['couple_type']."</td>";
                        echo "<td>".$row['group_size']."</td>";
                        echo "<td>".$row['visitation']."</td>";
                        echo "<td>".$row['duration']."</td>";
                        echo "<td>".$row['start_date']."</td>";
                        echo "<td>".$row['status']."</td>";
                        if (isset($row['id'])) {
                            echo "<td>";
                            echo "<select onchange='handleAction(this.value, ".$row['id'].")'>";
                            echo "<option value='' selected>Select Action</option>";
                            echo "<option value='cancel'>Cancel</option>";
                            echo "<option value='delete'>Delete</option>";
                            echo "<option value='confirm'>Confirm</option>";
                            echo "</select>";
                            echo "</td>";
                        } else {
                            echo "<td>Error: ID not found</td>";
                        }                        
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "No bookings found";
                }

                // Close the connection
                $conn->close();
                ?>
                 </section>


               <section id="page3" class="page">
              <h1>Check Payments</h1>

              <form method="GET">
                    <input type="text" name="search" placeholder="Search..." id="searchInput">
                    <button type="submit"  class="search">Search</button>
                </form>

               <div class="container">
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "some";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

 // SQL query to retrieve users data from the database
               $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
               $sql = "SELECT * FROM payments WHERE 
               name LIKE '%$searchTerm%' OR 
               email LIKE '%$searchTerm%' OR 
               created_at LIKE '%$searchTerm%' OR  
               file_name LIKE '%$searchTerm%'";
               $result = $conn->query($sql);


        // Fetch data from the database
        $sql = "SELECT name, email, file_name, created_at FROM payments";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p>Email: " . $row["email"] . "</p>";
                echo "<img src='uploads/" . $row["file_name"] . "' alt='Image'>";
                echo "<p>Created At: " . $row["created_at"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

               </section>








                <section id="page4" class="page">
                    <h1>Registered user</h1>

                    <form method="GET">
                    <input type="text" name="search" placeholder="Search..." id="searchInput">
                    <button type="submit"  class="search">Search</button>
                </form>

                    <?php
                // Database credentials
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "some";

                // Create a connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to retrieve users data from the database
                $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM users WHERE 
                        first_name LIKE '%$searchTerm%' OR 
                        email LIKE '%$searchTerm%' OR 
                        id LIKE '%$searchTerm%' OR  
                        last_name LIKE '%$searchTerm%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>id</th> <th>first_name</th><th>last_name</th><th>email</th><th>Action</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        // Determine the CSS class based on the status
                    
                        // Output table row with appropriate CSS class
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['first_name']."</td>";
                        echo "<td>".$row['last_name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        if (isset($row['id'])) {
                            echo "<td>";
                            echo "<select onchange='handleAction(this.value, ".$row['id'].")'>";
                            echo "<option value='' selected>Select Action</option>";
                            echo "<option value='remove'>Delete</option>";
                            echo "<option value='view'>View</option>";
                            echo "</select>";
                            echo "</td>";
                        } else {
                            echo "<td>Error: ID not found</td>";
                        }                        
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "No bookings found";
                }

                // Close the connection
                $conn->close();
                ?>




                </section>
           



        </div>
    </div>

    <script>
        function handleAction(action, id) {
            if (action === "cancel") {
                if (confirm("Are you sure you want to cancel this booking?")) {
                    sendRequest(id, "cancel.php");
                }
            } else if (action === "delete") {
                if (confirm("Are you sure you want to delete this booking?")) {
                    sendRequest(id, "delete.php");
                }
            } else if (action === "confirm") {
                if (confirm("Are you sure you want to confirm this booking?")) {
                    sendRequest(id, "confirm.php");
                }
            }
            else if (action === "remove") {
                if (confirm("Are you sure you want to remove this user?")) {
                    sendRequest(id, "remove.php");
                }
            }
            else if (action === "view") {
                if (confirm("Are you sure you want to view this user?")) {
                    sendRequest(id, "#confirm.php");
                }
            }
        }

        function sendCancelRequest(id) {
            sendRequest(id, "cancel.php");
        }

        function sendDeleteRequest(id) {
            sendRequest(id, "delete.php");
        }

        function sendConfirmRequest(id) {
            sendRequest(id, "confirm.php");
        }

        function sendRequest(id, url) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload(); // Reload the page
                }
            };
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("id=" + id);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('nav ul li a');
            const sections = document.querySelectorAll('section');

            navLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    showSection(targetId);
                });
            });

            function showSection(targetId) {
                sections.forEach(section => {
                    if (section.id === targetId) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            }
        });
    
    </script>
    <script>
      function showPage(pageId) {
    // Hide all pages
    var pages = document.querySelectorAll('.page');
    pages.forEach(page => {
        page.style.display = 'none';
    });

    // Show the selected page
    var selectedPage = document.getElementById(pageId);
    if (selectedPage) {
        selectedPage.style.display = 'block';
    }
}

    </script>
</body>
</html>
