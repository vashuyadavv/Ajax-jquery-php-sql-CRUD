<?php
    include"config.php";
    
    $sql="SELECT * FROM hobbies";
    $fetch_query=$con->query($sql);
    if (!$fetch_query) {
        die("Query FAILED " . $con->error);
    }
    while($row=$fetch_query->fetch_array()){
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td><a rel='{$row["id"]}' class='title-link' href='javascript:void(0)'>{$row['title']}</a></td>"; //use class instead of id
        echo "</tr>";
    }
?>

<script>
    $(document).ready(function(){    
        //$('#action-container').hide();
        $('.title-link').on('click', function(){
            $('#action-container').show();
            var id=$(this).attr("rel");
            //alert(id);
            $.post("process.php", {id: id}, function(data){
                //alert(data);
                $("#action-container").html(data);
            });            
        });
    });
</script>