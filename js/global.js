$(document).ready(function(){
	$('#menu .buttons span').hover(function(){
		var bid = $(this).attr('class');
		$('#menu .buttons span > .drop.d'+bid).show();
		$('#menu .buttons span > .drop.d'+bid+' .droparea').slideDown('fast');
	}, function() {
		$('#menu .buttons span > .drop, #menu .buttons span > .drop .droparea').hide();
	});
	$("#screens").easySlider({
		auto: true,
		continuous: true,
		speed:2000, pause:5000
	});
});

function openRegister() {
	$('#modal .image').html("<span id='modalb'><h1>�����������</h1><form name='formRegister' onSubmit='RegFormSubmit();return false;'><label class='formpadrao'><div class='desc'>�����:</div><div class='camp'><input type='text' name='login' id='login' maxlength='21' value='' autocomplete='off' /></div></label><label class='formpadrao'><div class='desc'>��� ���:</div><div class='camp'><select name='sex' id='sex' style='width: 214px;height:30px;'><option value=n>��������</option><option value=male>-- �������</option><option value=female>-- �������</option></select></div></label><label class='formpadrao'><div class='desc'>��� e-mail:</div><div class='camp'><input type='text' name='email' id='email' maxlength='30' value='' autocomplete='off' /></div></label><label class='formpadrao'><div class='desc'>���� ��������:</div><div class='camp'><input type='text' name='bdate' id='bdate' maxlength='16' value='' autocomplete='off' placeholder='��.��.����' /></div></label><br /><div align='center'><input type='button' class='wgsubmit' value='����������' onclick='RegFormSubmit();' /></div></form></div>");
//	$('#modal .image').html("<span id='modalb'><h1>�����������</h1><div align='center'><iframe width='450' height='216' frameborder='0' allowfullscreen='' src='/reg.php'></iframe></div></div>");
	
	$("#bdate").placeholder();
    $("#bdate").mask('99.99.9999');
	
	var tmargin = parseInt(($(window).height() - 364)/2);
	var lmargin = parseInt(($(window).width() - 520)/2);
	$('#modal').animate({ 'margin-top': tmargin+'px', 'margin-left': lmargin+'px' }, 1);
	$('#modal').fadeIn('fast');
	$('#backblack').fadeIn('fast');
}

function openLostPassword() {
	$('#modal .image').html("<span id='modalb'><h1>������ ������?</h1><form name='formLostPassword' onSubmit='LostFormSubmit();return false;'><label class='formpadrao'><div class='desc'>�����:</div><div class='camp'><input type='text' name='login' id='login' maxlength='24' value='' autocomplete='off' /></div></label><label class='formpadrao'><div class='desc'>��� e-mail:</div><div class='camp'><input type='text' name='email' id='email' maxlength='35' value='' autocomplete='off' /></div></label>��� �������������� �� ����������� ��������� �����<br /><div align='center'><input type='button' class='wgsubmit' value='����������' onclick='LostFormSubmit();' /></div></form></div>");
	var tmargin = parseInt(($(window).height() - 364)/2);
	var lmargin = parseInt(($(window).width() - 520)/2);
	$('#modal').animate({ 'margin-top': tmargin+'px', 'margin-left': lmargin+'px' }, 1);
	$('#modal').fadeIn('fast');
	$('#backblack').fadeIn('fast');

}
function openLogin() {
	$('#modal .image').html("<span id='modalb'><h1>���� � ����</h1><div align='center'><form name='openLogin' action='http://www.legendbattles.ru/world.php' method='POST'><input type='submit' style='height:0;width:0;overflow:hidden;position:absolute;border:0;'><div style='position:relative;width:179px;left:-6px;'><input autocomplete='off' class='ucpinput' onfocus=\"if(this.value=='�����')this.value=''\" onblur=\"if(this.value=='')this.value='�����'\" type='text' name='player_nick' value='�����' /><br /><input autocomplete='off' class='ucpinput' id=\"temp_2\" onfocus=\"this.style.display = 'none'; getElementById('real_2').style.display = 'inline'; getElementById('real_2').focus();\" type='text' name='' value='������' /><input autocomplete='off' class='ucpinput' style=\"display:none\" id=\"real_2\" onblur=\"if(this.value == '') {getElementById('temp_2').style.display = 'inline'; this.style.display = 'none';}\" type='password' name='player_password' value='' /><div class='ucpicon icon1'></div><div class='ucpicon icon2'></div></div></form><script type=\"text/javascript\" src=\"//ulogin.ru/js/ulogin.js\"></script><div align=\"center\" style=\"height:16px;\"><div id=\"uLogin[2]\" data-ulogin=\"verify=1;display=small;fields=first_name,last_name,email,nickname,photo,bdate,sex,city,country;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http%3A%2F%2Fwww.legendbattles.ru%2Fworld.php%3Fact%3DuLogin\"></div></div><input type='button' class='wgsubmit' value='�����' onclick='document.openLogin.submit();' /></div></div>");
	var tmargin = parseInt(($(window).height() - 364)/2);
	var lmargin = parseInt(($(window).width() - 520)/2);
	$('#modal').animate({ 'margin-top': tmargin+'px', 'margin-left': lmargin+'px' }, 1);
	$('#modal').fadeIn('fast');
	$('#backblack').fadeIn('fast');
}

