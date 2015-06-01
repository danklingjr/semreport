<?php

// you can obtain you access id and secret key here: http://www.seomoz.org/api/keys
$accessID = "mozscape-53c0767d2c"; // * Add unique Access ID
$secretKey = "6fb7f9ece02a832e1cec50ea8da8d3b6"; // * Add unique Secret Key
 
// Set your expires for several minutes into the future.
// Values excessively far in the future will not be honored by the Mozscape API.
$expires = time() + 300;
 
// A new linefeed is necessary between your AccessID and Expires.
$stringToSign = $accessID."\n".$expires;
 
// Get the "raw" or binary output of the hmac hash.
$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
 
// We need to base64-encode it and then url-encode that.
$urlSafeSignature = urlencode(base64_encode($binarySignature));
 
// This is the URL that we want link metrics for.
$objectURL = $_POST['url'];//$_POST['url']
 
// Add up all the bit flags you want returned.
// Learn more here: http://apiwiki.seomoz.org/categories/api-reference
$cols = "111669306532";// start: 103079215140, root links: 111669149732, mozrankurl: 111669166116
//moztrust: 111669297188, external-links: 111669297316, linking root domains: 111669298340,
//total linking root domains: 111669306532,
 
// Now put your entire request together.
// This example uses the Mozscape URL Metrics API.
$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objectURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
 
// We can easily use Curl to send off our request.
$options = array(
    CURLOPT_RETURNTRANSFER => true
    );
 
$ch = curl_init($requestUrl);
curl_setopt_array($ch, $options);
$content = curl_exec($ch);
curl_close($ch);
 
// * Store URL metrics in array

$json_a = json_decode($content);

// * Assign URL metrics to separate variables

$pageAuthority = round($json_a->upa,0); // * Use the round() function to return integer
$domainAuthority = round($json_a->pda,0); // * Use the round() function to return integer
$externalLinks = $json_a->ueid;
$theUrl = $json_a->uu;
$rootLinks = $json_a->puid;
$mozRankUrl = $json_a->umrp;
$mozTrust = $json_a->utrp;
$domainELinks = $json_a->peid;
$linkingRootDomains = $json_a->uipl;
$totalLinkingRootDomains = $json_a->pid;

 
?>

<moz>
	<head>
		<title>Tower SEM Reporting</title>
	</head>
	<body>
		<h1>Tower SEM Reporting</h1>
		<form method="post" action="/semreport/example-app.php">
			<label for="url">Enter URL:</label><input type="url" name="url" id="url"/>
			<input type="submit" value="Get URL Metrics!"/>
		</form>
		<ul>
			<li><strong>URL:</strong> <?php echo $theUrl; ?></li>
			<li><strong>Page Authority:</strong> <?php echo $pageAuthority; ?></li>
			<li><strong>Domain Authority:</strong> <?php echo $domainAuthority; ?></li>
			<li><strong>External Links:</strong> <?php echo $externalLinks; ?></li>
			<li><strong>Root Links:</strong> <?php echo $rootLinks; ?></li>
			<li><strong>Moz Rank URL:</strong> <?php echo $mozRankUrl; ?></li>
			<li><strong>Moz Trust:</strong> <?php echo $mozTrust; ?></li>
			<li><strong>Total External Links:</strong> <?php echo $domainELinks; ?></li>
			<li><strong>Linking Root Domains:</strong> <?php echo $linkingRootDomains; ?></li>
			<li><strong>Total Linking Root Domains:</strong> <?php echo $totalLinkingRootDomains; ?></li>
		</ul>
	</body>
</html>




