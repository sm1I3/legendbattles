<?
//Боты на природе.
list($x, $y ) = split("_", $player[pos], 2);

if($x!=1000 && $y!=1000)
{ 

	if ($player['fight']==0)
	{
		if ($player['lastbattle']==0)
		{
			mysqli_query($GLOBALS['db_link'],"UPDATE user SET lastbattle=".AP.time().AP." WHERE login=".AP.$_SESSION['user'][login].AP."");
			$lb=$player['lastbattle'];
		}
		else
		{
			$lb=$player['lastbattle'];
		}
		if ($lb+10<time())
		{
            mysqli_query($GLOBALS['db_link'],"LOCK TABLES user READ, user WRITE;");
            if(mysqli_num_rows(mysqli_query($GLOBALS['db_link'],"SELECT * FROM user WHERE fight='0' AND type=3;"))>0)
            {
            $kb=rand(1,$player['level']);
            $fid=newbattle(2,$player['loc'],1,time(),300,100,0,0,0,0,0,0,0,1);
            switch($kb)
            {
            case 1:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 1;');
            break;
            case 2:
            dmysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 2;');
            break;
            case 3:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 3;');
            break;
            case 4:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 4;');
            break;
            case 5:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 5;');
            break;
            case 6:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 5;');
            break;
            case 7:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 5;');
            break;
            case 8:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 5;');
            break;
            case 9:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 5;');
            break;
            case 10:
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="2",hp=hp_all,mp=mp_all WHERE fight=0 AND type=3 ORDER by rand() LIMIT 5;');
            break;
            }
            save_hp_roun($player);
            mysqli_query($GLOBALS['db_link'],'UPDATE user SET battle='.AP.$fid.AP.',side="1",hp='.AP.$fid.AP.' WHERE login='.AP.$_SESSION['user']['login'].AP.'LIMIT 1;');
            mysqli_query($GLOBALS['db_link'],"UPDATE user SET lastbattle=".AP.time().AP." WHERE login=".AP.$_SESSION['user'][login].AP."");
            startbat($fid,2);
			
			}	
        }
    }
 }
 ?>	