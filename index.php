<!doctype html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>JavaScript Image Resample :: WebReflection</title>	
		<style type="text/css">
		.table1
		{
			font-family: verdana,arial,sans-serif;
			font-size:11px;
			color:#333333;
			border-width: 1px;
			border-color: #666666;
			border-collapse: collapse;
		}
		.table1 th 
		{
			border-width: 1px;
			padding: 3px;
			border-style: solid;
			border-color: #666666;
			background-color: #dedede;
		}
		.table1 td 
		{
			border-width: 1px;
			padding: 3px;
			border-style: solid;
			border-color: #666666;
			background-color: #ffffff;
		}
		</style>
	</head>
<body onload="getLocation();">
<input type="hidden" name="LAT" id="LAT"><br>
<input type="hidden" name="LON" id="LON"><br>
<input type="hidden" style="border:1px;" value="xxxx" size="30" name="LOC" id="LOC">
		<input id="width" type="hidden" value="1080" />
		
			<input id="cp1" type="hidden" readonly size="50"  value='' />
			<input id="cp2" type="hidden" readonly size="100"  value='' />
                                                     <input id="cp3" type="hidden" readonly size="50"  value='' />
			<input id="cp4" type="hidden" readonly size="50"  value='' />
		<br><input id="gal_id" type="hidden"  value='' />
		<br>
		<input id="height" type="hidden" />
		
			<input id="file" type="file" accept="image/*" capture="camera" />
	
		<br />
		<span id="message"></span>
		<br />
		<div id="img"></div>
		
		
		<div id="filesInfo">No Photo Selected</div>
	</body>
	<script src="resample.js"></script>
	<script>
		 (
		 
		 function (global, $width, $height, $file, $message, $img) 
		 {
			if (!global.FileReader)
				return $message.innerHTML = "FileReader API not supported" ;
			function resampled(data) 
			{
				$message.innerHTML = "File uploaded";
				($img.lastChild || $img.appendChild(new Image)).src = data;
			}
		  
		  function load(e) {
		   $message.innerHTML = "resampling ...";
		   Resample(
			 this.result,
			 this._width || null,
			 this._height || null,
			 resampled
		   );
		   
		  }
		  function abort(e) {
		   $message.innerHTML = "operation aborted";
		  }
		  function error(e) {
		   $message.innerHTML = "Error: " + (this.result || e);
		  }
			$file.addEventListener("change", function change() {
		   var
			width = parseInt($width.value, 10),
			height = parseInt($height.value, 10),
			file
		   ;
		   if (!width && !height) {
			$file.parentNode.replaceChild(
			 file = $file.cloneNode(false),
			 $file
			);
			$file.removeEventListener("change", change, false);
			($file = file).addEventListener("change", change, false);
			$message.innerHTML = "please specify width or height";
		   } else if(
			($file.files || []).length &&
			// the first file in this list 
			// has an image type, hopefully
			// compatible with canvas and drawImage
			// not strictly filtered in this example
			/^image\//.test((file = $file.files[0]).type)
		   ) {
			$message.innerHTML = "reading ...";
			file = new FileReader;
			file.onload = load;
			file.onabort = abort;
			file.onerror = error;
			file._width = width;
			file._height = height;
			file.readAsDataURL($file.files[0]);
		   } else if (file) {
			$message.innerHTML = "please chose an image";
		   } else {
			$message.innerHTML = "nothing to do";
		   }
		  }, false);
		 }(
		  this,
		  document.getElementById("width"),
		  document.getElementById("height"),
		  document.getElementById("file"),
		  document.getElementById("message"),
		  document.getElementById("img")
		 ));
		 
		 
		 
		 
var x=document.getElementById("demo");
function getLocation() 
{
    if (navigator.geolocation) 
	{
        navigator.geolocation.getCurrentPosition(showPosition);
	} 
	else 
	{
		x.innerHTML = "Geolocation is not supported by this browser.";
    }

}
function showPosition(position)
{
    LAT=document.getElementById("LAT");
    LON=document.getElementById("LON");
    LAT.value= position.coords.latitude;
    LON.value=position.coords.longitude;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("LOC").value = this.responseText;
		}
  };
  xhttp.open("GET", "get_place.asp?lat=" + position.coords.latitude+ "&lon="+position.coords.longitude, true);
  xhttp.send();
  	
	
}

function get_place()
{
		
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			document.getElementById("LOC").value = this.responseText;
		}
  };
  xhttp.open("GET", "get_place.asp?lat=" + document.getElementById("LAT").value+ "&lon="+document.getElementById("LON").value, true);
  xhttp.send();
  
	
}

	</script>
<BR>
<BR>
<BR>
<BR>
</html>