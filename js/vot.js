
function soloNumeros(e) 
{ 
  var key = window.Event ? e.which : e.keyCode 
  return ((key >= 48 && key <= 57) || (key==8)) 
}

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () 
{  
    $('#nro_cedula').val('');
    $('#razon_social').val('');
    $('#razon_social').prop('disabled',true);

    $('#nomb_centro').val('');
    $('#nomb_centro').prop('disabled',true);

    $('#direccion').val('');
    $('#direccion').prop('disabled',true);

    $('#cbo_tipo_voto').prop('disabled',true);
    $('#btnReg').prop('disabled',true);

    $.post("../controller/regVot.php", 
    {
        prmOp:"iniFrm"
    },
    function(data)
    {  
        data=JSON.parse(data);
        $('#nomb_evento').append(data[0]);
        $('#cboLetRif').html(data[2]);
        $('#cboLetRif').trigger("chosen:updated");
        $('#cbo_tipo_voto').html(data[3]);
        $('#cbo_tipo_voto').trigger("chosen:updated");
    });
})

function bus_Xcedula(e)
{    
    $('#razon_social').val('');
    $('#nomb_centro').val('');
    $('#direccion').val('');

    var letRif= $('#cboLetRif').val();
    var prmNroCed=$('#nro_cedula').val();
/*
    if (prmNroCed.length<8) 
    { 
        prmNroCed=prmNroCed.padStart(8,"0");
        $('#nro_cedula').val(prmCed);
    }
*/



    var prmCed=letRif + prmNroCed;
    var valPart="";
    $.post("../controller/regVot.php", 
    {
        prmCed:prmCed,
        prmOp:"valPart"
    },
    function(data) 
    {      
        rsDat=JSON.parse(data);
        valPart=rsDat[0];

        if (valPart==0)
        {
            $.post("../controller/regVot.php", 
            {
                prmCed:prmCed,
                prmOp:"busInfCed"
            },
            function(data) 
            {      
                data=JSON.parse(data);
            
                if (data[0]==0)
                {
                    $('#razon_social').val("");
                    $('#nomb_centro').val("");
                    $('#direccion').val("");
                    $('#cbo_tipo_voto').prop('disabled',true);
                    $('#cbo_tipo_voto').trigger("chosen:updated");
                    $('#btnReg').prop('disabled',true);
            
                    Swal.fire
                    ({
                        title: 'Verifique: '+data[1],
                        width: 500,
                        padding: '2em',
                        color: ' rgba(0,0,0,0.5)',
                        background: ' rgba(255,255,255,0.9)',
                    });
                }
                if (data[0]==1)
                {
                    $('#razon_social').val(data[2]);
                    $('#nomb_centro').val(data[3]);
                    $('#direccion').val(data[4]);
                    $('#cbo_tipo_voto').prop('disabled',true);
                    $('#cbo_tipo_voto').trigger("chosen:updated");
                    $('#btnReg').prop('disabled',true);
            
                    Swal.fire
                    ({
                        title: 'Verifique: '+data[1],
                        width: 500,
                        padding: '2em',
                        color: ' rgba(0,0,0,0.5)',
                        background: ' rgba(255,255,255,0.9)',
                    });
                }
                else if (data[0]==2)
                {
                    $('#razon_social').val(data[2]);
                    $('#nomb_centro').val(data[3]);
                    $('#direccion').val(data[4]);
                    $('#cbo_tipo_voto').prop('disabled',false);
                    $('#cbo_tipo_voto').trigger("chosen:updated");
                    $('#btnReg').prop('disabled',false);
                }
            });    
        }
        else if (valPart==1)
        {
            var msjInf="";
            msjInf ="La Cedula: " + prmCed;
            msjInf+= " ya participo en este";
            msjInf+= " proceso electoral.";

            Swal.fire
            ({
                title: 'Verifique: '+ msjInf,
                width: 500,
                padding: '2em',
                color: ' rgba(0,0,0,0.5)',
                background: ' rgba(255,255,255,0.9)',
            });
        }
    });
}

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

$('#btnReg').click(function() 
{ 
    var prmIdVot=$('#cbo_tipo_voto').val();
    var letRif= $('#cboLetRif').val();
    var prmNroCed=$('#nro_cedula').val();
/*
    if (prmNroCed.length<8) 
    { 
        prmNroCed=prmNroCed.padStart(8,"0");
        $('#nro_cedula').val(prmCed);
    }
*/
    var prmCed=letRif + prmNroCed;
    $.post("../controller/regVot.php",
    {
        prmCed:prmCed,
        prmIdVot:prmIdVot,
        prmOp:"regPart" 
    }, function(data) 
    {  
        data=JSON.parse(data);
        if ((data[0]==1))
        {

            Swal.fire
            ({
                title: 'Verifique: '+data[1],
                width: 500,
                padding: '2em',
                color: ' rgba(0,0,0,0.5)',
                background: ' rgba(255,255,255,0.9)',
            });

            $('#nro_cedula').val('');
            $('#razon_social').val('');
            $('#nomb_centro').val('');
            $('#direccion').val('');
            $('#cbo_tipo_voto').prop('disabled',true);
            $('#cbo_tipo_voto').trigger("chosen:updated");
            $('#btn_registrar').prop('disabled',true);
        }
    });
});

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////



