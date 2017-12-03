<?php
require('kernel/before.php');

if (!userHasPermission(1)) {
    header('Location: index.php');
    die();
}
if (isset($_GET['message_id']) || is_numeric($_GET['message_id']))
    $message_id = intval($_GET['message_id']);
else
    header('Location: sendmail_list.php');
?>
<script src="/js/jquery.min.js" language="javascript"></script>
<script>
function nextStep(page){
	$.ajax({
		url: "./ajax_control/sendmail_ajax.php?message_id=<?php echo $message_id; ?>&p=" + page,
		type: "GET",
		cache: false,
		dataType: "json",
		success: function( data ) {
			if( data.status == 'progress'){
				$('#pocess').html(Math.round((100/data.maxpage)*data.thispage) + '%');
				nextStep(data.thispage + 1);
			}else if( data.status == 'success'){
				$('#pocess').html('<font color="green">100%</font>');
				$('#status').html('<font color="green"><b>Все сообщения отправлены</b></font>');
			}else{
				$('#pocess').html('<font color="red">Error</font>');
				$('#status').html('<font color="red">Неизветсная ошибка</font>');
			}
		}
	});
}
$( document ).ready(function() {
	nextStep(1);
});
</script>
<div id="pocess" style="text-align:center;">0%</div>
<div id="status" style="text-align:center;">Loading...</div>
<?php
require('kernel/after.php');