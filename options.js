function save_options() {
  var option1 = $('input[name="link"]:checked').val();
  chrome.storage.sync.set({
    option: option1,
  }, function() {
	$('#updated').stop().animate({
		top: 0
	}, 500, function() {
		$('#updated').delay(2000).animate({
			top: '-100px'
		});
	});
  });
}

function restore_option() {
$('input[name="link"]').eq(0).prop('checked',true);
$('input[name="ads"]').eq(0).prop('checked',true);
  chrome.storage.sync.get('option', function(items) {
	for(i=0;i<$('input[name="link"]').length;i++) {
    if($('input[name="link"]').eq(i).val() == items.option) {
		$('input[value="'+items.option+'"]').prop('checked',true);
		break;
	}
	}

  });
}

$(function() {
restore_option();
$('#updateBtn').click(function() { save_options(); });
});