<!DOCTYPE html>
<html manifest="josearch.manifest">
<head>
<title>josearch torrents</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
.mainContainer{	
	margin-right: auto;
	margin-left: auto;
	margin-top:13%;
	width:500px;
	height: 400px;
	text-align: center;
}
input[type=text]{
	width:450px;
	height:35px;
}
.settingsCog{
	position: fixed;
	top:15px;
	right:15px;
	color:#105DB4;
}
</style>
</head>
<body onload="FocusOnInput()">

<span id="txtHint"></span>

<div class="settingsCog">
	<button class="btn btn-link" data-toggle="modal"  data-target=".bs-modal-sm">
	  <i class="fa fa-cog"></i>
	</button>
</div>



<div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Settings</h4>
      	</div>
      	<div class="modal-body">
     
    			<h5>Safesearch</h5>

		        <select class="form-control" onchange="set_safesearch(this.value);clearSearch();getMagnet('');">
		          <?php
		          if(isset($_COOKIE['safesearch'])){
			          if($_COOKIE['safesearch'] == 'On'){
			          	echo '<option value="On">On - Slowest</option>';
			          	echo '<option value="Off">Off - Fastest</option>';
			          }
			          if($_COOKIE['safesearch'] == 'Off'){
			          	echo '<option value="Off">Off - Fastest</option>';
			          	echo '<option value="On">On - Slowest</option>';
			          }
		      	  }else{
			          	echo '<option value="Off">Off - Fastest</option>';
			          	echo '<option value="On">On - Slowest</option>';		      	  	
		      	  }
		          ?>
				</select>
		  
		  <!--
		  		<h5>Annonymous (*Beta)</h5>

		        <select class="form-control">
				  <option>Off - Fastest</option>
				  <option>On - Slowest</option>
				</select>
			-->



      	</div>



    </div>
  </div>
</div>


<div class="mainContainer">
	<form role="form">
		<img src="josearch.png"><br>
		<input placeholder="type exact keyword to generate a link" type="text" name="q" id="searchInput" onkeyup="getMagnet(this.value)" autocomplete="off"><br>
		<br>
		<smartform id="magnetLink"></smartform>
	</form>
</div>


<script type="text/javascript">
//allows the x button in getMagnet to clear the input of the searchInput
function clearSearch() {
     document.getElementById('searchInput').value = "";   
}
//focus on searchIput field on page load
function FocusOnInput()
 {
 document.getElementById("searchInput").focus();
 }
//search getMagnet.php
function getMagnet(str)
{
if (str.length==0)
  { 
  document.getElementById("magnetLink").innerHTML="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("magnetLink").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getMagnet.php?q="+str,true);
xmlhttp.send();
}
//change safesearch options from settings cog
function set_safesearch(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","safesearch.php?q="+str,true);
xmlhttp.send();
}
//disable return/enter key
function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 
document.onkeypress = stopRKey; 
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>