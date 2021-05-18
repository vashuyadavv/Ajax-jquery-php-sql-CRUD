<?php
    include"config.php";

    if(isset($_POST['id'])){
        //echo"hey, it works";
        $id=$con->real_escape_string($_POST['id']);
        $sql="SELECT * FROM hobbies WHERE id = $id ";
        $fetch_query=$con->query($sql);
        if (!$fetch_query) {
            die("Query FAILED " . $con->error);
        }
        while($row=$fetch_query->fetch_array()){
            echo "<p id='feedback' class='bg-success'></p>";
            echo"<input rel='".$row['id'] ."' type='text' class='form-control title-input' value='{$row['title']}'>";
            echo"<br>";
            echo "<input type='button' class='btn btn-success update' value='Update'>";
            echo "<input type='button' class='btn btn-danger delete' value='Delete'>";
            echo "<input type='button' class='btn btn-close close' value=''>";
            
            //echo "<td>{$row['id']}</td>";
            //echo "<td><a class='title-link' href='#'>{$row['title']}</a></td>"; //use class instead of id
            
        }
    }

    // Updating displaying action box data
    if (isset($_POST['updatethis'])) {
        //echo"it works";
        $id = $con->real_escape_string($_POST['id']);
        $title = $con->real_escape_string($_POST['title']);
        $sql="UPDATE hobbies SET title = '{$title}' WHERE id = $id; ";
        $update_query=$con->query($sql);
        if(!$update_query){
            die("Query FAILED " . $con->error);
        }
    }

    // Deleting displaying action box data
    if (isset($_POST['deletethis'])) {
        //echo"it works";
        $id = $con->real_escape_string($_POST['id']);
        $sql="DELETE FROM hobbies WHERE id = $id; ";
        $delete_query=$con->query($sql);
        if(!$delete_query){
            die("Query FAILED " . $con->error);
        }
    }
?>

<script>
    $(document).ready(function(){
        var id;
        var title;
        var updatethis="updatethis";
        var deletethis="deletethis";

        // Extract id and title
        $(".title-input").on('input', function(){
            id=$(this).attr('rel');
            title=$(this).val();
            //alert(title);
        });    
            
        // UPDATE BUTTON FUNCTION
            $(".update").on('click', function(){
                
                $.post("process.php", {id: id, title: title, updatethis: updatethis}, function(data){
                    //alert(data);
                    $("#feedback").text("Record Updated successfully");
                });
            });
        
        // DELETE BUTTON FUNCTION
        $(".delete").on('click', function(){
            if (confirm("Are you sure you want to delete this?")) {
                id=$(".title-input").attr('rel');
                $.post("process.php", {id: id, deletethis: deletethis}, function(data){
                    
                    //$("#feedback").text("Record Deleted successfully");
                    $('#action-container').hide();
                });
            }
        });

        // CLOSE BUTTON FUNCTION
        $(".close").on('click', function(){
            $('#action-container').hide();
        });
    });
</script>