<?php
# reporterCode and partnerCode = M49 countrycode, cmdCode= total aggregateBy = sorting 
# countryCode: 36 = aus 156 = China 392 = Janpan
#trade flow x = export m = import 
$repoterCode = 36;
$exportA = array();
$importA = array();
$year = array();
function uncomtrade($repoterCode,$partnerCode,$period){
global $exportA;
global $importA;
global $year;
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
    $importV = number_format($result[0][56]);
    array_push($exportA,$exportV);
    array_push($importA,$importV);
    array_push($year,$period);
    print_r($importA);
    print_r($exportA);
    print_r($year);
} else {
    echo('error');
}
}
if(isset($_POST['China'])) {
    $partnerCode = 156;
    uncomtrade($repoterCode,$partnerCode,2021);
    uncomtrade($repoterCode,$partnerCode,2020);
    uncomtrade($repoterCode,$partnerCode,2019);
    uncomtrade($repoterCode,$partnerCode,2018);
    uncomtrade($repoterCode,$partnerCode,2017);
    print_r($importA);
    print_r($exportA);
    print_r($year);
}
if(isset($_POST['Japan'])) {
    $partnerCode = 392;
    uncomtrade($repoterCode,$partnerCode,2021);
    uncomtrade($repoterCode,$partnerCode,2020);
    uncomtrade($repoterCode,$partnerCode,2019);
    uncomtrade($repoterCode,$partnerCode,2018);
    uncomtrade($repoterCode,$partnerCode,2017);
    print_r($importA);
    print_r($exportA);
    print_r($year);
}

?>
