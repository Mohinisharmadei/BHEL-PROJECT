<table>
<%
   $LAT1=$_GET["lat"];
 $LON1=$_GET["lon"]; 
   mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("bhel") or die(mysql_error());
$SQL="SELECT * FROM project ";
$data2 = mysql_query($SQL);
while($rs2 = mysql_fetch_array( $data2 ))
{
   $LAT2=$rs2["latitude"];
   $LON2=$rs2["longitude"];
   $radlat1 = 3.141 * $LAT1/180;
    $radlat2 = 3.141 * $LAT2/180;
	$theta = $LON1-$LON2;
	$radtheta = 3.141 * $theta/180;
	$dist = sin($radlat1) * sin($radlat2) + cos($radlat1) * cos($radlat2) * cos($radtheta);
	$dist = acos($dist);
	$dist = $dist * 180/3.141;
	$dist = $dist * 60 * 1.1515*1000;
       if($dist<="10000")
    {
    echo "We are in:";
  echo  $rs2["project_location"];
    }
%>
 <tr>
        <td><%=$rs2["sno"]%></td>
    <td><%=$rs2["region"]%></td>
    <td><%=$rs2["project_location"]%></td>
    <td><%=$rs2["latitude"]%></td>
    <td><%=$rs2["longitude"]%></td>
    <td><%=$dist%></td>
    </tr>
    <%
       }
    %>
</table>
    