// PostForms
function RegFormSubmit(){
	var ReponseText = '';
	$.ajax({
		type: "POST",
		url: "/modules/reg/ajax_reg.php",
		cache: false,
		data: { 
			"reg-user" : $("#login").val(),
			"reg-email" : $("#email").val(),
			"reg-bdate" : $("#bdate").val(),
			"reg-sexuser" : $("#sex").val()
		},
		success: function(response){
			if(response === 'OK'){
				GlobalMSG('�����������','����������� ������ �������, �� ���� ����������� ����� ��������� ������� ������.');
			}else{
				response = response.split('@');
				switch(response[1]){
					case'1':
						ReponseText = '������! ������� ���������� �����.';
					break;
					case'2':
						ReponseText = '������! ����� �������� ������������ �������.';
					break;
					case'3':
						ReponseText = '������! ����� ��� �����.';
					break;
					case'4':
						ReponseText = '������! ������� ���������� E-mail.';
					break;
					case'5':
						ReponseText = '������! ������� ���� ��������.';
					break;
					case'6':
						ReponseText = '������! ������� ���� ���.';
					break;
					case'7':
						ReponseText = '������! � ����� IP-������ ��� ��� ��������������� ��������!<br> ���������� ��������� ������� ����� 24 ����.';
					break;
				}
				GlobalMSG('������',ReponseText);
			}			
 		}
	});
}

function LostFormSubmit(){
	var ReponseText = '';
	$.ajax({
		type: "POST",
		url: "/modules/reg/ajax_lost.php",
		cache: false,
		data: { 
			"lost-user" : $("#login").val(),
			"lost-email" : $("#email").val()
		},
		success: function(response){
			if(response === 'OK'){
				GlobalMSG('�������������� ������','�� ���� ����������� ����� ��������� ����� ������� ������.');
			}else{
				response = response.split('@');
				switch(response[1]){
					case'1':
						GlobalMSG('�������������� ������','������! �������� ��������� ������ � E-mail.');
						//ReponseText = '������! �������� ���t����� ������ � E-mail.';
					break;
					case'2':
						GlobalMSG('�������������� ������ - '+response[2],'������! ������������ �� ������ ��� �� ������� ��� ��������������� ������.<br> ��������� �������������� ������ ����� �� �����, ��� 1 ��� � �����.');
						//ReponseText = '������! ������������ �� ������ ��� �� ������� ��� ��������������� ������.<br> ��������� �������������� ������ ����� �� �����, ��� 1 ��� � �����.';
					break;
				}
				//alert(ReponseText);
			}			
 		}
	});
}

// Function SystemOk
function GlobalMSG(title,msg){
	$('#modal .image').html("<span id='modalb'><h1>"+title+"</h1><p>"+msg+"</p></div>");
	var tmargin = parseInt(($(window).height() - 200)/2);
	var lmargin = parseInt(($(window).width() - 520)/2);
	$('#modal').animate({ 'margin-top': tmargin+'px', 'margin-left': lmargin+'px' }, 1);
	$('#modal').fadeIn('fast');
	$('#backblack').fadeIn('fast');
}