<html>
    <head>
        <title>Project 1-Admin Manage Users</title>
        <style>
         .error{color: #FF0000;}
         </style>
    </head>
    
    <body>
        <h2>Welcome to the Admin Manage Page</h2>
        <?php
            include "admin_nav.php";
            include "connection.php";

            $sqs="SELECT * FROM users ORDER BY firstname ASC";
            $result= mysqli_query($dbc, $sqs);

            echo "<table border='1' width='50%'>";
            echo "<tr>
                    <td>edit</td>
                    <td>delete</td>
                    <td>First Name: </td>
                    <td>Last Name: </td>
                    <td>Phone: </td>
                    <td>Email: </td>
                    <td>Gender: </td>
                    <td>Level: </td>
                    <td>Password: </td>
                </tr>";
                while($row=mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td><a href='admin_edit.php?id=".$row['id']."'>edit</a></td>";
                    echo "<td><a href ='admin_delete.php?id=".$row['id']."'>delete</a></td>";
                    echo "<td>".$row['firstname']." </td>";
                    echo "<td>".$row['lastname']." </td>";
                    echo "<td>".$row['phone']." </td>";
                    echo "<td>".$row['email']." </td>";
                    echo "<td>".$row['gender']." </td>";
                    echo "<td>".$row['level']." </td>";
                    echo "<td>".$row['pw']." </td>";

                    echo "</tr>";
                }


            echo "</table>";



        ?>
</body>
</html>