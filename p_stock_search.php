<?php
ini_set("display_errors", "on");
session_start();

$startdate = date('M+j,+Y', mktime() - 7 * 365 * 24 * 3600);
$enddate = date('M+j,+Y');
$query = $_GET['stock'];
$_SESSION['symbol'] = $query;
// $content = file_get_contents("http://finance.google.com/finance?q=CMG&output=json");
// $js = substr($content, 5);
// $js = substr($js, 0, -2);
// $js = preg_replace('/[^(\x20-\x7F)]*/', '', $js);
// $json = json_decode($js);
// print_r($json);

function makeJSON ($q, $startdate, $enddate, $props) {

	// load the data
	$csv = file("http://finance.google.com/finance/historical?q=$q&startdate=$startdate&enddate=$enddate&output=csv");

	$csv = array_reverse($csv);
	
	// the new files
	$arr = array();
	
	foreach ($csv as $line) {
		list ($date, $open, $high, $low, $close, $volume) = explode(',', $line);
		$date = strtotime("$date UTC");
		$thisMonth = date('M Y', $date);
		
		if (is_numeric($date)) {
			
			// // add a little debug info
			$comment = '';
			if ($thisMonth != $lastMonth) { 
				$comment = "/* $thisMonth */\n";
			}
			
			// JS-ify the date 
			$date = $date * 1000;
			//$date = date("Y-m-d", $date);
			
			// clean data
			$volume = trim($volume);
			if ($open < $low || $open == '') {
				$open = $low;
			}
			if ($open < 0.01) {
				$open = 'null';
			}
			if ($high < 0.01) {
				$high = 'null';
			}
			if ($low < 0.01) {
				$low = 'null';
			}
			if ($close < 0.01) {
				$close = 'null';
			}
			
			// push it
			if ($props == 'c') {
				// $arr[] = "{$comment}[$date,$close]";
				$arr[] = "[$date,$close]";
			} else if ($props == 'ohlc') {
				$arr[] = "{$comment}[$date,$open,$high,$low,$close]";
				//$arr[] = "{$comment}insert into stockquotes (datetime, open, high, low, close) values('$date',$open,$high,$low,$close)";
			} else if ($props == 'ohlcv') {
				$arr[] = "{$comment}[$date,$open,$high,$low,$close,$volume]";
			} else if ($props == 'v') {
				$arr[] = "{$comment}[$date,$volume]";
			}
			
		}
		$lastMonth = $thisMonth;
	}

	// $s = "/* $q historical OHLC data from the Google Finance API */\n[\n". join(",\n", $arr) . "\n]";

	$s = "[". join(",\n", $arr) . "]";

	// $s = "/* AAPL historical OHLC data from the Google Finance API */\n[\n". join(";\n", $arr) . "\n]";
	
	
	
	//write the files
	$q = strtolower($q);
	// $file = fopen("stockData.json", "w");
	file_put_contents("stock_data.txt", $s);

	if (empty($arr))
	{
		$_SESSION['errors'] = "A stock with that symbol does not exist. Please try again";
		header("Location: dashboard.php");
	}
	else
	{
		header("Location: stock_info.php");
	}

}


makeJSON($query, $startdate, $enddate, 'c');

?>

