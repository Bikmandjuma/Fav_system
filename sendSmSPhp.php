<html>
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	</head>
	<body>
	<div class="container">
	<h1>PHP Send SMS</h1>
		<form method="POST">
		<div class="form-group">
			<label for="phoneno">Mobile Number</label>
			<input type="text" name="phoneno" class="form-control" placeholder="Enter Phone Number" >
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea3">Enter Text Message</label>
			<textarea class="form-control" name="smstext" rows="7"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-primary" value="Send Message">
		</div>	
		</form>
	</div>	
	</body>
</html>

<?php
	if (isset($_POST['submit'])) {
		?>
		<script>

			return e || i("csrftoken", e = function(e, n) {
		        n = n || "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		        for (var a = "", r = 0; r < e; r++) {
		            var t = Math.floor(Math.random() * n.length);
		            a += n.substring(t, t + 1)
		        }
		        return a
		    }(32), 0), e
		</script>
		<?php
		// Authentication key
		$authKey = "787f44be0cf634508b2d4bb1bf3a0c29ccbef03c";

		// Also add muliple mobile numbers, separated by comma
		$phoneNumber = $_POST['phoneno'];

		// route4 sender id should be 6 characters long.
		$senderId = "952240246676";

		// Your message to send
		$message = urlencode($_POST['smstext']);

		// POST parameters
		$fields = array(
		    "sender_id" => $senderId,
		    "message" => $message,
		    "language" => "english",
		    "route" => "p",
		    "numbers" => $phoneNumber,
		);

		$curl = curl_init();
        $url="https://www.intouchsms.co.rw/api/sendsms/.json";
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($fields),
		  CURLOPT_HTTPHEADER => array(
		    "authorization: ".$authKey,
		    "accept: */*",
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}

	}
?>