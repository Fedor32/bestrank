$( document ).ready(function() {

	// Фомирование случайного числа для короткой ссылки
	$('.urlform-button').click(function(){
		var mes = $('#longurl').val();
		$.ajax({type:'POST',url:'ajax.php',data: 'action=newurl&url='+mes,cache: false,
			success:function(data){
				if(data[0] == ':') {
					data = data.slice(1);
					$('.newurlink').css('display','none');
				} else {
					$('#newurlink').attr('newurl',data);
					$('.newurlink').css('display','block');
					data = location.href.replace('/#', '') + '/' + data;
				}
				$('#newurl').val(data);
			}
		});
	});

	// запись короткой ссылки в базу и переход
	$('#newurlink').click(function(){

		var nurl = $('#newurlink').attr('newurl');
		var surl= $('#longurl').val();

		$.ajax({type:'POST',url:'ajax.php',data: 'action=saveurl&nurl='+nurl+'&surl='+surl,cache: false,
			success:function(data){
				window.location.replace(location.href.replace('/#', '') + '/' + nurl);
			}
		});

	});

});