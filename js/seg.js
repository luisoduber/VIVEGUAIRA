
$(document).ready(function () 
{   
    $.post("../controller/seg.php",
    {
       prmOp:"iniFrm"
    }, function(data) 
    {  
        data=JSON.parse(data);

        var idPerf=data[0];
        var idParr=data[1];
        if (idPerf==1)
        {
            $('#cbo_parroquias').append(data[4]);
            $('#cbo_tipo_voto').prop('disabled',false);
            $('#cbo_parroquias').trigger("chosen:updated");
        }
        if (idPerf==2)
        {
            $('#cbo_parroquias').append(data[4]);
            $('#cbo_parroquias option[value='+ idParr +']').prop("selected", true);
            $('#cbo_parroquias').prop('disabled',true);
            $('#cbo_parroquias').trigger("chosen:updated");
        }

        $('#nomb_evento').append(data[2]);
        $('#cont_seguimiento').html(data[5]);
    });
});

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

function inicializar_frm2()
{
    $.post("../ajax/seguimiento.php?op=inicializar_frm2",
       
        function(data)
        {  
            data=JSON.parse(data);
            $('#nomb_evento').append(data[0]);
            $('#cont_seguimiento').html(data[1]);
        });
}

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

function proc_participacion()
{
    var prmIdParr=$('#cbo_parroquias').val();

    if (prmIdParr==0) { prmOp='procPartTod'; }
    else if (prmIdParr > 0) { prmOp='procPartParr'; }
   
    $.post("../controller/seg.php",
    {
       prmIdParr:prmIdParr,
       prmOp:prmOp
    }, function(data) 
    {   
        data=JSON.parse(data);
        $('#cont_seguimiento').html(data);
    });
}


//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////


function infEncUch(prmCodCentVot)
{

    $.post("../controller/seg.php",
    {
        prmOp:"infEncUbch",
        prmCodCentVot:prmCodCentVot
    },
    function(data)
    {  
        rsDat=JSON.parse(data);

        var msjInf="";
        $.each(rsDat, function(index, value) 
        {
            msjInf+="<br>"+value.rs + " | ";
            msjInf+=value.telf + "  ";
           
        });

        Swal.fire
        ({
            title: 'Encargado UBCH: '+msjInf,
            width: 700,
            padding: '2em',
            color: ' rgba(0,0,0,0.5)',
            background: ' rgba(255,255,255,0.9)',
        });

        
    });
}
