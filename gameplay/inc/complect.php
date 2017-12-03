<?
if($post_id==2){
$q = mysqli_query($GLOBALS['db_link'],'SELECT invent.*, items.* FROM items INNER JOIN invent ON items.id = invent.protype  WHERE used='.AP.'1'.AP.' and pl_id='.AP.$player[id].AP.'');
while ($row = mysqli_fetch_assoc($q)) {
	$ids .= "@$row[id_item]";
	$slots .= "@$row[curslot]";
}
$cname=chars($cname);
$q = mysqli_query($GLOBALS['db_link'],'SELECT * FROM pcompl WHERE uid='.AP.$player[id].AP.'');
while ($r = mysqli_fetch_assoc($q)) {
if($r['name']==$cname){$i+=1;}
} 
if($ids!='' and $slots!='' and $i==0 and $cname!=''){
mysqli_query($GLOBALS['db_link'],'INSERT INTO pcompl(uid,name,ids,slots) VALUES('.AP.$player[id].AP.','.AP.$cname.AP.','.AP.$ids.AP.','.AP.$slots.AP.')');$msg='<b><font class=nickname><font color=#cc0000>Комплект "'.$cname.'" сохранен!</font></font></b><br>';}
if($ids!='' and $slots!='' and $i!=0 and $cname!=''){
mysqli_query($GLOBALS['db_link'],'UPDATE pcompl SET ids='.AP.$ids.AP.', slots='.AP.$slots.AP.' WHERE  uid='.AP.$player[id].AP.' and name='.AP.$cname.AP.';');$msg='<b><font class=nickname><font color=#cc0000>Комплект "'.$cname.'" заменен!</font></font></b><br>';}}

if($post_id==4){
mysqli_query($GLOBALS['db_link'],'UPDATE invent SET used='.AP.'0'.AP.', curslot='.AP.'0'.AP.' WHERE used='.AP.'1'.AP.' and pl_id='.AP.$player[id].AP.';');
$q = mysqli_query($GLOBALS['db_link'],'SELECT * FROM pcompl WHERE uid='.AP.$player[id].AP.' and id='.AP.$key.AP.' LIMIT 1;');
$row = mysqli_fetch_assoc($q);
$exp_id = explode('@',$row['ids']);
$exp_slots = explode('@',$row['slots']);
for($i=1;$i<count($exp_id);$i++){
	$slot=$exp_slots[$i];
	$id=$exp_id[$i];
	mysqli_query($GLOBALS['db_link'],'UPDATE invent SET used='.AP.'1'.AP.', curslot='.AP.$slot.AP.' WHERE id_item='.AP.$id.AP.' and dolg-iznos>1  and pl_id='.AP.$player[id].AP.' AND bank="0" LIMIT 1;');
}
calcstat($player[id]);
testcompl();
}



?>