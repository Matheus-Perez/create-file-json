jQuery.noConflict();
var form;


//-- QUANDO A PAGINA É CARREGADA
jQuery(document).ready(function ()
{



    jQuery('#filename').change(function (event)
    {
        form = new FormData();
        form.append('filename', event.target.files[0]); // para apenas 1 arquivo
        jQuery("#msgReturn").html("");
    });


    jQuery("#Enviar").click(function ()
    {
        var paginaPHPImportacao = "";
        if(jQuery("#oneFile").is(":checked"))
        {
            paginaPHPImportacao = "upload_file.php";
        }
        else
        {
            if(jQuery("#translateFile").is(":checked"))
            {paginaPHPImportacao = "upload_file_translate.php";}
            else
            {alert("Select a way to generate excel.");return;}

        }
        /*===========================*/
        if(form != "")
        {
            jQuery.ajax({
                url: paginaPHPImportacao, // Url do lado server que vai receber o arquivo
                data: form,
                processData: false,
                contentType: false,
                type: 'POST',
                beforeSend: function ()
                {
                    jQuery("#loading").show();
                },
                complete: function ()
                { jQuery("#loading").hide();},
                success: function (result)
                {
                    // Verifica se o que foi retornado 页m JSON
                    try{
                        var retorno = JSON.parse(result);
                    }catch(err){
                        alert(result);
                        return;
                    }
                    jQuery("#msgReturn").html("<a href='download_file.php?a="+retorno.file+"'><button type='button' class='btn btn-primary '> &nbsp;&nbsp;Download &nbsp;&nbsp;<i class='fa fa-cloud-download' aria-hidden='true'></i></button></a>")
                }
            });
        }
        /*===========================*/
    });

});

//-- DEPOIS QUE TODA A PAGINA É CARREGADA
jQuery(window).load(function ()
{
});
