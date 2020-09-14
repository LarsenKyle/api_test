<?php 
require_once('lib/api.php');

$start = 0;
$slicecount = 100;

$url = $api::baseURL . "/index.php/SearchInterfaces/141";
$request_fields = array(
	'SI357' => "*",
	'Thumbnails[]' => array('Large'),
	'Start' => $start,
	'Count' => $slicecount,
	'SearchType' => 'and'
);
$result = $api->request($url, $request_fields);
$result_arr = $result->results;
$result_arr = $result->results;
$resnum = count($result_arr);
$start = 0;
$slicecount = 5;

$url = $api::baseURL . "/index.php/SearchInterfaces/141";
$request_fields = array(
	'SI357' => "*",
	'Thumbnails[]' => array('Large'),
	'Start' => $start,
	'Count' => $slicecount,
	'SearchType' => 'and'
);
$result = $api->request($url, $request_fields);
$result_arr = $result->results;
$result_arr = $result->results;
 $ancestor_arr = $result_arr[0]->ancestors;
 foreach($ancestor_arr as $item){
	 $aid = $item->id;
	 switch ($aid) {
		case 45854:
			$collectionname = $item->name;
			break;
		case 45853:
			$boxname = $item->name;
			break;
		case 681:
			$foldername = $item->name;
			break;
	}
 }
?>

<html lang="en">
	<head>
		<!-- the head is the same in all the pages -->
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<title>Sample Site</title>
		<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
	
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-select.min.css" rel="stylesheet">
		
		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="fonts/mom-webfont.css" type="text/css" charset="utf-8" />
		<link rel="stylesheet" href="fonts/myunderwood-webfont.css" type="text/css" charset="utf-8" />

		
		<!-- Layout -->
		<link href="css/style.css" rel="stylesheet">
	
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  	</head>
  	<body class="fixed-header pattern-bg">
		
		<!-- HEADER CODE BEGINS - same as the other pages - actual page is selected in the menu -->
		<div id="header-container">
			<header>
				<div class="menushape">
					<img src="img/shape2.png" alt="">
				</div>
				<div class="container">
					<div class="row">
						<h1 class="title"><a href="index.html">Sample Site</a></h1>
					
						<div class="hidden-xs">
							<div class="social">
							<a href="#"><img src="img/social/twitter_w.png" alt="Twitter"></a>
							<a href="#"><img src="img/social/facebook_w.png" alt="Facebook"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="menubar">
					<div class="container">
						<div class="row">
							<div class="btn-advs msb"><i class="fa fa-search"></i></div>
							<div id="toggle-menu"><i class="fa fa-bars"></i></div>
							<nav>
								<ul>
									<li><a href="about.html">About us</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</header>
		</div>
		<!-- HEADER CODE ENDS -->
		

				
		<section id="search-results">
			<div class="container">
				<div class="row">
				<?php 
				//Output varibales from above
				echo '
				<div class="col-sm-12">
						<h1>'.$collectionname.'</h1>
						<h4>'.$boxname.' - '.$foldername.'</h4>
					</div>
				';
				
				?>
					
				</div>
				<?php
			echo '
			<div class="pull-right"><h5>'.$resnum.' results</h5></div>
			';
				?>
				
			</div>
			<div class="container-fluid">
				<!-- Title -->
				<div class="row project-title">
					<div class="col-sm-3">
						
					</div>
					<div class="col-sm-3">
						<a href="#">title</a>
					</div>
					<div class="col-sm-3">
						<a href="#">year</a>
					</div>
					<div class="col-sm-3 hidden-xs">
						description
					</div>
				</div>
				
				<?php 
				//Start iterating through results array
				foreach($result_arr as $item){
					//Get image for each item and store it in $image
					if(!empty($item->digital_assets[0]->large_thumbnail)) {
						$image = $item->digital_assets[0]->large_thumbnail;
					}
					//Get the description and date from the attribute values array in each item object 
					//Store description in $description
					//Store date in $date
					foreach($item->attribute_values as $av){
						if(empty($av->value)) continue;
							$avname = $av->attribute_name;
							$val = $av->value;
							switch ($avname) {
							case 'Description':
							$description = $val->text;
							break;
							case 'Creation Date':
							$date = $val->date;
							break;
								}
							
					}
					//Dynamically ouptput project item div with variables from above
					echo '
				<div class="row project-item">
					<a href="articleview.html">
						<div class="col-sm-3">
							<img src="'. $image .'" alt="">
						</div>
						<div class="col-sm-3 col">
							<span>Title</span>
							'. $item->name .' 
						</div>
						<div class="col-sm-3 col">
							<span>Year</span>
							'. $date .'
						</div>
						<div class="col-sm-3">
							'.$description.'
						</div>
					</a>
				</div>
				';
				}
				
				?>
				
				
				
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="pagination">
						
							<a href="/api_test/results3.php"><i class="glyphicon glyphicon-triangle-left"></i></a>
							<?php 
							$numopage = ceil($resnum / 5);
						
							$pageoutput = range(1,$numopage);
							foreach($pageoutput as $num){
								echo '
								<a href="/api_test/results'.$num.'.php">'.$num.'</a>
								';
						}
						?>
							
						
						
							
							<a href="/api_test/results2.php"><i class="glyphicon glyphicon-triangle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
		<!-- FOOTER CODE BEGIN - same as the other pages -->
		<footer>
			<div class="container">
				<div class="row part1">
					<div class="col-md-12">
						<nav>
							<ul>
								<li><a href="index.html">Home</a></li>
								<li><a href="about.html">About us</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="row part2">
					<div class="col-md-5 left-side">

					</div>
					<div class="col-md-5 right-side">
						<div class="social">
							<a href="#"><img src="img/social/twitter_b.png" alt="Twitter"></a>
							<a href="#"><img src="img/social/facebook_b.png" alt="Facebook"></a>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- FOOTER CODE ENDS - the scripts bellow are the same too -->
		  
  	</body>
</html>