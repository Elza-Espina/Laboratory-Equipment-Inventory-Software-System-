<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>  

<script type="text/javascript">
$(document).ready(function(){
    var months =  <?php echo json_encode($months);?>;
    var items = <?php echo json_encode($eqpList);?>;
    var chart = {  
        chart: {
            width: '800',
            height: '250'
        },
        title: {
            text: 'Borrowed Items',
            x: -20 //center
        },
        xAxis: {
            categories: months
        },
        yAxis: {
            title: {
                text: 'Number of Items'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        // },
        },
        series: [{
            name: 'Equipment(s)',
            data: items
        },
        // {
        //     name: 'Components',
        //     data: items
        // }

        ]
    };

    $('#lineChartcontainer').highcharts(chart);
});
</script>
<div style="display: inline-block; height: 17em;">
        <span style="font-size: 90px; padding-left: 50px;" id="totalItems"><?php echo $totalItems;?></span><br>
        <span style="font-size: 20px;">equipments & components</span>
</div>

<div id='lineChartcontainer' style="float: right"></div>

<div style="display: flex; border: dashed; width: 35%; height: 53%;">Recent Actions</div>