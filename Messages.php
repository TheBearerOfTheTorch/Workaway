<?php
session_start();

function testInput($data)
{
    $datat = stripslashes($data);
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
}

if(isset($_POST['submit']))
{
    $id_to = testInput($_POST['id_to']);
    $message = testInput($_POST['message']);

    //checking if the id exist
    $servername = '127.0.0.1';
    $dbname = 'workaway';
    $username = 'root';
    $pass = "";
    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERROMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id from users  where id=?");
        $stmt->bindValue(1,$id_to);
        $stmt->execute();

        if($row = $stmt->rowCount())
        {
            $_SESSION['message_id'] = $id_to;

            //getting the id of the user who sent the messages from the session
            $id_from = $_SESSION['id'];

            $stmt = $conn->prepare("INSERT INTO messages (id_to,id_from,messages) VALUES(:id_to,:id_from,:messages)");
            $stmt->bindParam(':id_to',$id_to);
            $stmt->bindParam(':id_from',$id_from);
            $stmt->bindParam(':message',$message);

            $rt = $stmt->execute();

            if($rt>0)
            {
                header("Location: /?success");
            }
            else
            {
                echo "message failed to sent";
            }

        }
        else
        {
            header("Location: /meassage.html?error");
        }

    }
    catch(Exception $e)
    {
        echo "connection errror".$e->getMessage();
    }
}