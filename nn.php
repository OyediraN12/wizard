<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.expertphp.in/js/jquery.form.js"></script>
<script>
function preview_images() 
{
 var total_file=document.getElementById("images").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}
</script>
<style>

</style>
</head>
<body>
   
<div class="row">
 <form action="multiupload.php" method="post" enctype="multipart/form-data">
  <div class="col-md-6">
      <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
  </div>
  <div class="col-md-6">
      <input type="submit" class="btn btn-primary" name='submit_image' value="Upload Multiple Image"/>
  </div>
 </form>
 </div>
 <div class="row" id="image_preview"></div>
</body>


<?php
if(isset($_POST['submit_image']))
{
    $images_array=array();
     foreach($_FILES['images']['name'] as $key=>$val){
    
     $uploadfile=$_FILES["images"]["tmp_name"][$key];
     $folder="images/";
     $target_file = $folder.$_FILES['images']['name'][$key];
     if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], "$folder".$_FILES["images"][""][$key])){
         $images_array[] = $target_file;
     }
    }
}
if(!empty($images_array)){ 
    foreach($images_array as $src){ ?>
        <ul>
            <li >
                <img src="<?php echo $src; ?>">
            </li>
        </ul>
<?php }
}
?>
</html>