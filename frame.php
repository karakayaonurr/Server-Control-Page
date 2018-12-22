<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset=�UTF-8�>
		<meta name="description" content="Server Control Page" />
		<title id='Description'>Server Control Page</title>	
		<link rel="Shortcut Icon" href="favicon-isbank.png" type="image/x-icon">
<!--Table Rules-->
		<style>
		table {
			width:523px;
		}
		table, th, td {
			border: 2px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 5px;
			text-align: left;
		}
		table tr:nth-child(even) {
			background-color:#E0E0C0;
		}
		table tr:nth-child(odd) {
			background-color:#F0F0E0;
		}
		table th {
			background-color: #08597B;
			color: white;
			width:33%;
		}
		table#t00 tr:nth-child(even) {
			background-color:#E0E0C0;
		}
		table#t00 tr:nth-child(odd) {
			background-color:#08597B;
			color: white;
		}
		</style>
<!--Table Function-->
		<?php
		function table($server_type, $payment_type, $operation_type){
			echo "<br><hr><br>";
			echo "<table border=\"1\" >";
			echo "<tr><th><center>$server_type</th><th><center>$payment_type</th><th><center>$operation_type</th></tr>";
			echo "</table>";
		}
		?>
<!--Webserver Test Function-->
		<?php
			function CallAPI($method, $url, $data = false)
			{
				$curl = curl_init();
				switch ($method)
					{
						case "POST":
							curl_setopt($curl, CURLOPT_POST, 1);
							if ($data)
								curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
								break;
						case "PUT":
							curl_setopt($curl, CURLOPT_PUT, 1);
							break;
						default:
						if ($data)
						$url = sprintf("%s?%s", $url, http_build_query($data));
					}
				// Optional Authentication:
				curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($curl, CURLOPT_USERPWD, "xxxxx:yyyyy");
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($curl);
				curl_close($curl);
				echo $result;
			}
		?>
	</head>	
<!--Page Color-->
	<body bgcolor="#E7EBEF">
<!--Choises Control-->
		<?php
		function go ($url, $time = 1){
		if ($time) header("Refresh: {$time}; url={$url}");
			else header("Location: {$url}");
		}
		if ($_POST["server_type"] == "wrong" || $_POST["payment_type"] == "wrong" || $_POST["operation_type"] == "wrong")
			{ echo '<script type="text/javascript">alert("HATA: En az bir adet Server-Cluster-Operation secmek zorundasiniz!");</script>'; 
				go("index.php", 0.1);
			}
			else if ($_POST["server_type"] == "Tum_Serverler" && $_POST["payment_type"] == "Tum_Clusterler")
				{ echo '<script type="text/javascript">alert("HATA: Server ve Cluster secenekleri ayni anda Tumu olamaz!");</script>'; 
					go("index.php", 0.1);
				}
		?>
<!--Server/Payment/Operation Panel-->
		<div align="center"><br>
			<table id="t00">
				<tr>
					<td><center><strong>Server Kontrol Sayfası</center></td>
				</tr>
				<tr>
					<td style="vertical-align: top;">
						<body>
					<!--Veriables Transmisson To Other Page-->
							<form action="frame.php" method="post">
								<select name="server_type" id="server_type" onchange="server_text(this)">
									<option value="wrong">Server Seçiniz..</option>
									<option value="xxxxxxx1.xxxxxxxx">xxxxxxx1.xxxxxxxx</option>
									<option value="xxxxxxx2.xxxxxxxx">xxxxxxx2.xxxxxxxx</option>
									<option value="Tum_Serverler">Tümü</option>
								</select>
								<select name="payment_type" id="payment_type" onchange="payment_text(this)">
									<option value="wrong">Cluster Seçiniz..</option>
									<option value="0000- default">0000- default</option>
									<option value="1111- account">1111- account</option>
									<option value="2222- cpm">2222- cpm</option>
									<option value="3333- ess">3333- ess</option>
									<option value="4444- finance">4444- finance</option>
									<option value="0000- payment">0000- payment</option>
									<option value="6666- risk">6666- risk</option>
									<option value="7777- tax">7777- tax</option>
									<option value="8888- underwriting">8888- underwriting</option>
									<option value="Tum_Clusterler">Tümü</option>
								</select>
								<select name="operation_type" id ="operation_type" onchange="operation_text(this)">
									<option value="wrong">Operation Seçiniz..</option>
									<option value="getJvmStats">getJvmStats</option>
									<option value="getEntireXStats">getEntireXStats</option>
									<option value="getJdbcPoolStats">getJdbcPoolStats</option>
									<option value="getJmsConf">getJmsConf</option>
									<option value="getPortConf">getPortConf</option>
									<option value="getServerStatus">getServerStatus</option>
									<option value="getThreadPoolStats">getThreadPoolStats</option>
								</select>
								<input value="Seçim" type="submit">
							</form>
						</body>
					</td>
				</tr>
			</table>
		</div>
		<br>
