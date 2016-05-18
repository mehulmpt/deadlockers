<?php

$time_start = microtime(true);

header('Content-Type: application/json; charset=utf-8');

require_once('functions_api.php');
$url = $_GET['url'];

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    $array = array(
        'Error' => 'Invalid URL'
    );
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
    exit();
}

$service = parse_url($url);
switch ($service['host']) {
    case 'adf.ly':
    case 'www.adf.ly':
    case 'j.gs':
    case 'q.gs':
    case 'www.j.gs':
    case 'www.q.gs':
        
        $link = adfly($url);
        
        break;
    case 'www.sh.st':
    case 'sh.st':
        
        $link = shst($url);
        
        break;
    case 'adfoc.us':
    case 'www.adfoc.us':
        
        $link = adfoc($url);
        
        break;
    case 'goo.gl':
    case 'www.goo.gl':
    case 'ow.ly':
    case 'www.ow.ly':
    case 'bit.ly':
    case 'bitly.com':
    case 'www.bitly.com':
    case 'www.bit.ly':
    case 'tinyurl.com':
    case 'snipurl.com':
    case 'www.snipurl.com':
        
        $link = redirects($url);
        
        break;
    case 'linkbucks.com':
    case 'any.gs':
    case 'cash4links.co':
    case 'cash4files.com':
    case 'dyo.gs':
    case 'filesonthe.net':
    case 'goneviral.com':
    case 'megaline.co':
    case 'miniurls.co':
    case 'seriousdeals.net':
    case 'theseblogs.com':
    case 'theseforums.com':
    case 'tinylinks.co':
    case 'tubeviral.com':
    case 'ultrafiles.net':
    case 'urlbeat.net':
    case 'whackyvidz.com':
    case 'qqc.co':
    case 'yyv.co':
    case 'allanalpass.com':
    case 'amy.gs':
    case 'deb.gs':
    case 'drstickyfingers.com':
    case 'fapoff.com':
    case 'freean.us':
    case 'freegaysitepass.com':
    case 'galleries.bz':
    case 'hornywood.tv':
    case 'linkbabes.com':
    case 'picbucks.com':
    case 'poontown.net':
    case 'sexpalace.gs':
    case 'tnabucks.com':
    case 'youfap.me':
    case 'rqq.co':
    case 'zff.co':
    case 'www.linkbucks.com':
    case 'www.any.gs':
    case 'www.cash4links.co':
    case 'www.cash4files.com':
    case 'www.dyo.gs':
    case 'www.filesonthe.net':
    case 'www.goneviral.com':
    case 'www.megaline.co':
    case 'www.miniurls.co':
    case 'www.seriousdeals.net':
    case 'www.theseblogs.com':
    case 'www.theseforums.com':
    case 'www.tinylinks.co':
    case 'www.tubeviral.com':
    case 'www.ultrafiles.net':
    case 'www.urlbeat.net':
    case 'www.whackyvidz.com':
    case 'www.qqc.co':
    case 'www.yyv.co':
    case 'www.allanalpass.com':
    case 'www.amy.gs':
    case 'www.deb.gs':
    case 'www.drstickyfingers.com':
    case 'www.fapoff.com':
    case 'www.freean.us':
    case 'www.freegaysitepass.com':
    case 'www.galleries.bz':
    case 'www.hornywood.tv':
    case 'www.linkbabes.com':
    case 'www.picbucks.com':
    case 'www.poontown.net':
    case 'www.sexpalace.gs':
    case 'www.tnabucks.com':
    case 'www.youfap.me':
    case 'www.rqq.co':
    case 'www.zff.co':
        
        $link = linkbucks($url);
        
        break;
    
    case 'cur.lv':
    case 'www.cur.lv':
    case 'in.cur.lv':
    case 'bit.cur.lv':
    case 'go.cur.lv':
    case 'jump.cur.lv':
    case 'link.cur.lv':
    case 'me.cur.lv':
    case 'my.cur.lv':
    case 'n.cur.lv':
    case 'name.cur.lv':
    case 'now.cur.lv':
    case 'to.cur.lv':
        
        $link = coinurl($url);
        
        break;
    
    case 'linkshrink.net':
    case 'www.linkshrink.net':
        
        $link = linkshrink($url);
        
        break;
    
    case 'refso.com':
    case 'www.refso.com':
        
        $link = refso($url);
        
        break;
    
    case 'clk.im':
    case 'www.clk.im':
        
        $link = clkim($url);
        
        break;
    
    default:
        $array = array(
            'Error' => 'Not Supported URL'
        );
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        exit();
}
$time_end       = microtime(true);
$execution_time = ($time_end - $time_start);

$array = array(
    'decodedURL' => $link,
    'ShortURL' => $url,
    'timeTook' => number_format($execution_time, 2)
);

echo json_encode($array, JSON_UNESCAPED_UNICODE);

?>