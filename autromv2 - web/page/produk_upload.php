<style type="text/css">
#title_page{
	font-size:26px;
	text-align:left;
	color:#FFF;
	padding:5px 0px 5px 85px;
	margin-bottom:10px;
	background:url(style/data.png) 0px -26px no-repeat #025b9b;
	background-size:92px;
}
#userImage{
	width:280px;
	border:1px solid #333;
	padding:5px;
	background:#FFF;
	box-shadow:none;
}
.btn-upload{
	margin-top:10px;
	padding:10px 20px;
	background:#333;
	color:#FFF;
	border:0px solid #333;
	cursor:pointer;	
}
.btn-upload:hover{
	background:#025b9b;
}
#img{
	border:5px solid #006AB9;
	width:280px;
	height:280px;
}
#p{
	margin-top:10px;
	width:290px;
	color:#FFF;
	border:0px solid red;
	background:#006AB9;
	padding:10px 0px 10px 0px;
	text-align:center;
}
</style>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#selesai").hide(0);
	$(".frmUpload").on('submit',(function(e) {
		e.preventDefault();
		$(".upload-msg").text('Loading...');	
		$.ajax({
			url: "page/produk_upload.php",        // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request halaman to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				$(".upload-msg").html(data);
			}
		});
	}
));

// Function to preview image after validation
$("#userImage").change(function() {
	$(".upload-msg").empty(); 
	var file = this.files[0];
	var imagefile = file.type;
	var imageTypes= ["image/jpeg","image/png","image/jpg"];
		if(imageTypes.indexOf(imagefile) == -1)
		{
			$(".upload-msg").html("<span class='msg-error'>Pilih Gambar Bertipe JPEG, JPG Dan PNG</span>");
			return false;
		}
		else
		{
			var reader = new FileReader();
			reader.onload = function(e){
				$(".img-preview").html('<p id="p">Tampilan Gambar<p><img src="' + e.target.result + '" id="img" />');				
			};
			reader.readAsDataURL(this.files[0]);
		}
	});	
});
</script>

<?php
require "../config/connection.php";
require "../config/function.php";

$qry=que("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT 1");
while($data=fetch($qry))
{ $last_id = $data['id_produk'];$gambar = $data['gambar']; }


if(isset($_GET['id']))
{	$id=$_GET['id'];	
	$qryp=que("SELECT * FROM tb_produk WHERE id_produk = $_GET[id]");
	$datap=fetch($qryp);
	$id=$_GET['id'];
	$gambar = $datap['gambar']; 
}
else
{	$id=$last_id;   	}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["userImage"]["type"])){
	$msg = '';
	$uploaded = FALSE;
	$extensions = array("jpeg", "jpg", "png"); 					// file extensions to be checked
	$fileTypes = array("image/png","image/jpg","image/jpeg"); 	// file types to be checked
	$file = $_FILES["userImage"];
	@$file_extension = strtolower(end(explode(".", $file["name"])));
	if (in_array($file["type"],$fileTypes) && in_array($file_extension, $extensions)) {
		if ($file["error"] > 0)
		{	$msg = 'Error Code: ' . $file["error"]; }
		else {
			if (file_exists("../image/" . $file["name"])) 
			{	$msg = $file["name"].' already exist.'; }
			else {
				$sourcePath = $file['tmp_name']; 				//  source path of the file
				$targetPath = '../image/'.$file['name']; 			// Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath) ; 	// Moving Uploaded file
				$msg = 'Gambar Berhasil Diupload';
				$qry = que("UPDATE `db_autrom`.`tb_produk` SET `gambar` = '$file[name]' WHERE `tb_produk`.`id_produk` = $id;");
				$uploaded = TRUE;
				?>
				<script type="text/javascript">
                	$("#selesai").show(0);
                	$("#unggah").hide(0);
                	$("#selesai_id").hide(0);
                </script>
				<?php
			}
		}
	}
	else { 	$msg = 'Format Gambar Salah'; }
	echo ($uploaded ? $msg : '<span class="msg-error">'.$msg.'</span>');

}else{
?>		
	<div id="title_page">UPLOAD GAMBAR PRODUK</div>		
	<form class="frmUpload" action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id;?>">
        <table border="0">
          <tr>
            <td style="width:85px">Upload Gambar</td>
            <td>
                <input type="file" name="userImage" id="userImage" class="user-image" required />      
            </td>
          </tr>
          <tr>
            <td style="width:85px">&nbsp;</td>
            <td>    
            	<div class="img-preview">
                <?php
					if(isset($_GET['id'])){?>
                    	<p id="p">Tampilan Gambar<p><img src="image/<?php echo $gambar;?>" id="img" />
                        <?php
					}
				?>
                </div>
    			<div class="upload-msg"></div>
             </td>
          </tr>
          <tr>
            <td style="width:85px">&nbsp;</td>
            <td>
            	<input type="submit" value="Unggah" class="btn-upload" id="unggah"/>
            	<input type="button" value="Selesai" class="btn-upload" id="selesai" onClick="halaman('page/produk_view.php');">

			<?php if(isset($_GET['id'])){?>
                    	<input type="button" value="Selesai" class="btn-upload" id="selesai_id" onClick="halaman('page/produk_view.php');">
         	 <?php }?>
            </td>
          </tr>
      	</table>  
    </form>

<?php }?>