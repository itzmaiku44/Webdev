<?php
$host= "localhost";
$user= "root";
$password= "";
$db = "clientdb";

$connect = new mysqli($host, $user, $password, $db);
$id = "";
$name = "";
$email = "";
$message = "";
$errorMessage = "";
$successMessage = "";
mysqli_report(MYSQLI_REPORT_STRICT);

if($_SERVER['REQUEST_METHOD'] == 'GET')
{      //Display the data
    if(!isset($_GET["id"])) // exit if ID doesn't exist
    {
        header("location:../index.php");
        exit;
    }
    $id = $_GET["id"];
    // from the selected ID, it read the row of database
    $sql = "SELECT * FROM client WHERE id=$id";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) 
    {
        header("location:../index.php");
        exit;
    }//if cannot read the data from database, return to index.php
    //otherwise
    $name = $row["name"];
    $email = $row["email"];
    $message = $row["message"];
}
else{ // Update the data

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    do{ // check if all fields are filled
        if(empty($id) || empty($name) || empty($email) || empty($message))
        {
            $errorMessage = "All fields are required";
            break;
        }
        $sql = "UPDATE client " . 
                "SET name = '$name', email = '$email', message = '$message'" . 
                "WHERE id = $id"; // Update all the data
        $result = $connect->query($sql);
        if(!$result)        // Error handler
        {
            $errorMessage = "Invalid Query. " . $connect-error;
            break;
        }

        $successMessage = "Client updated successfully.";
        header("location:../index.php");
        exit;

    } while(false);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="src/style.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h2 class="txt mb-5 text-center">Edit Client</h2>

        <?php
            if(!empty($errorMessage))
            {
                echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type'button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }

        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-end"><b>Name: </b></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-end"><b>Email: </b></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-end"><b>Message: </b></label>
                <div class="col-sm-6">
                    <textarea name="message" class="form-control" name="message" value="<?php echo $message; ?>"></textarea>
                </div>
            </div>
            <?php
                if(!empty($successMessage))
                {
                    echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type'button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
                }


            ?>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-danger" href="../index.php" role="button">Cancel</a>
                </div>

            </div>
        </form>
    </div>

</body>
</html>