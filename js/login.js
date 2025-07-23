$(document).ready(function() 
{
    $("#basic-form").validate
    ({
        rules: 
        {
            txtUsuario: { required: true},
            txtClave: {required: true }
        },
        messages: 
        {
            txtUsuario: {required: "Ingrese Usuario"},
            txtClave: {required: "Ingrese contraseña"}
        },
        submitHandler: function(form) 
        {
            var fd= new FormData();
            var txtUsuario=$('#txtUsuario').val();
            var txtClave=$('#txtClave').val();

            fd.append('prmUsu',txtUsuario);
            fd.append('prmClav',txtClave);
            fd.append('prmOp','log');

            $.ajax({
                type: "POST",
                url:"../src/Controllers/log.php",
                dataType:'JSON',
                processData:false,  
                contentType:false,        
                cache: false,        
                data: fd,
                success:function(data)
                {   
                    if (data[0]=="0") 
                    { 
                        Swal.fire
                        ({
                            title: data[2],
                            width: 500,
                            padding: '2em',
                            color: ' rgba(0,0,0,0.5)',
                            background: ' rgba(255,255,255,0.9)',
                        })
                    }
                    if (data[1]=="1") { $(location).attr("href","/views/usu.php"); }
                    else if (data[1]=="2") { $(location).attr("href","/views/vot.php"); }
                    else if (data[1]=="3") { $(location).attr("href","/views/regJef.php"); }
                }
            });
            //event.preventDefault();
            //return false;
        }
    });
});
  