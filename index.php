<?php
# reporterCode and partnerCode = countrycode, cmdCode= total aggregateBy = sorting 
# countryCode: 36 = aus 156 = China 392 = Janpan
#trade flow x = export m = import 
$repoterCode = 36;
$period = 2021;
$partnerCode = 392;

$url = "https://comtradeapi.un.org/data/v1/get/C/A/HS?reporterCode=".$repoterCode."&period=".$period."&partnerCode=".$partnerCode."&cmdCode=total&aggregateBy=cmdCode&breakdownMode=classic&includeDesc=false";
$curl = curl_init($url);

curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

# Request headers
$headers = array(
    'Cache-Control: no-cache',
    'Ocp-Apim-Subscription-Key: ',); #require subscription key on uncomtrade website
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($curl);
curl_close($curl);
if (str_contains($resp, 'primaryValue')) {
    preg_match_all('!\d+!',$resp,$result);
    $exportV = number_format($result[0][26]);
    $importV = number_format($result[0][56];
    echo($exportV);
    echo($importV);
} else {
    echo('error');
}
?>
