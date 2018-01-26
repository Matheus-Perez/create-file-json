<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerar Json</title>

    <link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script type="text/javascript" src="assets/dist/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
</head>
<style>
    /*LOADING CORPO*/
    #loading
    {
        position: fixed;
        z-index: 99999;
        width: 600px;
        height: 200px;
        background:url(assets/dist/images/loader_profile.gif) no-repeat center center;
        display: none;
    }
</style>
<body>
<div class="container">
    <div style="margin: 0 auto; width: 600px;height: 400px; margin-top: 100px">
        <div id = "loading"></div>
        <div class="panel panel-primary margins-panel-home">
            <div class="panel-heading">
                <h3 id="title_panel" class="panel-title"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Gerar Json</h3>
            </div><!--END PANEL HEARDING-->
            <div class="panel-body">

                <div class="form-group row">
                    <div class="col-md-12">
                        <p class="font-weight-bold">Seleciona um arquivo valido: (CSV)</p>
                    </div>
                </div>
<!--                <form enctype='multipart/form-data' action='upload_file.php' method='post'>-->
                <div class="form-group row">
                    <div class="col-md-12">
                        <input size="50" type="file" name="filename" id="filename" class="custom-file-input">
                    </div><!--col-md-->
                </div><!--form-group-->
                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="submit" value="Gerar" id="Enviar" class="btn btn-primary btn-block">
                    </div><!--col-md-->
                </div><!--form-group-->
<!--                </form>-->
                <div class="form-group row">
                    <div class="col-md-12">
                        <div id="msgReturn" style="text-align: center"></div>
                    </div><!--col-md-->
                </div><!--form-group-->
                <div class="for-group row">
                    <div class="col-md-12" style="text-align: center">
                        <p class="font-weight-bold text-muted">Link do porjeto no gitHub:  <a href="https://github.com/Matheus-Perez/create-file-json" target="_blank">Aqui</a></p>
                    </div>
                </div><!--col-md-->
            </div><!--END PANEL BODY-->
        </div><!--END PANEL-->
    </div>





</div>
</body>
</html>