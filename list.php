<?php require_once "database.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #333;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-input {
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <div class="search-form">
        <form method="GET">
            <input type="text" name="search" class="search-input" placeholder="Search by Name, Email, or Phone">
            <button type="submit">Search</button>
        </form>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        <?php
            // Retrieve data from the "register" table
            $sql = "SELECT firstName, birthdate, email, phone FROM register";
            
            // Check if a search term is provided in the URL
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $searchTerm = $_GET['search'];
                $sql .= " WHERE CONCAT(firstName, email, phone) LIKE '%$searchTerm%'";
            }
            
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                // Handle the query error
                die("Query error: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Calculate age in years from birthdate
                    $birthdate = new DateTime($row["birthdate"]);
                    $currentDate = new DateTime();
                    $ageInterval = $birthdate->diff($currentDate);

                    // Display age in years
                    $ageInYears = $ageInterval->y;

                    // Display data in the table
                    echo "<tr>";
                    echo "<td>" . $row["firstName"] . "</td>";
                    echo "<td>" . $ageInYears . " years </td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }

            mysqli_close($conn);
        ?>
    </table>
</body>
</html>
