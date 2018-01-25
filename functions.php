<?php
//-- GET ERRORS PHP
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

//-- FILL IN THE TEXT FILE
function fileEdit($dir,$mode, $text)
{
    $fp =  fopen($dir,$mode);
    //-- WRITE ON THE LAST LINE OF THE JSON FILE...
    fwrite($fp, $text);
    //-- CLOSE FILE
    fclose($fp);
}//-- fileEdit

//-- DELL DIRECTORIES
function deleteDirectories($dir)
{
    //-- OPEN DIRECTORIES
    $ponteiro  = opendir($dir);
    $c = 0;
    //-- I SEND ALL SUB DIRECTORIES TO BE ABLE TO DELETE
    while ($dirName = readdir($ponteiro))
    {
        $c++;
        //-- GET ONLY OF THE 3 POSITION THAT IS WHAT I INTEREST
        if($c > 2)
        {
            //-- VERIFICO SE TEM ALGUM ARQUIVO DENTRO
            $subDir = $dir.$dirName;
            //-- DELETE FILES ONLY IF IT'S A DIRECTORY
            deleteFiles($subDir);
            //-- DELETE DIRECTORIES
            rmdir($subDir) or die("ERROR BY EXCLUDING DIRECTORY: $dirName");

        }
    }//-- WHILE
    //-- CLOSE DIRECTORIE
    closedir($ponteiro);
}//-- DELETEDIRECTORIES

//-- DELETE FILES
function deleteFiles($dir)
{
    foreach(scandir($dir) as $file)
    {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }//-- FOREACH
}//-- DELETEFILES

//-- DELETE FILE ZIP
function deleteZip($name)
{
    $zipFile = __DIR__."../$name.zip";
    if(file_exists($zipFile))
    { unlink($zipFile);}
}//-- DELETEZIP


?>