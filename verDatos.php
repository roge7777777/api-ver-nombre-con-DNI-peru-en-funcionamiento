<?php
 $DNI=0;
if($_POST){
	$DNI= (isset($_POST['DNI']))?$_POST['DNI']:"";
}
$url = "https://www.dayangels.xyz/api/reniec/reniec-dni";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoxNTEsImNvcnJlbyI6InJvZ2U3enZpdmFuY29AZ21haWwuY29tIiwiaWF0IjoxNjUyNzUzNTkyfQ.XhgSZJr_qaJn654TPJFSiJkKlZ0uiQYbd9x6DGSOU6g",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data =  array('dni'=> $DNI);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
 

$obj=json_decode($resp, true);


curl_close($curl);



?>





<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulario</title>
</head>
<body>
	<?php if($_POST){ ?>
	<strong>hola</strong>: <?php echo $obj["result"]["nombres"];?>
	<?php } else{echo "no hay datos";}?>
	<br/>
	
	<form action="clientes.php" method="post">
	  DNI:<br/>
	
	  <input type="text" name="DNI" id="" value="<?php echo $DNI;?>"><br/>
  	<input type="submit" value="comprobar"><br/>
	APELLIDO PATERNO:<br/>
	  <input type="text" name="paterno" id="" disabled  value="<?php echo $obj["result"]["paterno"];?>"><br/>
	APELLIDO MATERNO:<br/>
	  <input type="text" name="materno" id="" disabled  value="<?php echo $obj["result"]["materno"];?>"><br/>
	NOMBRE:<br/>
	  <input type="text" name="nombre" id="" disabled  value="<?php echo $obj["result"]["nombres"];?>"><br/>
	SEXO:<br/>
	  <input type="text" name="sexo" id=""  disabled value="<?php echo $obj["result"]["sexo"];?>"><br/>
	
	<input type="submit" value="enviar informacion">
	</form>

</body>
</html>
