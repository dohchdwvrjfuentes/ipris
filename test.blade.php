@php
$x ='';
$y ='';
$z ='2013';

$con = mysqli_connect('localhost','root','','fhsis');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$addquery = "WHERE year = '$z'";

if(!empty($x)){
	$addquery .= "AND areacode = '$x'";
}
if(!empty($y)){
	$addquery .= "AND population = '$y'";
}

$query = "SELECT * from fh_fundamentals $addquery";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["areacode"]. " - Year: " . $row["year"]. " - Population: " . $row["population"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($con);

@endphp