<!--Table-->
		<div align="center">
<!--Check That The Number Of Table-->		
		<?php		
			if ($_POST["server_type"] == "xxxxxxx1.xxxxxxxx"){
				if ($_POST["payment_type"] == "0000- default"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "1111- account"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "2222- cpm"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "3333- ess"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "4444- finance"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "5555- payment"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "6666- risk"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "7777- tax"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "8888- underwriting"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "Tum_Clusterler"){
					if ($_POST["operation_type"] == "getEntireXStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
					}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
					}
					if ($_POST["operation_type"] == "getJmsConf"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
					}
					if ($_POST["operation_type"] == "getPortConf"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
					}
					if ($_POST["operation_type"] == "getServerStatus"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
					}
					if ($_POST["operation_type"] == "getJvmStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
					}
					if ($_POST["operation_type"] == "getThreadPoolStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
					}
				}
			}
			if ($_POST["server_type"] == "xxxxxxx2.xxxxxxxx"){
				if ($_POST["payment_type"] == "0000- default"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "1111- account"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "2222- cpm"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "3333- ess"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "4444- finance"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "5555- payment"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "6666- risk"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "7777- tax"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "8888- underwriting"){
					table($_POST["server_type"], $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "Tum_Clusterler"){
					if ($_POST["operation_type"] == "getEntireXStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);
					}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);
					}
					if ($_POST["operation_type"] == "getJmsConf"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);
					}
					if ($_POST["operation_type"] == "getPortConf"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);
					}
					if ($_POST["operation_type"] == "getServerStatus"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);
					}
					if ($_POST["operation_type"] == "getJvmStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);
					}
					if ($_POST["operation_type"] == "getThreadPoolStats"){
						$p1="<font color='#33FFFF'>0000- default</font>"; $p2="<font color='#33FFFF'>1111- account</font>"; $p3="<font color='#33FFFF'>2222- cpm</font>"; 
						$p4="<font color='#33FFFF'>3333- ess</font>"; $p5="<font color='#33FFFF'>4444- finance</font>"; $p6="<font color='#33FFFF'>5555- payment</font>"; 
						$p7="<font color='#33FFFF'>6666- risk</font>"; $p8="<font color='#33FFFF'>7777- tax</font>"; $p9="<font color='#33FFFF'>8888- underwriting</font>";
						table($_POST["server_type"], $p1, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p2, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p3, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p4, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p5, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p6, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p7, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p8, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
						table($_POST["server_type"], $p9, $_POST["operation_type"]);
						CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);
					}
				}
			}
			if ($_POST["server_type"] == "Tum_Serverler"){
				if ($_POST["payment_type"] == "0000- default"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:0000/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "1111- account"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}	
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:1111/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}				
				}
				if ($_POST["payment_type"] == "2222- cpm"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:2222/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "3333- ess"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:3333/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
				}
				if ($_POST["payment_type"] == "4444- finance"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:4444/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}	
				}
				if ($_POST["payment_type"] == "5555- payment"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:5555/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}		
				}
				if ($_POST["payment_type"] == "6666- risk"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:6666/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
				}
				if ($_POST["payment_type"] == "7777- tax"){	
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}	
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:7777/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}	
				}
				if ($_POST["payment_type"] == "8888- underwriting"){
					$s1="<font color='#33FFFF'>xxxxxxx1.xxxxxxxx</font>"; $s2="<font color='#33FFFF'>xxxxxxx2.xxxxxxxx</font>";
					table($s1, $_POST["payment_type"], $_POST["operation_type"]); 
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx1.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
					table($s2, $_POST["payment_type"], $_POST["operation_type"]);
					if ($_POST["operation_type"] == "getEntireXStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getEntireXStats", $data = false);}
					if ($_POST["operation_type"] == "getJdbcPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJdbcPoolStats", $data = false);}
					if ($_POST["operation_type"] == "getJmsConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJmsConf", $data = false);}
					if ($_POST["operation_type"] == "getPortConf"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getPortConf", $data = false);}
					if ($_POST["operation_type"] == "getServerStatus"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getServerStatus", $data = false);}
					if ($_POST["operation_type"] == "getJvmStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getJvmStats", $data = false);}
					if ($_POST["operation_type"] == "getThreadPoolStats"){CallAPI("GET", "http://xxxxxxx2.xxxxxxxx:8888/rest/yyyyyyyyyyy/services/integration/restServices/inbound/getThreadPoolStats", $data = false);}
				}
			}
		?>
		</div>
	</body>	
</html>