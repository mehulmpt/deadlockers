//'use strict';
var sites = ['ay.gy', 'adf.ly', 'adfoc.us', 'sh.st', 'bc.vc', 'ilix.in', 'j.gs', 'q.gs', 'linkbucks.com', 'any.gs', 'cash4links.co', 'cash4files.com', 'dyo.gs', 'filesonthe.net', 'goneviral.com', 'megaline.co', 'miniurls.co', 'seriousdeals.net', 'theseblogs.com', 'theseforums.com', 'tinylinks.co', 'tubeviral.com', 'ultrafiles.net', 'urlbeat.net', 'whackyvidz.com', 'qqc.co', 'yyv.co', 'allanalpass.com', 'amy.gs', 'deb.gs', 'drstickyfingers.com', 'fapoff.com', 'freean.us', 'freegaysitepass.com', 'galleries.bz', 'hornywood.tv', 'linkbabes.com', 'picbucks.com', 'poontown.net', 'sexpalace.gs', 'tnabucks.com', 'youfap.me', 'rqq.co', 'zff.co', 'cur.lv', 'www.cur.lv', 'in.cur.lv', 'bit.cur.lv', 'go.cur.lv', 'jump.cur.lv', 'link.cur.lv', 'me.cur.lv', 'my.cur.lv', 'n.cur.lv', 'name.cur.lv', 'now.cur.lv', 'to.cur.lv', 'linkshrink.net', 'refso.com', 'clk.im'];
var popupActive = 0;
var url = document.domain.replace('www.', '');
var i = '';
$(function() {
    for (i in sites) {
        if (document.domain == 'sh.st') {
            var adSession = document.querySelector('body').innerHTML.match("sessionId: \"(.*)\"")[1];
            var urlX = 'http://sh.st/shortest-url/end-adsession?adSessionId=' + adSession + '&adbd=1&callback=reqwest_' + (+new Date);


            var intV = setInterval(function() {
                console.log('running');
                $.ajax({
                    dataType: 'text',
                    url: urlX
                }).done(function(x) {
                    x = x.split('({').pop();
                    x = x.split('});')[0];
                    x = '{' + x + '}';
                    x = JSON.parse(x);

                    if (x.destinationUrl != "") {
                        chrome.storage.sync.get('option', function(items) {
                            var cc = items.option;
                            if (cc == 'val1' || !cc || cc === undefined || typeof(c) == undefined) {
                                showPopup(x.destinationUrl, document.location.href, 0);
                            } else {
                                $('body').html('Redirection In Progress (deadlocker)');
                                location.href = x.destinationUrl;
                            }
                        });
                        clearInterval(intV);
                    }
                });

            }, 400);



        } else if (sites[i] == url) {
            $.ajax({
                headers: {
                    'Connection_': 'close'
                },
                url: 'http://projects.codedamn.com/deadlockers/api.php?url=' + location.href
            }).done(function(res) {
                if (!!!res.decodedURL) {
                    // rest in peace
                } else {
                    chrome.storage.sync.get('option', function(items) {
                        var cc = items.option;
                        if (cc == 'val1' || !cc || cc === undefined || typeof(c) == undefined) {
                            showPopup(res.decodedURL, url, res.timeTook);
                        } else {
                            $('body').html('Redirection In Progress (deadlocker)');
                            location.href = res.decodedURL;
                        }
                    });
                }
            });
        }
    }

    function showPopup(urlX, urlY, t) {
        if (document.querySelector('#customIFRAMEbyDeadLOCkERsSs') == null) {
            $("*:not(iframe)").unbind("click");
            $("[onclick]").removeAttr("onclick");
            window.onbeforeunload = function() {
                return null;
            };
            var iframeURL = chrome.extension.getURL('popupY.html');
            var iframe = '<iframe src="' + iframeURL + '?oldURL=' + urlY + '&newURL=' + urlX + '&tTook=' + t + '" id="customIFRAMEbyDeadLOCkERsSs" style="z-index:9999999999999;position:fixed;top:0;left:0;width:100%;height:100vh;border:0;"></iframe>';
            $('body').append(iframe);
            popupActive = 1;
        }
    }
});