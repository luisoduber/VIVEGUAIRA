
function solNum(e) 
{ 
  	var key = window.Event ? e.which : e.keyCode 
  	return ((key >= 48 && key <= 57) || (key==8)) 
}
var tabla;
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function () 
{  
    iniFrm();
    iniTbl();
    $("#basic-form").validate
    ({
        rules: 
        {
            txtCed: { required: true,minlength:6,maxlength:8,number: true},
            txtRs: { required: true},
            txtNroTelf: { required: true,minlength:7,maxlength:7,number: true},
            txtEmail: { required: true, email: true},
            txtDirec: { required: true},
            txtClave: { required: true}
        },
        messages: 
        {
            txtCed: 
            {
                required: "Ingrese Nro. Cedula.",
                maxlength: "La Cedula debe contener min. 6, Max. 8 digitos.",
                number: "Ingrese solo numeros."
            },
            txtRs: {required: "Ingrese Razon Social."},
            txtNroTelf:  
            {
                required: "Ingrese Telefono.",
                maxlength: "El telefono Cotiene 7 digitos.",
                number: "Ingrese solo numeros."
            },
            txtEmail: 
            {
                required: "Ingrese Email.",
                email: "Ingrese un email correcto."
            },
            txtDirec: {required: "Ingrese dirección."},
            txtClave: {required: "Ingrese clave."}
        },
        submitHandler: function(form) 
        {
            var fd= new FormData();
            var cboLetRif=$('#cboLetRif').val();
            var txtCed=$('#txtCed').val();
            var txtRs=$('#txtRs').val();
            var cboCodTelf=$('#cboCodTelf').val();
            var txtNroTelf=$('#txtNroTelf').val();
            var txtEmail=$('#txtEmail').val();
            var txtDirec=$('#txtDirec').val();
            var txtClave=$('#txtClave').val();
            var cboEst=$('#cboEst').val();
            var cboMun=$('#cboMun').val();
            var cboParr=$('#cboParr').val();
            var cboCentVot=$('#cboCentVot').val();
            var CboPerf=$('#cboPerf').val();
            var CboStat=$('#cboStat').val();

            fd.append('prmLetRif',cboLetRif);
            fd.append('prmCed',txtCed);
            fd.append('prmRs',txtRs);
            fd.append('prmCodTelf',cboCodTelf);
            fd.append('prmNroTelf',txtNroTelf);
            fd.append('prmEmail',txtEmail);
            fd.append('prmDirec',txtDirec);
            fd.append('prmClave',txtClave);
            fd.append('prmIdEst',cboEst);
            fd.append('prmIdMun',cboMun);
            fd.append('prmIdParr',cboParr);
            fd.append('prmCodCentVot',cboCentVot);
            fd.append('prmIdPerf',CboPerf);
            fd.append('prmIdStat',CboStat);
            fd.append('prmOp','validFrm');

            $.ajax({
                type: "POST",
                url:"../controller/usu.php",
                dataType:'JSON',
                processData:false,  
                contentType:false,        
                cache: false,        
                data: fd,
                success:function(data)
                {   

                    if (data[0]=="1") { limpFrm(); tabla.ajax.reload(); }
                    Swal.fire
                    ({
                        title: data[1],
                        width: 500,
                        padding: '2em',
                        color: ' rgba(0,0,0,0.5)',
                        background: ' rgba(255,255,255,0.9)',
                    })
                }
            });
            //event.preventDefault();
            //return false;
        }
    });
})

/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function iniFrm()
{
    $.post("../src/Controllers/usu.php", 
    {
        prmOp:"iniFrm"
    },
    function(data)
    {  
        data=JSON.parse(data);
        $('#cboLetRif').append(data[0]);
        $('#cboCodTelf').append(data[1]);
        $('#cboEst').append(data[2]);
        $('#cboMun').append(data[3]);
        $('#cboParr').append(data[4]);
        $('#cboCentVot').append(data[5]);
        $('#cboPerf').append(data[6]);
        $('#cboStat').append(data[7]);
    
        $('#cboLetRif').trigger("chosen:updated");
        $('#cboCodTelf').trigger("chosen:updated");
        $('#cboEst').trigger("chosen:updated");
        $('#cboMun').trigger("chosen:updated");
        $('#cboParr').trigger("chosen:updated");
        $('#cboCentVot').trigger("chosen:updated");
        $('#cboPerf').trigger("chosen:updated");
        $('#cboStat').trigger("chosen:updated");
    });
}
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function iniTbl()
{    
    tabla=$('#tblList').dataTable({
        "lengthChange": false,
        "lengthMenu":false,
        "responsive": true,
        "filter":true,
        "responsive": true,
        "aProcessing": true,//activamos el procedimiento del datatable
        "aServerSide": true,//paginacion y filrado realizados por el server
        "iDisplayLength":7,//paginacion
        "order":[[2,"asc"]],//ordenar (columna, orden)
        "ajax":
        {  "type":"POST",
            "datatype":"json",
           "url":"../src/Controllers/usu.php",
           'data': function (d) {
                d.prmOp ='listDt'
            }          
        },
        "columns":
        [
            {"data":"idUsu", className: "text-center"},
            {"data":"rs", className: "text-center"},
            {"data":"ced", className: "text-center"},
            {"data":"nombPerf", className: "text-center"},
            {"data":"nombStat", className: "text-center"}
        ],
        "columnDefs": 
        [ 
            {className: "dt-head-center", targets: "_all"},
            {className: "dt-body-center", targets: "_all"},
            {className: "dt-foot-center", targets: "_all"} 
        ],
        "language":
        { 
            "url": "../json/dt-spanish.json"  
            //"url": "cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json";
        }
   }).DataTable();
}

