<?php
define('DROOT',$_SERVER["DOCUMENT_ROOT"]);
$db_link = 0;
$db_link = mysqli_connect('localhost','34','34','34');     
if (mysqli_connect_errno()) { 
   printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
}
mysqli_query($GLOBALS['db_link'],"SET NAMES cp1251");
function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
} 

$redirect="parent.frames['main_top'].location='main.php';";
$quit="parent.location='index.php';";
  // �������� ����
  @DEFINE('AP','\'');

  function redirect($url)
  {
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL='.$url.'">';
    die;
  }


function goto_error($err_text)
  {
    echo '<br><b>����� �������: </b><br>'.$err_text.'<br><INPUT TYPE="button" VALUE="�����" onClick="history.back()">';
    die;
  }

  // ��������� ���������� � ����� ������, ��������� ������������ ��������,
  // ����� ���������� ���� ������� ��������� ���
  function db_open()
  { // ��������� ���������� � ����� ������
    global $db_link;
    if($db_link==0) // ��������, ����-�� ���������� ��� �������... ����� ������
    {
      $db_link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or goto_error(mysqli_error());
      //mysqli_select_db(DB_NAME) or goto_error(mysqli_error());
    }
	mysqli_query($GLOBALS['db_link'],"SET NAMES cp1251");
  }

  // �������� ������ � ���� ������
  function db_query($str)
  { // ��������� ������ ���� ������
    global $db_result;
    $db_result = mysqli_query($GLOBALS['db_link'],$str) or goto_error(mysqli_error());

  }

  // ������������ ��������� �������
  function db_fetch()
  { // ����� ������...
    global $db_result;
    $str = mysqli_fetch_assoc($db_result);
    return $str;

  }
 function db_quer($table,$filter)
    { $str='SELECT * FROM '.$table.' WHERE '.$filter;
	//echo $str;
    $db_result = mysqli_query($GLOBALS['db_link'],$str) or goto_error(mysqli_error());
	$str2 = mysqli_fetch_assoc($db_result);
    return $str2;

  }


  // ������������ ������� ��� ��������� ��������
  function db_query2($str){global $db_result2; $db_result2 = mysqli_query($GLOBALS['db_link'],$str) or goto_error(mysqli_error());}
  function db_fetch2(){global $db_result2; $str = mysqli_fetch_assoc($db_result2, mysqli_ASSOC); return $str; }


  // ��������� �����������-�� ������������ � ����..
  // ���� ��, �� ���������� ��� ������������
  function check_auth()
  { global $my;
    if(isset($_COOKIE[cookname]))
    {
      $my['pass'] = $_COOKIE[cookname];
    }else{
      goto_error_global('�� �� ������������ � ����!');
  } }

  // ������� �������� ������� ��������� ���������
  function getmicrotime()
  {
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
  }
function scode()
{
$cod=md5(rand(100,10000));
$_SESSION['secur'][]=$cod;
return $cod;
}
?>