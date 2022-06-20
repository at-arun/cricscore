<?php
if (empty($series))
{
	echo "No data";
	exit();
}
echo link_tag('assets/css/seriesLists.css');
echo script_tag('assets/js/seriesLists.js');

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
  </ol>
</nav>

<style type="text/css">

.icon-flipped {
    transform: scaleX(-1);
    -moz-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    -ms-transform: scaleX(-1);
}

</style>
<?php

$card = "";
foreach ($series['data'] as $key => $value)
{
	$seriesName = esc($value['name']);
	$seriesId 	= $value['id'];
	$t20 = $value['t20'];
	$odi = $value['odi'];
	$test = $value['test'];

	$startDate = $value['startDate'];
	$startTimestamp = strtotime($startDate);
	$startYear = date('Y', $startTimestamp);
	$startDateString = date('d M y', $startTimestamp);

	$endDate = $value['endDate']." ".$startYear;
	$endDateString = date('d M y', strtotime($endDate));

	$card .= "
			<div class='col-md-3' style='margin-bottom: 5px;'>
			 <div class='card border-info w-100' style='height: 100%'>
			    <div class='card-body'>
			      <h5 class='card-title'>$seriesName</h5>
			      <p class='card-text'>
			      	<span class='badge badge-primary'>T20 $t20</span></h1>
			      	<span class='badge badge-info'>ODI $odi</span></h1>
			      	<span class='badge badge-secondary'>TEST $test</span></h1>
			      </p>
			    </div>
			    <div class='card-footer'>
		    		<i class='bi bi-calendar-event'></i>
			      	<small class='text-muted'>$startDateString - $endDateString</small>
			      	<span class='float-right'>
			      		<a href='/seriesInfo/$seriesId' class='card-link'>View
			      		</a>
			      	</span>
			    </div>
			  </div>
			  </div>
	";
}
$pagination = $pager->makeLinks($page, $perPage, $total, 'bootstrap', 2);

$search = '
			<form method="GET" action="/seriesSearch">
				<div class="input-group input-group-sm mb-3">
			  		<div class="input-group-prepend">
			    		<span class="input-group-text" id="inputGroup-sizing-sm">
			    			<i class="bi bi-search icon-rotate icon-flipped"></i></span>
			  		</div>
			  		<input type="text" name="search" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="search series">
			  		<button id="searchSeries" type="submit" class="btn btn-primary"
			  			onclick="searchSeries();"
			  			style="margin-left:5px;"
			  		>
			  			Search
			  		</button>
				</div>
			</form>
';


echo "<div class='row'>
  <div class='col-md-9'>$search</div>
  <div class=' col-md-3'>$pagination</div>
</div>";

echo "<div class='row'>$card</div>";


