<?php

function contentGet($link, $blocked = false) {
	if($blocked) {
		$service = parse_url($link);
		$link = 'http://'.$service['host'].'.prx2.unblocksit.es'.$service['path'];
	}
	$ch = curl_init($link);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36');
	curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'));
	curl_setopt ($ch, CURLOPT_REFERER, $link);
	if($blocked) {
		curl_setopt($ch, CURLOPT_COOKIE, "ohngeCa5-Human=Human");
	}
	$content = curl_exec($ch);
	curl_close($ch);
	return $content;
}

function redirects($link) {
$x = get_headers($link, true);
return is_array($x['Location']) ? $x['Location'][0] : $x['Location'];
}

function linkbucks($link) {

$content = contentGet($link);

preg_match('/Token: \'(.*?)\'/', $content, $token);
preg_match_all('/params\[\'Au\' \+ \'thKey\'\] = (.*?);/', $content, $akvals);
preg_match('/params\[\'AuthK\' \+ \'ey\'\] \+ (.*?);/', $content, $val);

$tokenfinal = $token[1];

$ak1 = $akvals[1][0];
$ak2 = $akvals[1][1];
$ak3 = $akvals[1][2];

$valtoadd = $val[1];

if($ak1-$ak2 == $valtoadd) {
$ak = $ak3;
} else if ($ak2-$ak3 == $valtoadd) {
$ak = $ak1;
} else if($ak1-$ak3 == $valtoadd) { 
$ak = $ak2;
}

$ak += $valtoadd;

$finallink = "http://www.linkbucks.com/intermission/loadTargetUrl?t=$tokenfinal&aK=$ak";

$z=0;
do {

$ch = curl_init($finallink);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
$content = curl_exec($ch);
$json = json_decode($content, true);
curl_close($ch);

} while (!isset($json['Url'])); 


return $json['Url'];
}

function adfly($link) {
	$content = contentGet($link, true);
	preg_match('/var ysmm = \'(.*?)\'/', $content, $base64);
	$base64encode = str_split($base64[1]);

	$base1 = $base2 = "";
	for($i=0; $i<count($base64encode);$i++) {
	if($i%2 == 0) {
	$base1 .= $base64encode[$i];
	}
	else {
	$base2 .= $base64encode[$i];
	}
	}
	$finalbase = $base1.strrev($base2);
	return substr((base64_decode($finalbase)), 2);
}

function shst($link) {
$content = contentGet($link);
preg_match('/sessionId: "(.*?)",/', $content, $match);
$finallink = 'http://sh.st/adSession/callback?sessionId='.$match[1];
do {
$ch = curl_init($finallink);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_REFERER, 'http://sh.st');
$json = curl_exec($ch);
curl_close($ch);
$finaljson = json_decode($json, true);
} while(!isset($finaljson['destinationUrl'])); 
return $finaljson['destinationUrl'];
}

function adfoc($link) {
$content = contentGet($link);
preg_match('/var click_url = "(.*?)";/', $content, $match);
return $match[1];
}

function coinurl($link) {
$token = contentGet('http://schetu.net/h?cid=coinurl&a=t');
preg_match('/__schetunet\(\'(.*?)\'\)/', $token, $match);
$token = $match[1];
$path = str_replace('/', '', parse_url($link)['path']);
$content = contentGet($link);
preg_match('/ifr\.src \= "(.*?)"\&r\="/', $content, $match);
$url = str_replace('" + escape(c) + "', $path, $match[1]);
$url = str_replace('" + ticket + ', $token, $url);
$content = contentGet($url);
preg_match('/frame src\="ntop\.php(.*?)"/', $content, $match);
$content = contentGet("http://cur.lv/ntop.php$match[1]");
preg_match('/\'(.*?)\', \'go\'\); return false;"/', $content, $match);
return $match[1];
}

function linkshrink($link) {
$content = contentGet($link);
preg_match('/\'\<a class\="bt" href\="(.*?)"\>/', $content, $match);
$x = get_headers($match[1], true);
return is_array($x['Location']) ? $x['Location'][0] : $x['Location'];
}

function refso($link) {
$content = contentGet($link);
preg_match('/meta name\="description" content\="(.*?)"/', $content, $match);
return $match[1];
}

function clkim($link) {
$x = get_headers($link, true);
if(isset($x['Location'])) {
return is_array($x['Location']) ? $x['Location'][0] : $x['Location'];
}
$content = contentGet($link);

if(preg_match('/untdown\);\$\("a\.redirect"\)\.attr\("href","(.*?)"/', $content)) {
preg_match('/untdown\);\$\("a\.redirect"\)\.attr\("href","(.*?)"/', $content, $match);
}
else if(preg_match('/own"\)\.attr\("href","(.*?)"/', $content)) {
preg_match('/own"\)\.attr\("href","(.*?)"/', $content, $match);
}

return $match[1];
}

?>