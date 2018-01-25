<?php


$fileWay = $_GET['a'];

$directory = $fileWay; //diretorio para compactar
$zipfile = "$fileWay.zip"; // nome do zip gerado

$filenames = array();
function browse($dir) {
    global $filenames;
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && is_file($dir.'/'.$file)) {
                $filenames[] = $dir.'/'.$file;
            }
            else if ($file != "." && $file != ".." && is_dir($dir.'/'.$file)) {
                browse($dir.'/'.$file);
            }
        }
        closedir($handle);
    }
    return $filenames;
}

browse($directory);


// cria zip, adiciona arquivos...
$zip = new ZipArchive();
if ($zip->open($zipfile, ZIPARCHIVE::CREATE)!==TRUE)
{
    exit("Não pode abrir: <$zipfile>\n");
}

foreach ($filenames as $filename)
{
    $file = $filename;
      //  echo "Arquivo adicionado: <b>" . $filename . "<br/></b>";
        $zip->addFile($filename,$filename);

}

/*echo "Total de arquivos: <b>" . $zip->numFiles . "</b>\n";
echo "Status:" . $zip->status . "\n";*/
$zip->close();

// Enviando para o cliente fazer download
header('Content-Type: application/gezip');
header('Content-Disposition: attachment; filename="'.$fileWay.'.zip"');
readfile($fileWay.'.zip');
exit(0);

?>