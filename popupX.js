function queryParam(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var oldURL = queryParam('oldURL');
var newURL = queryParam('newURL');
var tTook = queryParam('tTook');

document.getElementById('oldURL').innerHTML = '<b>Current URL:</b> <span title="'+oldURL+'">'+oldURL+'</span>';
document.getElementById('newURL').innerHTML = '<b>Unmasked URL:</b> <span title="'+newURL+'">'+newURL+'</span>';
document.getElementById('tTook').innerHTML = '<b>Time Took:</b> '+tTook+' seconds';

document.querySelector('body').addEventListener('click', function(event) {
  if (event.target.id == 'mainButton') {
	parent.location.href = newURL;
  }
});