<div class="block skill">
	<div class="header">
		<span>
      Список идущих событий
		</span>
	</div>
<html>
    <head>
        <title>JavaScript показать и скрыть элемент с текстом | Дизайн студия OX2</title>
    </head>
    <body>
        <script type="text/javascript">
            /**
             * Функция Скрывает/Показывает блок
             * @author ox2.ru дизайн студия
            **/
            function showHide(element_id) {
                //Если элемент с id-шником element_id существует
                if (document.getElementById(element_id)) {
                    //Записываем ссылку на элемент в переменную obj
                    var obj = document.getElementById(element_id);
                    //Если css-свойство display не block, то: 
                    if (obj.style.display != "block") {
                        obj.style.display = "block"; //Показываем элемент
                    }
                    else obj.style.display = "none"; //Скрываем элемент
                }
                //Если элемент с id-шником element_id не найден, то выводим сообщение
                else alert("Элемент с id: " + element_id + " не найден!"); 
            }   
        </script>

        <!-- При клике запускаем функцию showHide, и передаем параметр
                id-шник элемента который нужно показать/скрыть -->
	<div class="block skill">
        <a href="javascript:void(0)" onclick="showHide('block_id')"><table class="coll w100 p6h p2v brd2-all" border="0">
<tbody>
<tr class="bg_l">
    <td class="brd2-top b toggleDescription" nowrap="nowrap">Звездный дождь</td>
<td class="brd2-top b track " align="center"></td>
</tr>
</tbody>
</table></a><br/><br/>
        <div id="block_id" style="display: none;">
            <br/>
            <br/>
            Скоро....
        </div>
 
       </body>
</html>