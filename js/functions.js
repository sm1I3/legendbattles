				DDAdd = function(){
					var ddpar = $('#basic-modal-content').contents().find('#params').val();
					var ddsum = $('#basic-modal-content').contents().find('#sum').val();
					var tp = $('#basic-modal-content').contents().find('#type').val();
					var str = $('#basic-modal-content').contents().find('#parstr').val();
					$('#basic-modal-content').html('Loading...');
					$.get("/gameplay/ajax/addparams.php", { params: ddpar, sum: ddsum, type: tp, string: str }, function(data){
						$('#basic-modal-content').html(data);
					});
				}