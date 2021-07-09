
var Resample = (function (canvas) {
 function Resample(img, width, height, onresample) {
  var
   load = typeof img == "string",
   i = load || img
  ;
  if (load) {
   i = new Image;
   i.onload = onload;
   i.onerror = onerror;
  }
  i._onresample = onresample;
  i._width = width;
  i._height = height;
  load ? (i.src = img) : onload.call(img);
 }
 function onerror() {
  throw ("not found: " + this.src);
 }
 function onload() {
  var
	img = this,
	width = img._width,
	height = img._height,
	onresample = img._onresample;
  
	width == null && (width = round(img.width * height / img.height));
	height == null && (height = round(img.height * width / img.width));
	delete img._onresample;
	delete img._width;
	delete img._height;
	canvas.width = width;
	canvas.height = height;
	context.drawImage(img, 0, 0,  img.width,   img.height,   0,   0,   width,   height  );

	context.textAlign = "left";
	
	context.fillStyle = "black";
	context.globalAlpha = 0.3;
	//context.fillRect(5,4,700,80);
	//context.fillRect(164,4,700,65);
	
	
	//	context.drawImage(img, 0, 0,  img.width,   img.height,   0,   0,   width,   height  );

	context.fillStyle = "white";
	context.globalAlpha = 1;
	context.font="28px Verdana";
	context.fillStyle = "yellow";

	context.fillText(document.getElementById("LOC").value,20,20);
	
	//var d = new Date();
	
	//context.fillText(d.getDay()+"."+d.getMonth()+"."+d.getYear(),20,50);
	//context.fillText("Hello",20,20);

	context.font="24px Verdana";
	context.fillStyle = "white";

//	context.fillText(document.getElementById("cp2").value + "/" + document.getElementById("cp3").value,512,60);

	
	
	
	//context.font="18px Verdana";
	//context.fillStyle = "white";
	//context.fillText("Date Uploaded:" + document.getElementById("cp4").value,800,650);


	onresample(canvas.toDataURL("image/png"));
	var dataURL = canvas.toDataURL("image/jpeg");
  
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(ev)
	{
            document.getElementById('filesInfo').innerHTML = '';
           // document.getElementById('div_table').innerHTML = '';
    };
 
    xhr.open('POST', 'new_upload.php', true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //var data = 'image=' + dataURL;
		
    var data = 'image=' + dataURL;
	   
	xhr.send(data);
	   
 }
 
 var
  context = canvas.getContext("2d"),
  round = Math.round
 ;
 
 return Resample;
 
}(
 this.document.createElement("canvas"))
);
