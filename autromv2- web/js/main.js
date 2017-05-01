$(document).ready(function(){
	$('#loader').hide(0);
});

function waktu(){
	date= new Date();
	j=date.getHours();
	m=date.getMinutes();
	s=date.getSeconds();	
	if(j<10){j="0"+j;}if(m<10){m="0"+m;}if(s<10){s="0"+s;}
	$('#waktu').html(j+":"+m+":"+s);
	setTimeout("waktu()",500);
}

function halaman(url){
	$("#content").html("");
	$("#content").hide(0);			
	$('#loader').show(0);
	page = url;
	$.ajax({
		url: page,
		success:function(result,status){
			$('#loader').delay(0).hide(0);
			$("#content").html(result);
			if(document.readyState === 'complete') {
				$('#content').delay(1000).show(0);
			}
		}
	});
}
function centang_semua(){
	 allCheckList = document.getElementById("form_data").elements;
	 jumlahCheckList = allCheckList.length;
	 if(document.getElementById("centang").value == "all"){
		for(i = 0; i < jumlahCheckList; i++){ allCheckList[i].checked = true; }
		document.getElementById("centang").value = "unall";
	 }else{
		for(i = 0; i < jumlahCheckList; i++){ allCheckList[i].checked = false; }
		document.getElementById("centang").value = "all";
	 }
}

function konfirmasi(kata,url){
	x = confirm("Yakin menghapus " + kata + "?");
	if(x == true)
	{	halaman(url);return true;	}
	else
	{	return false; }
}

function tanya(url) {
	x = confirm("Yakin menghapus yang dicentang?");
	if(x == true) {
		data = $("#form_data").serialize();
		halaman(url+"?"+data);
		return true;
	} else {
		return false; 
	}
}
function pencarian(url,data){
    halaman(url+"?cari="+data);
}
function update_transaksi_sementara(url,id,data,cari){
		$.ajax({
		url: url+"?id="+id+"&data="+data+"&cari="+cari,
		success:function(result,status){$("#content").html(result);}});
}
function pg(url){
		$.ajax({
		url: url,
		success:function(result,status){$("#content").html(result);}});
}
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
function new_url(url){
 	window.open(url,'_top');
}