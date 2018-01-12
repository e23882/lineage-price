
<!doctype html>
<html>

<head>
	<meta charset="utf-8" name="class[]" value="viewport" content="width=device-width, initial-scale=1">
	<title>天堂M物價趨勢</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="js/perf_highcharts.js"></script>
	<style>
	
	</style>

</head>
<body>
<?php
//呼叫資料庫
	require_once 'ConnectionFactory.php';
	
	  //連接資料庫
		  $conn = ConnectionFactory::getFactory()->getConnection();
		  $stmt = $conn->prepare('select b.name,a.price,a.date,a.item from item a left join item_name b on a.item = b.name_id order by date');
		  $stmt->execute();
		
		  $result = $stmt->fetchAll(PDO::FETCH_CLASS);
		  foreach ($result as $value) 
		  {
			if($value->item==1)
			    $pv_1[] = intval($value->price);
			 else if($value->item==2)
			    $pv_2[] = intval($value->price);
			 else if($value->item==3)
			    $pv_3[] = intval($value->price);
			 else if($value->item==4)
			    $pv_4[] = intval($value->price);
			 else if($value->item==5)
			    $pv_5[] = intval($value->price);
			 else if($value->item==6)
			    $pv_6[] = intval($value->price);
			 else if($value->item==7)
			    $pv_7[] = intval($value->price);
			 else if($value->item==8)
			    $pv_8[] = intval($value->price);
			 else if($value->item==9)
			    $pv_9[] = intval($value->price);
		  }
		 
          $data = array(array("name"=>"鐵","data"=>$pv_1),array("name"=>"高級鐵","data"=>$pv_2),array("name"=>"寶石","data"=>$pv_3)
          ,array("name"=>"高級寶石","data"=>$pv_4),array("name"=>"布","data"=>$pv_5),array("name"=>"高級布","data"=>$pv_6)
          ,array("name"=>"武捲","data"=>$pv_7),array("name"=>"防捲","data"=>$pv_8),array("name"=>"哈爾巴斯","data"=>$pv_9));
          $data = json_encode($data);
		  $conn = null;
?>
<div id="container" style="max-width:1000px;height:600px"></div>
<script>
var chart = Highcharts.chart('container', 
    {
        chart:
        {
            type:'spline'            
        },
        title: 
        {
            text: '夜神交易所物價'
        },
        subtitle: 
        {
            text: '<a href="#">新增資料</a>'
        },
        xAxis:
        {
            type:'datetime',
            title:
            {
                text:null
            }
        },
        yAxis: 
        {
           
            title: 
            {
                text: '價格(藍鑽)'
            }
        },
        legend: 
        {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: 
        {
            series: 
            {
                label: 
                {
                    connectorAllowed: false
                },
                pointStart: 12/24
            }
        },
         series:<?php echo $data?>,
        responsive: 
        {
            rules: 
            [
                {
                    condition: 
                    {
                        maxWidth: 500
                    },
                    chartOptions: 
                    {
                        legend: 
                        {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }
            ]
        }
    }
    );

</script>
</body>
</html>

