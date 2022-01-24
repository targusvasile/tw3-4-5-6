<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin</title>
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <nav>
        <div class="scrollmenu">
            <a href="../index.html">Home</a>
            <a href="contact.html">Contact</a>
          </div>
    </nav>
      <div class="table-container">
          <?php 
                $mysqli = @mysqli_connect('localhost', 'root', '', 'tw_lab');
                
                if(!$mysqli){
                    echo "Database error!";
                    return;
                }
                echo '<table><tr>
                <th>Id</th>
                <th>Name</th>
                <th>Mobile number</th>
                <th>Text problem</th>
                <th>Delete</th>
                </tr>';

                $result = $mysqli->query("SELECT * FROM contacts");

                while($row = mysqli_fetch_assoc($result)){ 
                    echo '<tr>';
                    foreach($row as $el => $value){
                        echo '<td>'.$value.'</td>';
                    }
                    echo '<td><button type="button" onclick="deleteContact('.$row["id_contact"].');" id="delete-contact">Delete</button></td>';
                    echo '</tr>';
                }
                $mysqli->close();
                echo '</table>'
            ?>
      </div>
      <div class="modal__window">
        <div class="modal__content">
          <p id="mod_msg"></p>
          <button type="button" onclick="ok_auth();">Ok</button>
        </div>
      </div>

  <script>
    function deleteContact(id){
      if(window.confirm("Do you really want to delete contact with id "+id+"?")){
        data = "id=" + id;
        $.ajax({
          data: data,
          type: "POST",
          url: "../php/deleteContact.php",
          success: function(){
            location.reload();
          }
        });
      }
    }
  </script>
  <script src="../js/app.js"></script>
</body>
</html>