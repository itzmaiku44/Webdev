<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header("location:admin.php");
    }
?>


<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link href="src/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h2 class="headTitle "></h2>
        <nav>
            <a href="action/logout.php" class="active">Logout</a>
        </nav>
    </header>
    <div class="container mb-14"></div>
    <div class="container pt-5">
        <h2 class="titlewrap mb-5">Dashboard</h2>
        <a class="btn btn-success" href="action/create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $host= "localhost";
                    $user= "root";
                    $password= "";
                    $db = "clientdb";

                    $data = mysqli_connect($host, $user, $password, $db);
                    if($data===false)
                    {
                        die("Connection cannot establish.");
                    }
            
                    $sql = "select * from client";
                    $result = $data->query($sql);
                    if(!$result)
                    {
                        die("Invalid Query: " . $data->error);
                    }
                    while($row = $result->fetch_assoc())
                    {
                        echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[message]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='action/edit.php?id=$row[id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='action/delete.php?id=$row[id]'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                    

                ?>
                
            </tbody>

        </table>
    </div>



</body>

</html>