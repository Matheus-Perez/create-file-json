<?php
require_once "functions.php";

// -- DELETE FILES
deleteDirectories("translate/");
deleteZip("translate");
$ext = "";

//-- VARIABLE DECLARATION
if(!empty($_FILES))
{
    $file=$_FILES['filename'];

    //-- EXPAND THE FILE TO CHECK IF IT IS A VALID FILE
    $ext=substr($file['name'],strrpos($file['name'],'.'));
}
//-- IF THE FILE DOES NOT FOR A VALID EXTENSION IT ALREADY NOTICES TO THE USER
if($ext !=".csv")
{
    die("Por favor, selecione um arquivo valido!(CVS)");
}//IF

//-- CSV FILE PATH
$dirFile = $_FILES['filename']['tmp_name'];

//-- QUANTITY OF LINES THAT THIS FILE
$qtdLine = file($dirFile);
$qtdLine = count($qtdLine);

//-- OPEN CSV FILE
$handle = fopen($dirFile, "r");
/**** GET TO FIRST LINES THAT ARE CONFIGURATIONS ****/

//-- GET THE FILE NAME
$lineOne = fgets($handle, 4096);
$name = explode(";", $lineOne);
$fileName = $name[1].".json";//-- FILE NAME

//-- GET THE COLUMNS TO CREATE THE PASTA
$lineTwo= fgets($handle, 4096);
$columns = explode(";", $lineTwo);
$count = count($columns);

//-- CREATE THE TRANSLATION PASTES ACCORDING TO THE CREATED COLUMNS
for($i = 1; $i < $count-1; $i++)
{
    $dir = __DIR__."/translate/".$columns[$i];
    //-- VERIFICO SE A COLUNA NÃO ESTA VAZIA OU SE O ARQUIVO EXISTE
    if($columns[$i] != "" || file_exists($dir))
    {@mkdir($dir,0777);}//-- CRIO OS DIRETORIOS

    //-- CRIO OS ARQUIVOS JSON
    fileEdit($dir."/$fileName","a","{\n");
}//-- END FOR

//-- VARIABLE OF ERROR
$isError = false;
//--- AMOUNT THE JSON FILES ACCORDING TO EACH LANGUAGE (COLUMN)
for($i = 2; $i < $qtdLine; $i++)
{
    //-- GET THE VALUE OF CURRENT POINT IN CURRENT
    $data = fgets($handle, 4096);
    //-- TRANSFORM IN AN ARRAY
    $line =  explode(";", $data);
    //-- VALID IF YOU ERROR OR NOT
    if($line[0] == "error"){$isError = true;}

    //-- DO NOT ADD THE VIRGULATE IF THE SAME WAS THE LAST ITEM
    if($i != $qtdLine-1 )
    {$v = ",";}
    else if($i == $qtdLine-1 && $isError == true)
    {$v=" \n } \n }";}
    else{$v=" \n }";}

    //-- MOUNT THE FILES ACCORDING TO THE COLUMNS
    for($d = 1; $d < $count-1; $d++)
    {
        //-- CHECK THIS LINE IS NOT EMPTY
        if($line[0] != "")
        {
            //-- PATH OF FILES
            $dir = "translate/".$columns[$d]."/".$fileName;

            //-- CHECK IF THE SELECTED LINE IS THE ERROR LINE
            if($line[0] == "error")
            {
                //-- VERIFY IF THAT ERROR LINE IS THE LAST
                if($i == $qtdLine-1 ){$virg1=" \n } \n }";}else{$virg1= "";}

                //-- AMOUNT THE TEXT TO BE INSERTED IN THE FILE
                $txt = '"error": {'."\n $virg1";
            }
            else
            {
                //-- AMOUNT THE TEXT TO BE INSERTED IN THE FILE
                $txt = '"'.trim($line[0]).'": "'.trim(utf8_encode($line[$d])).'"'.$v."\n";
            }
            //-- EDITING THE JSON FILE
            fileEdit($dir,"a",$txt);
        }//-- END IF
    }//-- END FOR
}//-- END FOR DO CORPO DO CSV


$arr = array("result" => true, "file" => "translate");
$jsonObj = json_encode($arr);
echo $jsonObj;
return;





?>