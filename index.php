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
			table#t00 tr:nth-child(even) {
			background-color:#E0E0C0;
			}
			table#t00 tr:nth-child(odd) {
			background-color:#08597B;
			color: white;
			}
		</style>
	</head>
<!--Page Color-->
	<body bgcolor="#E7EBEF">
<!--Server/Payment/Operation Panel-->
	<body>	
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
									<option value="5555- payment">5555- payment</option>
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
	</body>
</html> 