////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

$('#cboParr').on("change",function() 
{
    prmIdParr=$('#cboParr').val();
    $.post("../src/Controllers/usu.php", 
    {
        prmOp:"busCentVot",
        prmIdParr:prmIdParr
    },
    function(data)
    {  
         rsDat=JSON.parse(data);
        $('#cboCentVot').html(rsDat);
        $('#cboCentVot').trigger("chosen:updated");
    });
})

/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function limpFrm()
{  
    $('#cboLetRif option[value=V]').prop("selected",true);
    $('#cboLetRif').trigger("chosen:updated");
    $('#cboLetRif').prop("disabled",false);

    $('#cboCodTelf option[value=0212]').prop("selected",true);
    $('#cboCodTelf').trigger("chosen:updated");

    $('#cboPerfi option[value=1]').prop("selected",true);
    $('#cboPerf').trigger("chosen:updated");

    $('#cboStat option[value=1]').prop("selected",true);
    $('#cboStat').trigger("chosen:updated");

    $('#txtCed').val('');
    $('#txtCed').prop("disabled",false);

    $('#txtRs').val('');
    $('#txtNroTelf').val('');
    $('#txtEmail').val('');
    $('#txtDirec').val('');
    $('#txtClave').val('');
    $('#txtClave').prop("disabled",false); 
}

/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function busInfUsu(prmIdUsu)
{    
    $.post("../src/Controllers/usu.php", 
    {
        prmOp:"busInfUsu",
        prmIdUsu:prmIdUsu
    },
    function(data) 
    {      
        rsDat=JSON.parse(data);

        $('#cboLetRif option[value='+ rsDat['letCed'] +']').prop("selected",true);
        $('#cboLetRif').trigger("chosen:updated");
        $('#txtCed').val(rsDat['nroCed']);

        $('#cboLetRif').prop("disabled",true);
        $('#txtCed').prop("disabled",true);
        
        $('#txtRs').val(rsDat['rs']);
        $('#cboCodTelf option[value='+ rsDat['codTelf'] +']').prop("selected",true);
        $('#cboCodTelf').trigger("chosen:updated");
        $('#txtNroTelf').val(rsDat['nroTelf']);

        $('#txtEmail').val(rsDat['email']);
        $('#txtDirec').val(rsDat['dir']);

        $('#txtClave').prop("disabled",true);

        $('#cboEst option[value='+ rsDat['idEst'] +']').prop("selected",true);
        $('#cboEst').trigger("chosen:updated");

        $('#cboMun option[value='+ rsDat['idMun'] +']').prop("selected",true);
        $('#cboMun').trigger("chosen:updated");

        $('#cboParr option[value='+ rsDat['idParr'] +']').prop("selected",true);
        $('#cboParr').trigger("chosen:updated");

        prmIdParr=$('#cboParr').val();
        $.post("../src/Controllers/usu.php", 
        {
            prmOp:"busCentVot",
            prmIdParr:prmIdParr
        },
        function(data)
        {  
            dt=JSON.parse(data);
            $('#cboCentVot').html(dt);
            $('#cboCentVot option[value='+ rsDat['codCentVot'] +']').prop("selected",true);
            $('#cboCentVot').trigger("chosen:updated");
        });

        $('#cboPerf option[value='+ rsDat['idPerf'] +']').prop("selected",true);
        $('#cboPerf').trigger("chosen:updated");
        
        $('#cboStat option[value='+ rsDat['idStat'] +']').prop("selected",true);
        $('#cboStat').trigger("chosen:updated");
    });
}


