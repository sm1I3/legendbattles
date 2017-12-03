<div style="text-align:center;font-weight:bold;padding: 0 0 20 0px">Доступно покупок: <?php echo $Fort['market']; ?></div>

<!-- BEGIN empty_block -->
В настойщее время в продаже нет тотемов. Все прежние уже скупили, а новых пока не появилось. Ждем-с... :)
<!-- END empty_block -->

<!-- BEGIN have_articles_block -->
    <table class=tab_no style="width:auto;">
    <!-- BEGIN items_list -->
        <tr>
            <td colspan=2 style="padding:0 4 0 6px; vertical-align:middle;" bgcolor="#DFCC88"><b>{name}</b></td>
        </tr>
        <tr>
            <td style="padding:0 10 20 0px;"><div style="padding:3 3 3 3px;">
				<img src='{STATIC_IMAGES_PATH}/images/wear/{image}'></div>
            </td>
             <td style="padding:5 0 20 0px;">
                    <b>Требования</b>: {requirments_pretty}
                    <div style="padding:0 0 1 0px;"><b>Свойства:</b> {properties_pretty}</div>
					<div style="padding:0 0 1 0px;"><b>Вес:</b> {weight}</div>
					<div style="padding:0 0 1 0px;"><b>Долговечность:</b> {durability_max}</div>
					<div style="padding:0 0 1 0px;"><b>Цена:</b> {price} рак. <a href="?buy={key}" onclick="return confirm('Действительно покупаем {name} за {price} рак.?');">купить</a></div>
            </td>
        </tr>
    <!-- END items_list -->
    </table>
<!-- END have_articles_block -->
