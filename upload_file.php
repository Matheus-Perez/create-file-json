<?php
require_once "functions.php";

//-- DELETO OS ARQUIVOS
deleteDirectories("generete_json/");
deleteZip("generete_json");
$ext = "";
//-- PEGO OS ARQUIVOS
if(!empty($_FILES))
{
    $file=$_FILES['filename'];
    //-- EXPAND THE FILE TO CHECK IF IT IS A VALID FILE
    $ext=substr($file['name'],strrpos($file['name'],'.'));
}
//-- VERIFICO SE A EXTENSÃO DO ARQUIVO É VALIDA
if($ext !=".csv")
{die("Please select a valid file! (CVS)");}//IF

//-- CAMINHO DO ARQUIVO
$dirFile = $_FILES['filename']['tmp_name'];

//-- ABRO  O ARQUIVO
$handle = fopen($dirFile, "r");
$fileName = "file.json";//-- FILE NAME
//-- CRIO O ARRAY AONDE VAI MONTAR A PRIMEIRA PARTE DOS ARQUIVOS
$array_json = array();
//-- PASSA TODAS AS LINHAS PARA O ARRAY
while (($data = fgets($handle, 4096)) !== false)
{
    $line   =  explode(";", $data);
    $void = 0;
    //-- RETIRA ESPACO E COLOCA UTF8 NOS CAMPOS
    for($i=0;$i < count($line); $i++)
    {
        $line[$i] = trim(utf8_encode($line[$i]));
        if(empty( $line[$i]))
        {$void++;}
    }//-- END FOR

    ///-- SE TODAS AS LINHAS TIVEREM VAZIAS ELE NAO IRA ADICIONAR NO ARRAY
    if($void != count($line))
    {
        array_push($array_json,$line);
    }
}//-- WHILE

//-- CONFIGURAÇÕES PARA MONTAR O ARQUIVO JSON
$row = count($array_json);
$columnRow = count($array_json[0]);
$isSub = false;
$directoryNames = array();

//-- VERIFICO QUANTAS COLUNAS TEM SE FOR MAIOR QUE 2 GERO PASTAS PARA CADA CLUNA
if($columnRow > 2)
{
    $p = 1; //-- DECIDE EM QUE POSIÇÃO VAI COMECAR
    //-- CRIA  AS PASTAS
    for($c=1;$c < $columnRow; $c++)
    {
        $column = $array_json[0][$c];
        $dir = __DIR__."/generete_json/$column";
        //-- CRIA A ESTRUTURA INCIAL (PASTA E ARQUIVOS)
        creatDirectories($dir, $column, $fileName);
        array_push($directoryNames,$column);
    }
}//-- END IF
else
{

    $p = 0; //-- DECIDE EM QUE POSIÇÃO VAI COMECAR
    $column = "json";
    $dir = __DIR__."/generete_json/$column";
    //-- CRIA A ESTRUTURA INCIAL (PASTA E ARQUIVOS)
    creatDirectories($dir, $column, $fileName);
    array_push($directoryNames,$column);
}//-- END ELSE

/*=========================================VALIDA SE TEM DADOS*/
//-- MONTO O ARQUIVO
for($i=$p; $i < $row; $i++)
{

    //-- DECLARO VARIAVEIS
    $keyName    = $array_json[$i][0];//-- NOME DA CHAVE
    $keys = "";
    $txt    = "";

    //-- VERIFICA SE ESSA LINHA ABRE OU FECHA A CHAVE
    if($array_json[$i][1] == "{")
    {
        $isSub = true;
        $keys = "{";
    }
    else if($array_json[$i][1] == "}" && $isSub == true)//-- SE JA CHAVE JA ESTIVER ABERTA
    {
        $isSub = false;
        $keys = "}";
        $keyName = "}";
    }//-- END IF ELSE
    else
    {$keys = "";}//-- END ESLE

    //-- MONTO OS TEXTO DE ACORDO COM SUA COLUNA
    for($r=1;$r < $columnRow; $r++)
    {
        $value = $array_json[$i][$r];
        $comma = "";

        //-- VERIFICO A LINHA PRECISA DE VIGULA
        if($i != $row -1)
        {
            if(!$isSub)//-- SE NAO FOR SUB ELE SOMENTE INSERE VIRGULA
            {
                $comma = ",";
            }//-- IF
            else//-- SE FOR VIGULA ELE VERIFICA SE É O ULTIMO ELEMENTO DO ITEM
            {
                //-- VERIFICO SE O PROXIMO VAI FECHAR A SUB CHAVE
                $nexValue = $array_json[$i+1][1];

                if($nexValue != "}")
                {
                    $comma = ",";
                }//-- IF
            }//-- ELSE
        }//-- if
        else
        {$comma = "}";}//-- END ELSE

        //-- ESCREVE NO ARQUIVO JSON DE ACORDO COM SUA PASTA
        $dir = __DIR__."/generete_json/".$directoryNames[$r-1]."/".$fileName;//-- $r-1 é porque o index  são diferentes

        //-- SE TIVER A CHAVES ELE SUBISTITUI O TEXTO ORIGIAL
        if(empty($keys))
        {
            $txt = '"'.$keyName.'": "'.$value.'"'.$comma."\n";//-- CASO NÃO TENHA CHAVES
        }//-- IF
        else if ($keys == "{")
        {
            $txt = '"'.$keyName.'":'.$keys.''."\n";//-- ABRE A CHAVE NO ARQUIVO
        }//-- ELSE IF {
        else if ($keys == "}")
        {
            //-- VERIFICA SE ESTA É A ULTIMA LINHA DO ARQUIVO, SE FOR ELE FECHA O ARQUIVO
            if($i == $row -1)
            {$txt = $keys."\n }";}
            else//-- SE NAO FOR O ULTIMO ELE SOMENTE FECHA A SUBCHAVE E COLOCA VIRGULA
            {$txt = $keys.", \n";}
        }//-- ELSE IF }
        fileEdit($dir,"a",$txt);
    }//-- END FOR COLUMN
}//-- FOR

$arr = array("result" => true);
$jsonObj = json_encode($arr);
echo $jsonObj;
return;

?>