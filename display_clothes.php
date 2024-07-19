<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="table_style.css">
    <style>
        .popup-form {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .popup-form input, .popup-form button {
            display: block;
            margin: 10px 0;
        }
        .popup-form .close-btn {
            float: right;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $delete_sql = "DELETE FROM pro_clothes WHERE id=$delete_id";
        $conn->query($delete_sql);
    } elseif (isset($_POST['update_id'])) {
        $update_id = $_POST['update_id'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $update_sql = "UPDATE pro_clothes SET name='$name', number='$number' WHERE id=$update_id";
        $conn->query($update_sql);
    }
}

$sql = "SELECT id, name, number, image_path FROM pro_clothes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Number</th><th>Image</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["number"] . "</td>";
        echo "<td><img src='" . $row["image_path"] . "' alt='Product Image' width='100'></td>";
        echo "<td>
                <button class='change' onclick='showForm(" . $row["id"] . ", \"" . $row["name"] . "\", \"" . $row["number"] . "\")'>Change</button>
                <form method='post' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                    <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                    <button type='submit' class='change'>Delete</button>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

<div id="popupForm" class="popup-form">
    <span class="close-btn" onclick="closeForm()">X</span>
    <form id="changeForm" method="post">
        <input type="hidden" id="update_id" name="update_id">
        <input type="text" id="newName" name="name" placeholder="New Name">
        <input type="number" id="newNumber" name="number" placeholder="New Number">
        <button type="submit">Submit</button>
    </form>
</div>

<script>
    function showForm(id, name, number) {
        document.getElementById('popupForm').style.display = 'block';
        document.getElementById('update_id').value = id;
        document.getElementById('newName').value = name;
        document.getElementById('newNumber').value = number;
    }

    function closeForm() {
        document.getElementById('popupForm').style.display = 'none';
    }
</script>

</body>
</html>
