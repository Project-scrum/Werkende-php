<?php
$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "SELECT image_id, location, title, description, tags FROM images ORDER BY image_id DESC";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_result($image_id, $location, $title, $description, $tags) or die ('binding result');
$stmt->execute() or die ('Error excecuting');


?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="top_bar">
            <div id="left">The Wall</div>

            </div>
        <div id="content_bar">
            <div id="function_bar">
                <select id="select_sorting" name="list_order">
                        <option value="new">New</option>
                        <option value="popular">Popular</option>
                </select>
                <div id="up">
     <form method="post" action="process_upload.php" enctype="multipart/form-data">
    <label><input type="file" name="uploaded_image"/></label><br><br>
    <label>Title:<br><input name="title"/></label><br>
    <label>Description:<br><input name="description"/></label><br>
    <label>Tags:<br><input name="tags"/></label><br>
   <!-- <label>Comment:<br><textarea name="comment" rows="4" cols="50"></textarea></label><br><br> -->
    <input type="submit" name="submit_image" value="Send"/>

    </form>
            </div>
        <button id="upload_button" value="upload">upload</button>
               </div>
    <?php  
        // for($i = 0; $i < $count; $i++){  
            while ($succes = $stmt->fetch()) {                  
    ?>
            <div class='post_frame'>
                <div><img onclick="location.href='post.php?img=<?php echo $location; ?>'" class='pic_frame' src="<?php echo $location ?>" . '<br><br>'>
                
                </div>              
           

    <?php   
        }
    ?>
        </div>
        <script>
             function $(id) {
            return document.getElementById(id)
        }
        var upload_button = $("upload_button"),
            up = $("up");
        document.onclick = function () {
            up.style.display = "none";
        }

        upload_button.addEventListener('click', function (e) {
            stopFunc(e);
            up.style.display = "block";
        }, false)
        up .addEventListener('click', function (e) {
            stopFunc(e);
        }, false)
        
        
        function stopFunc(e) { 
            e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;
        }
   </script>

    </body>
</html>