<?php
if (empty($seriesInfo))
{
	echo "No data";
	exit();
}

echo link_tag('assets/css/seriesInfo.css');

$seriesName = $seriesInfo['name'];
$startDate = $seriesInfo['startdate'];
$startTimestamp = strtotime($startDate);
$startYear = date('Y', $startTimestamp);
$startDateString = date('M d', $startTimestamp);

$endDateString = $seriesInfo['enddate'];

$matchDateString = $startYear." ".$startDateString." to ".$endDateString;

$totalOdis 	= ($seriesInfo['odi'] > 0) ? $seriesInfo['odi']." ODIs <br>" : "";
$totalT20s 	= ($seriesInfo['t20'] > 0) ? $seriesInfo['t20']." T20s <br>" : "";
$totalTests	= ($seriesInfo['test'] > 0) ? $seriesInfo['test']." Tests <br>" : "";

$matchCounts = $totalOdis.$totalT20s.$totalTests;
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active"><a area-current="page">Series</a></li>
  </ol>
</nav>

<div class="jumbotron">
  <h1 class="display-4">
  	<?=$seriesName;?>
  </h1>
  <p class="lead">
  	<?=$matchDateString;?>		
  </p>
  <hr class="my-4">
  <p>
  	<?=$matchCounts; ?>
  </p>
</div>

<?php

$myContent = "";

if (!empty($matches))
{
	array_multisort(array_column($matches, 'date'), SORT_ASC, $matches);

	foreach ($matches as $key => $value) {
		$matchId 	= $value['id'];
		$matchType 	= strtoupper($value['matchType']);
		$matchVenue = $value['venue'];
		$matchName 	= $value['name'];
		$matchDate 	= date('d M Y',strtotime($value['date']));
		$matchStatus = $value['status'];
		$matchStatusBadge = "primary";
		if (strpos($matchStatus, 'won') !== false ||  strpos($matchStatus, 'drawn') !== false)
		{
			$matchStatusBadge = 'success';
		}
		else if ($matchStatus == 'Match not started')
		{
			$matchStatusBadge = 'warning';
		}
		
		$matchStatusToDisplay = $matchStatus;
		if (strpos($matchStatus, '-') !== false)
		{
			$matchStatusToDisplay = explode('-', $matchStatus)[0];
		}
		else if (strpos($matchStatus, '(') !== false)
		{
			$matchStatusToDisplay = explode('(', $matchStatus)[0];	
		}

		$matchVenueTitle = $matchVenue;
		$matchVenue = (strlen($matchVenue) > 30) ? substr($matchVenue, 0, 30).'...' : $matchVenue;

		$myContent .= "
						<div class='col-md-3 cardBlock'>
							<div class='card' style='width: 20rem;'>
						  		<div class='card-body'>
								    <h5 class='card-title'>$matchName</h5>
								    <h6 class='card-subtitle mb-2 text-muted'>
								    	<span class='badge badge-secondary'>$matchType</span>
								    	<span class='badge badge-$matchStatusBadge'>
								    		$matchStatusToDisplay
								    	</span>
								    </h6>
						    
								    <p class='card-text'>
								    	$matchVenue <br>
								    	$matchDate
								    </p>
								    <a href='/matchInfo/$matchId' class='card-link'>summary</a>
								    <a href='#' class='card-link'>commentary</a>
						  		</div>
							</div>
						</div>
		";
	}
}	

echo "<div class='row'>".$myContent."</div>";
