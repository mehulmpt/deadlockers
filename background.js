chrome.tabs.onUpdated.addListener(function(tabId, changeInfo, tab) {
   chrome.tabs.executeScript(null, {file:'jquery.js'}, function() {
   	chrome.tabs.executeScript(null, {file:'content.js'});
   });
}); 