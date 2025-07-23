var loading;
$(document).ready(function () 
{   
    loading=$('#spinner-loading').hide();
    $.post("../controller/dash-1x10.php",
   function(data) 
    {  
        rsDat=JSON.parse(data);
        
        $('#titEv').html(rsDat[0]);
        $('#nombEst').html(rsDat[1]);
        $('#cantVotEst').html(rsDat[2]);
        $('#porcPartEst').html(rsDat[3]+"%");
        $('#cantPartEst').html(rsDat[4]);
        $('#cantFaltEst').html(rsDat[5]);
        $('#nombInst').html(rsDat[6]);
        $('#cantPartInst').html(rsDat[7]);
        $('#porcPartInst').html(rsDat[8]+"%");
        $('#cantVotInst').html(rsDat[9]);
        $('#cantFaltInst').html(rsDat[10]);
        $('#cardUni').html(rsDat[15]);

        let prmPorcPartEst=rsDat[11];
        let prmPorcRestEst=rsDat[12];
        let prmPorcPartInst=rsDat[13];
        let prmPorcRestInst=rsDat[14];

        var options = {
            chart: {
                height: 150,
                type: 'donut',
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%'
                    }
                }
            },
            labels: ['Participación', 'Faltante'],
            series: 
            [
                prmPorcPartEst,
                prmPorcRestEst
            ],
            legend: {
                show: true
            },
            tooltip: {
                theme: 'datk'
            },
            grid: {
                padding: {
                    top: 20,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            colors: ["#4680ff", "#2ed8b6"],
            fill: {
                opacity: [1, 1]
            },
            stroke: {
                width: 0,
            }
        }
       var chart = new ApexCharts(document.querySelector("#customer-chart"), options);
      chart.render();

      var options1 = {
            chart: {
                height: 150,
                type: 'donut',
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%'
                    }
                }
            },
            labels: ['Participación', 'Faltante'],
            series: 
            [ 
              prmPorcPartInst,
              prmPorcRestInst
            ],
            legend: {
                show: true
            },
            tooltip: {
                theme: 'dark'
            },
            grid: {
                padding: {
                    top: 20,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            colors: ["#fff", "#2ed8b6"],
            fill: {
                opacity: [1, 1]
            },
            stroke: {
                width: 0,
            }
        }
        var chart1 = new ApexCharts(document.querySelector("#customer-chart1"), options1);
        chart1.render();
        
        
        

        
        
      
       
       
        
       
        
    });
});
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

$(document).ajaxStart(function () { loading.show();
}).ajaxStop(function () { loading.hide();});
