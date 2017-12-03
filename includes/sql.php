<?php

class InitVars {
# Недопустимые слова в запросах fff
        var $deny_words = array("union","char","players","from","truncate","table","select","update","drop","delete","benchmark", "order", "limit", "UNION","CHAR", "DROP", "FROM", "SELECT", "UPDATE", "DELETE", "ORDER", "PLAYERS", "TRUNCATE", "LIMIT", "TABLE", "Union","Players","From","Truncate","Table","Select","Update","Char","Drop","Delete","Benchmark","Order","Limit", "or","OR","Or","and","AND","And");

function InitVars() {
}

# Метод конвентирует суперглобальные массивы $_POST, $_GET в перемнные
# Например : $_GET['psw'] будет переобразовано в $psw с тем же значением
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


# Метод проверяет $_GET и $_POST переменные на наличие опасных данных и SQL инъекций  
function checkVars() {
    //Проверка опасных данных.
        foreach($_GET as $_ind => $_val) {
                        $_GET[$_ind] = htmlspecialchars(stripslashes($_val));

                        $exp = explode(" ",$_GET[$_ind]);
                        foreach($exp as $ind => $val) {
                            if (in_array($val, $this->deny_words)) $this->antihack("Запрещено!Доступ закрыт!<br>");
                        }
        }

        foreach($_POST as $_ind => $_val) {
                        $_POST[$_ind] = htmlspecialchars(stripslashes($_val));

                        $exp = explode(" ",$_POST[$_ind]);
                        foreach($exp as $ind => $val) {
                            if (in_array($val, $this->deny_words)) $this->antihack("Запрещено!Доступ закрыт!<br>");
                        }
        }

}
} 
?>