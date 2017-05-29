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
#boxlogin{
	border:5px solid #333;
	margin:auto;
	width:350px;
	border-radius:15px;
	padding:15px 0px;
	margin-top:150px;
}
#input{
	border:1px solid #C9C9C9;
	border-radius:2px;
	padding:8px 6px 10px 6px;
	box-shadow:0px -3px 10px #F1F1F1 inset;
}
#input:hover{
	border:1px solid #02AAFB;
	transition:all ease-in 0.2s;
}
#input:focus{
	border:1px solid #02AAFB;
	box-shadow:0px 0px 4px #C5C5C5;
}
#masuk{
	border-radius:2px;
	padding:7px 6px 9px 6px;
	border:1px solid #C9C9C9;
	box-shadow:0px -8px 15px #E1E1E1 inset;
	background:#FFFFFF;
}
#masuk:hover{
	transition:all ease-in 0.1s;
	cursor:pointer;
	box-shadow:0px -2px 15px #E1E1E1 inset;
}
#pakecookie{
	margin:6px 0px 0px 55px;
}

#login{
	margin:auto;
	width:280px;
}
#notif{
	border:0px solid blue;
	margin:auto;
	width:285px;
	margin-top:10px;
	margin-bottom:20px;
	text-align:center;

}
.black{
	background:#333;
	color:#FFF;
}
.red{
	background:#D90000;
	color:#FFF;
}
p{
	width:285px;
	padding:10px 0px 10px 0px;
	
}
</style>

<script type="text/javascript">
$(document).ready(function(){

$("#login").submit(function(event){		
	event.preventDefault();		
	$("#masuk").focus();
	$("#login input").prop("disabled","disabled");
	if($("#pakecookie").prop("checked")==true) { pcookie = "iya"; }else{ pcookie = "tidak"; }
	$.post("page/login_cek.php",{un : $("[name='un']").val(), pw : $("[name='pw']").val(), pakecookie : pcookie}
	,function (result,status){
	if(status){
		if(result == 1)
		{ window.setTimeout('window.location=\"\"; ',0); }
		else{
			$('#notif').html("<p class='red'>Nama pengguna atau kata sandi salah!</p>");
			$("#login input").removeAttr("disabled");
		}
	}
	});
});
});
</script>

<div id="title_page">Login Kasir</div>
<div id="boxlogin">
    <div id="notif"><p class="black">Silahkan Login</p></div>
    
    <form action="#" method="post" id='login'>
      <input type='text' name='un' id='input' placeholder='Nama Pengguna' autocomplete="off"  required style="margin-bottom:5px;width:265px;"/><br/>
      <input type='password' name='pw' id='input'  placeholder='Kata Sandi' autocomplete="off" required style="width:209px;"/>
      <input type="submit" name='login' value='Masuk' id='masuk' class="masuk" onclick='login(); return false;'/><br>
      <input type="checkbox" name="pakecookie" id='pakecookie'/> <div style="margin:-15px 0px 8px 72px;">Biarkan saya tetap login</div>
    </form>
 </div>