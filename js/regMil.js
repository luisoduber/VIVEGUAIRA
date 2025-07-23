
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
            txtDirec: { required: true},
            txtEmail: { required: true}
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
            txtDirec: {required: "Ingrese dirección."},
            txtEmail: {required: "Ingrese email."},
        },
        submitHandler: function(form) 
        {
            var fd= new FormData();
            var idJef=$('#txtIdJef').val();
            var idMil=$('#txtIdMil').val();
            var cboLetRif=$('#cboLetRif').val();
            var txtCed=$('#txtCed').val();
            var txtRs=$('#txtRs').val();
            var cboCodTelf=$('#cboCodTelf').val();
            var txtNroTelf=$('#txtNroTelf').val();
            var txtDirec=$('#txtDirec').val();
            var cboParr=$('#cboParr').val();
            var cboCentVot=$('#cboCentVot').val();
            var cboCom=$('#cboCom').val();
            var email=$('#txtEmail').val();
            var CboStat=$('#cboStat').val();

            fd.append('prmIdJef',idJef);
            fd.append('prmIdMil',idMil);
            fd.append('prmLetRif',cboLetRif);
            fd.append('prmCed',txtCed);
            fd.append('prmRs',txtRs);
            fd.append('prmCodTelf',cboCodTelf);
            fd.append('prmNroTelf',txtNroTelf);
            fd.append('prmDirec',txtDirec);
            fd.append('prmIdParr',cboParr);
            fd.append('prmCodCentVot',cboCentVot);
            fd.append('prmIdCom',cboCom);
            fd.append('prmEmail',email);
            fd.append('prmIdStat',CboStat);
            fd.append('prmOp','validFrm');

            $.ajax({
                type: "POST",
                url:"../controller/regMil.php",
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
                        title: "Verifique: "+ data[1],
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
    $.post("../controller/regMil.php", 
    {
        prmOp:"iniFrm"
    },
    function(data)
    {  
        data=JSON.parse(data);
        
        $('#txtIdJef').prop("disabled",true);
        $('#txtIdMil').val('0');
        $('#cboLetRif').append(data[0]);
        $('#cboCodTelf').append(data[1]);
        $('#cboParr').append(data[2]);
        $('#cboCentVot').append(data[3]);
        $('#cboCom').append(data[4]);
        $('#cboStat').append(data[5]);
    
        $('#cboLetRif').trigger("chosen:updated");
        $('#cboCodTelf').trigger("chosen:updated");
        $('#cboParr').trigger("chosen:updated");
        $('#cboCentVot').trigger("chosen:updated");
        $('#cboCom').trigger("chosen:updated");
        $('#cboStat').trigger("chosen:updated");
    });
}
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function iniTbl()
{    
    let prmIdJef=$('#txtIdJef').val();
    tabla=$('#tblList').dataTable({
       'destroy': true,
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
           "url":"../controller/regMil.php",
           'data': function (d) {
                d.prmOp ='listDt',
                d.prmIdJef=prmIdJef
            }          
        },
        "columns":
        [
            {"data":"idMil", className: "text-center"},
            {"data":"rs", className: "text-center"},
            {"data":"ced", className: "text-center"},
            {"data":"nombParr", className: "text-center"},
            {"data":"nombCentVot", className: "text-center"},
            {"data":"nombCom", className: "text-center"},
            {"data":"dir", className: "text-center"},
            {"data":"telf", className: "text-center"},
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
    $.post("../controller/regMil.php", 
    {
        prmOp:"busCentVot",
        prmIdParr:prmIdParr
    },
    function(data)
    {  
         rsDat=JSON.parse(data);
        $('#cboCentVot').html(rsDat);
        $('#cboCentVot').trigger("chosen:updated");
        listCom(prmIdParr);
    });
})

////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

function listCom(prmIdParr)
{
    $.post("../controller/regMil.php", 
        {
            prmOp:"listCom",
            prmIdParr:prmIdParr
        },
        function(data)
        {  
             rsDat=JSON.parse(data);
            $('#cboCom').html(rsDat);
            $('#cboCom').trigger("chosen:updated");
        });
}

////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

function busXced(e)
{    
    var letRif= $('#cboLetRif').val();
    var prmNroCed=$('#txtCed').val();

    var prmCed=letRif + prmNroCed;
    var valPart="";
    $.post("../controller/regJef.php", 
    {
        prmCed:prmCed,
        prmOp:"busInfJefCed"
    },
    function(data) 
    {      
        rsDat=JSON.parse(data);
        idVerf=rsDat[0];
        let msjInf=rsDat[1];
        if (idVerf==0)
        {
            $('#txtRs').val("");
            $('#txtDirec').val("");
            $('#email').val("");
            $('#txtRs').focus();
            $('#txtRs').prop("disabled",false);
            $('#cboParr').prop("disabled",false);
            $('#cboCentVot').prop("disabled",false);

            Swal.fire
            ({
                title: 'Verifique: '+ msjInf,
                width: 500,
                padding: '2em',
                color: ' rgba(0,0,0,0.5)',
                background: ' rgba(255,255,255,0.9)',
            });
        }
        else if (idVerf==1)
        {
            let prmIdParr=rsDat[3];
            let codCentVot=rsDat[4];

            $('#txtRs').val(rsDat[2]);
            $('#cboParr option[value='+ prmIdParr +']').prop("selected",true);
            $('#cboParr').trigger("chosen:updated");

            $.post("../controller/regMil.php", 
            {
                prmOp:"busCentVot",
                prmIdParr:prmIdParr
            },
            function(data)
            {  
                dt=JSON.parse(data);
                $('#cboCentVot').html(dt);
                $('#cboCentVot option[value='+ codCentVot +']').prop("selected",true);
                $('#cboCentVot').trigger("chosen:updated");
            });

            $.post("../controller/regMil.php", 
            {
                prmOp:"listCom",
                prmIdParr:prmIdParr
            },
            function(data)
            {  
                 dt=JSON.parse(data);
                $('#cboCom').html(dt);
                $('#cboCom option[value='+ rsDat['idCom'] +']').prop("selected",true);
                $('#cboCom').trigger("chosen:updated");
            });
            
            $('#txtRs').prop("disabled",true);
            $('#cboParr').prop("disabled",true);
            $('#cboCentVot').prop("disabled",true);
        }
    });   
}

/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function limpFrm()
{  
    $('#cboLetRif option[value=V]').prop("selected",true);
    $('#cboLetRif').trigger("chosen:updated");
    $('#cboLetRif').prop("disabled",false);

    $('#cboCodTelf option[value=0212]').prop("selected",true);
    $('#cboCodTelf').trigger("chosen:updated");

    $('#cboStat option[value=1]').prop("selected",true);
    $('#cboStat').trigger("chosen:updated");

    $('#txtCed').val('');
    $('#txtCed').prop("disabled",false);
    $('#txtRs').val('');
    $('#txtRs').prop("disabled",false);
    $('#cboParr').prop("disabled",false);
    $('#cboCentVot').prop("disabled",false);

    $('#txtRs').val('');
    $('#txtNroTelf').val('');
    $('#txtDirec').val('');
    $('#txtEmail').val('');
    $('#txtIdMil').val('0');
}

/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

function busInfJef(prmIdMil)
{    
    $.post("../controller/regMil.php", 
    {
        prmOp:"busInfMil",
        prmIdMil:prmIdMil
    },
    function(data) 
    {      
        rsDat=JSON.parse(data);
        $('#cboLetRif option[value='+ rsDat['letCed'] +']').prop("selected",true);
        $('#cboLetRif').trigger("chosen:updated");
        $('#txtCed').val(rsDat['nroCed']);

        $('#cboLetRif').prop("disabled",true);
        $('#txtCed').prop("disabled",true);
        
        $('#txtIdMil').val(rsDat['idMil']);
        $('#txtRs').val(rsDat['rs']);
        $('#cboCodTelf option[value='+ rsDat['codTelf'] +']').prop("selected",true);
        $('#cboCodTelf').trigger("chosen:updated");
        $('#txtNroTelf').val(rsDat['nroTelf']);

        $('#txtDirec').val(rsDat['dir']);
        $('#txtEmail').val(rsDat['email']);

        $('#cboParr option[value='+ rsDat['idParr'] +']').prop("selected",true);
        $('#cboParr').trigger("chosen:updated");

        prmIdParr=$('#cboParr').val();
        $.post("../controller/regJef.php", 
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

        $.post("../controller/regMil.php", 
            {
                prmOp:"listCom",
                prmIdParr:prmIdParr
            },
            function(data)
            {  
                 dt=JSON.parse(data);
                $('#cboCom').html(dt);
                $('#cboCom option[value='+ rsDat['idCom'] +']').prop("selected",true);
                $('#cboCom').trigger("chosen:updated");
            });


        $('#cboStat option[value='+ rsDat['idStat'] +']').prop("selected",true);
        $('#cboStat').trigger("chosen:updated");
    });
}


