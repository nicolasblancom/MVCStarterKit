$(function() {

    // just a super-simple JS demo

    var demoHeaderBox;

    // simple demo to show create something via javascript on the page
    if ($('#javascript-header-demo-box').length !== 0) {
    	demoHeaderBox = $('#javascript-header-demo-box');
    	demoHeaderBox
    		.hide()
    		.text('Hello from JavaScript! This line has been added by public/js/application.js')
    		.css('color', 'green')
    		.fadeIn('slow');
    }

    // if #javascript-ajax-button exists
    if ($('#javascript-ajax-button').length !== 0) {

        $('#javascript-ajax-button').on('click', function(){

            // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
            // "url" is defined in views/_templates/footer.php
            $.ajax(url + "/songs/ajaxGetStats")
                .done(function(result) {
                    // this will be executed if the ajax-call was successful
                    // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
                    $('#javascript-ajax-result-box').html(result);
                })
                .fail(function() {
                    // this will be executed if the ajax-call had failed
                })
                .always(function() {
                    // this will ALWAYS be executed, regardless if the ajax-call was success or not
                });
        });
    }

    setTimeout(function(){
        $(".errorf").hide(1000);
    }, 5000);


    $('.enlacecuantas').on("click", function(e){
        e.preventDefault();
        var enlace = $(this);
        var url = enlace.attr("href");
        enlace.children("span").load(url);
    });

    $('#formulariorespuesta').on("submit", function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        $.post(url, form.serialize(), function(res){
            $('.mensajef').html(res);
        });
    });

    $('#formulariorespuestaJSON').on("submit", function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        var mensaje = $('.mensajef');
        mensaje.removeClass("exitof");
        $.ajax(url, {
            data: form.serialize(),
            dataType: 'json',
            method: 'post'
        })
        .done(function(res){
            console.log(res);
            if(res.exito){
                form.hide(1000);
                mensaje.addClass("exitof");
                $("#cuantasresp").text("Respuestas: " + res.cuantas);
                //$("#numrespuestas").load('/preguntas/cuantasRespuestasIdPreg/' + res.idRespuesta)
            }
            mensaje.html(res.msg);
        });
    });


    $("#veryaenviadas").on("click", function(e){
        e.preventDefault();
        var enlace = $(this);
        var url = enlace.attr("href");
        $.getJSON(url, function(res){
            console.log(res);
            var capa = $("#respuestasjson");
            /*
            for(actual in res){
                console.log(actual);
                capa.html(capa.html() + res[actual].id_respuesta + ": " + res[actual].respuesta + "<br>");
            }
            */
            //var stemplate = $("#template").html();
            $.get('/js/template-respuestas.html')
            .done(function(stemplate){
                console.log("templ", stemplate);
                var tmpl = Handlebars.compile(stemplate);
                var ctx = {};
                ctx.respuestas = res;
                var htmlRespuestas = tmpl(ctx);
                $("#respuestasjson").html(htmlRespuestas);
            });
        });
    });

});
