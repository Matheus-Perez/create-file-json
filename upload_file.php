<?php
require_once "functions.php";

//-- DELETE FILES
deleteFiles("file_json/");
deleteZip("file_json");

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
{die("Please select a valid file! (CVS)");}//IF

//-- CSV FILE PATH
$dirFile = $_FILES['filename']['tmp_name'];

//-- QUANTITY OF LINES THAT THIS FILE
$qtdLine = file($dirFile);
$qtdLine = count($qtdLine);

//-- OPEN CSV FILE
$handle = fopen($dirFile, "r");
$fileName = "file.json";//-- FILE NAME

//-- CREATE THE INITIAL DIRECTORY
$dir = __DIR__."/file_json/$fileName";
//-- CREATE THE INITIAL FILE
fileEdit($dir,"a","{\n");
$i = 0;
//-- MOUNT THE JSON FILE
while (($data = fgets($handle, 4096)) !== false)
{
    $i++;
    //-- TRANSFORM IN AN ARRAY
    $line =  explode(";", $data);

    //-- CHECK IF THE VARIABLE IS EMPTY
    if(!empty($line[0]))
    {
        //-- ADD A COMMA IF IT WERE NOT FOR THE LAST LINE
        if($i != $qtdLine)
        {$v = ", \n";}else{$v = " \n }";}

        //-- AMOUNT THE TEXT TO BE INSERTED IN THE FILE
        $txt = '"'.trim($line[0]).'": "'.trim(utf8_encode($line[1])).'"'.$v;

        //-- EDIT FILE JSON
        fileEdit($dir,"a",$txt);
    }

}

$arr = array("result" => true, "file" => "file_json");
$jsonObj = json_encode($arr);
echo $jsonObj;
return;

?>