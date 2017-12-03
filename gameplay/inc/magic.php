<?php 
$mag_log.=",[[0,\"".date("H:i")."\"]";
if($ina){ 
$arr=explode("@",$ina);
for($i=0; $i<=count($arr)-2; $i++){
$ma=explode("_",$arr[$i]);
$msg=use_b($ma,$player,$psex);$player[hp]=$msg[hp];$player[mp]=$msg[mp];	
it_break($ma[1]);
$mag_log.=",$logpl,$msg[msg]";
}}



if($s['mag']){
$arr=explode("@",$s['mag']);
for($i=0; $i<=count($arr)-2; $i++){
$ma=explode("_",$arr[$i]);
$msg=use_b($ma,$tg,$tsex);$tg[hp]=$msg[hp];$tg[mp]=$msg[mp];	

it_break($ma[1]);
$mag_log.=",$logtg,$msg[msg]";
}}
$mag_log.="]";
savelog($mag_log,$player[battle]);

mysqli_query($GLOBALS['db_link'],'UPDATE user SET mp='.AP.$player[mp].AP.',hp='.AP.$player[hp].AP.' WHERE id ='.AP.$player['id'].AP.'LIMIT 1;');

function use_b($id,$pl,$sex){
if($id[1]!='0'){
	$it=mysqli_fetch_assoc(mysqli_query($GLOBALS['db_link'],"SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype WHERE id_item='$id[1]';"));
	it_break($id);
}
else{$it[num_a]=$id[0];}
if($it['num_a']){
	switch ($it[num_a]) {
		case 32: $pl[hp]+=$it[effect];$msg[msg]="[7,\"Зелье Восстановления $it[effect] HP\",$sex[0]],\".\"";break;
		case 33: $pl[mp]+=$it[effect];$msg[msg]="[7,\" Зелье Восстановления $it[effect] MP\",$sex[0]],\".\"";break;
		case 320: $ma=($pl[hp_all])/2;$maneed=round(($pl[hp_all]-$pl[hp])/2);if($maneed<$ma){$ma=$maneed;}if($ma>$pl[mp]){$ma=$pl[mp];}$pl[hp]+=$ma*2;$pl[mp]-=$ma;$msg[msg]="[7,\"Заклинание Восстановления HP\",$sex[0]],\" и\",[2,".($ma*2).",\"HP\",$sex[0]]";break;
	}
}else{
	$msg[msg]="[7,\"Зелье Восстановления HP, но неудачно\",$sex[0]],\".\"";
}
	if($pl[hp]>$pl[hp_all]){$pl[hp]=$pl[hp_all];}
	if($pl[mp]>$pl[mp_all]){$pl[mp]=$pl[mp_all];}
$msg[hp]=$pl[hp];$msg[mp]=$pl[mp];

return $msg;}

?>