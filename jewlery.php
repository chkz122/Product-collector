<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="table_style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form  method="post" action="Jewlery_data.php" enctype="multipart/form-data">
        <h1> Enter new Jewelry</h1>
        <div class="first_cont">
        <input name="Pr" placeholder="Jewelry name" required><br>
        <input name="nbr_Pr" placeholder="Number of the product" required><br>
        <button type="button" onclick="document.getElementById('fileInput').click()">Choose Image</button><br>
        <input name="image_Pr" type="file" id="fileInput" style="display: none;" accept="image/*" required><br>
        <button class="form" type="submit">Submit</button><br>
</div>
    </form> 
    <script src="script.js"></script> 
    <?php include 'display.php'?><br>
    <button class="button"  style="vertical-align:middle"><a type="link" href="index.html">Back</a></button>
</body>
</html>
