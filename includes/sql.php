<?php

class InitVars {
# ������������ ����� � �������� fff
        var $deny_words = array("union","char","players","from","truncate","table","select","update","drop","delete","benchmark", "order", "limit", "UNION","CHAR", "DROP", "FROM", "SELECT", "UPDATE", "DELETE", "ORDER", "PLAYERS", "TRUNCATE", "LIMIT", "TABLE", "Union","Players","From","Truncate","Table","Select","Update","Char","Drop","Delete","Benchmark","Order","Limit", "or","OR","Or","and","AND","And");

function InitVars() {
}

# ����� ������������ ��������������� ������� $_POST, $_GET � ���������
# �������� : $_GET['psw'] ����� �������������� � $psw � ��� �� ���������
function convertArray2Vars () {

        foreach($_GET as $_ind => $_val) {
                global $$_ind;
                if(is_array($$_ind)) $$_ind = htmlspecialchars(stripslashes($_val));
        }

        foreach($_POST as $_ind => $_val) {
                global $$_ind;
                if(is_array($$_ind)) $$_ind = htmlspecialchars(stripslashes($_val));

        }
}


# ����� ��������� $_GET � $_POST ���������� �� ������� ������� ������ � SQL ��������  
function checkVars() {
        //�������� ������� ������.  
        foreach($_GET as $_ind => $_val) {
                        $_GET[$_ind] = htmlspecialchars(stripslashes($_val));

                        $exp = explode(" ",$_GET[$_ind]);
                        foreach($exp as $ind => $val) {
                                if(in_array($val,$this->deny_words)) $this->antihack("���������!������ ������!<br>");
                        }
        }

        foreach($_POST as $_ind => $_val) {
                        $_POST[$_ind] = htmlspecialchars(stripslashes($_val));

                        $exp = explode(" ",$_POST[$_ind]);
                        foreach($exp as $ind => $val) {
                                if(in_array($val,$this->deny_words)) $this->antihack("���������!������ ������!<br>");
                        }
        }

}
} 
?>