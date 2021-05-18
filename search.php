<?php
include"config.php";
$search=$_POST['search'];
//echo $search;
    if (!empty($search)) {
        $sql="SELECT * FROM hobbies WHERE title LIKE '$search%' ";
        $search_query=$con->query($sql);
        $count=$search_query->num_rows;

        if ($count <= 0) {
            echo "Sorry, you didn't put that hobby in your list";
        }else{
            while($row=$search_query->fetch_array()){
                $hobbies=$row['title'];
                ?>
                <ul class="list-unstyled">
                    <?php
                        echo"<li>{$hobbies}</li>";
                    ?>
                </ul>
       <?php } 
    
        }

        if (!$search_query) {
            die('Query FAILED ' . $con->error);
        }

    }

?>
