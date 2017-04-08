/**
 * Created by Jlaupa on 08/04/2017.
 */
var peticiones = peticiones || (function () {
        var parametros = {};
        return {

            Consulta   : function(unico) {
                if(unico==true){
                    if (!isNaN($('#productId').val()) && $('#productId').val() > 0) {
                        parametros = { "id" : $('#productId').val() };
                        peticiones.ejecutarConsulta(parametros);
                    } else {
                        clase = 'alert alert-warning' ;
                        text  = 'Ingrese una caracteristica numerica';
                        peticiones.msj(clase,text);
                    }

                }else{
                    parametros = { "unico": unico };
                    peticiones.ejecutarConsulta(parametros);
                }
            },
            msj : function(clase,text){
                $("#msj").removeClass();
                $("#msj").show();
                $("#msj").addClass(clase);
                $("#msj").html(text);
                $("#result").focus();
            },

            ejecutarConsulta:function (data) {
                $.ajax({
                    data: data,
                    url: 'controllers/consultas.php?function=consultar',
                    type: 'post',
                    contentType : "application/x-www-form-urlencoded",
                    beforeSend: function () {
                        $('#result >').remove();
                        clase = 'alert alert-warning' ;
                        text  = '<div class="loader"></div>Procesando, espere por favor...';
                        peticiones.msj(clase,text);
                    },
                    success: function (response) {
                        var res= eval("("+response+")");
                        $('#msj').hide();
                        if(res.length > 0) {
                            $('#result >').remove();
                            clase = 'alert alert-success' ;
                            text  = 'Exito';
                            peticiones.msj(clase,text);
                            peticiones.armarTabla(res);

                        }else {
                            $('#result >').remove();
                            clase = 'alert alert-warning' ;
                            text  = 'No se encontraron registros';
                            peticiones.msj(clase,text);
                        }
                    },
                    error:function (e) {
                        console.log(e);
                        alert('Hubo un error intentelo de nuevo');
                    }

                });
            },

            armarTabla : function (e) {
                var html='';
                html = "<br>" +
                    "<table class='table table-striped table-bordered' style='text-align: center;'>" +
                    "<thead style='font-weight: bold;'>" +
                    "<tr class='bg-primary'>" +
                    "<td>Id</td>" +
                    "<td>Name</td>" +
                    "<td>Price</td>" +
                    "<td>Date_created</td>" +
                    "<td>Action</td>" +
                    "</tr>" +
                    "</thead>";

                $.each(e,function(key,product){
                    html += "<tr>" +
                        "<td>"+ product.id    +"</td>" +
                        "<td>"+ product.name  +"</td>" +
                        "<td>"+ product.price +"</td>" +
                        "<td>"+ product.date_created+"</td>" +
                        "<td align='center'><span id='action"+product.id+"'><input type='button' class='btn btn-danger' onclick='peticiones.eliminarReg("+ product.id+")''  value='Eliminar' /></span></td>" +
                        "</tr>"
                });

                html += "</table>";

                $("#result").html(html);
                location.href ="#result";

            },
            
            eliminarReg: function (id) {
                parametros = { "id": id };
                $.ajax({
                    data: parametros,
                    url: 'controllers/consultas.php?function=delete',
                    type: 'post',
                    contentType : "application/x-www-form-urlencoded",
                    beforeSend: function () {
                        $('#action'+id).html("<div class='loader'></div>");
                    },
                    success: function (response) {
                        var res= eval("("+response+")");
                        if(typeof res === 'object' ) {
                            if(res.exito==true) {
                                alert(res.text);
                                peticiones.Consulta(false);
                            }else {
                                alert(res.text);
                                peticiones.Consulta(false);
                            }
                        }else{
                            alert(res.text);
                            peticiones.Consulta(false);
                        }

                    },
                    error:function (e) {
                        console.log(e.error());
                        alert('Hubo un error intentelo de nuevo');
                    }
                });
            }

        }
    }());