<?php
if (empty($matchInfo))
{
	echo "No data";
	exit();
}
echo link_tag('assets/css/matchInfo.css');

$seriesId = $matchInfo['series_id'];
$matchName = $matchInfo['name'];
$matchType = $matchInfo['type'];
$matchStatus = $matchInfo['status'];
$matchVenue = $matchInfo['venue'];
$matchDate = date('d M Y', strtotime($matchInfo['date']));
$tossWinner = $matchInfo['tossWinner'];
$tossChoice = $matchInfo['tossChoice'];
$scoresArray = ($matchInfo['score']) ? $matchInfo['score'] : [];

$tossDetails = '';

if ($matchStatus != 'Match not started')
{
	$tossDetails = "Toss won by $tossWinner and chose to $tossChoice first";
}


$teamInfo = [];

foreach ($matchInfo['teamInfo'] as $key => $team) {
	$teamInfo[$team['name']] = $team['img'];
}


$showDetailedScorecard = "";
if ($matchInfo['fantasyEnabled']) {
	// its not free API
	// $showDetailedScorecard = "
	// 	<a href='scorecard/' class='btn btn-primary'>Show scorecard</a>
	// ";
}

// show match details
$matchDetails = "
				<div class='card matchInfoCard border-secondary'>
				  <h5 class='card-header'>$matchName</h5>
				  <div class='card-body'>
				    <h5 class='card-title'>$matchStatus</h5>
				    <p class='card-text'>
					    <b>venue</b>: $matchVenue <br />
					    <b>date</b>: $matchDate <br />
					    <i>$tossDetails</i>
					    $showDetailedScorecard
				    </p>
				  </div>
				</div>
";

$scorecard = "<li class='list-group-item active'>Summary</li>";
foreach ($scoresArray as $key => $value) {
	$ining = $value['inning'];

	$inningToDisplay = str_replace('Inning 1', '1st innings', $ining);
	$inningToDisplay = str_replace('Inning 2', '2nd innings', $inningToDisplay);

	$scores = $value['r']."/".$value['w'];
	$overs = $value['o'];

	$scorecard .= "
					<li class='list-group-item d-flex justify-content-between align-items-center'>
					    $inningToDisplay:						
					    <span class='scoreBox'>
					    	<b>$scores ($overs)</b>
					    </span>
				  	</li>
	";
}

echo "
		<nav aria-label='breadcrumb'>
		  <ol class='breadcrumb'>
		    <li class='breadcrumb-item'><a href='/'>Home</a></li>
		    <li class='breadcrumb-item'><a href='/seriesInfo/$seriesId'>Series</a></li>
		    <li class='breadcrumb-item active'><a aria-current='page'>Match</a></li>
		  </ol>
		</nav>

		<div class='card-group w-75'>
				$matchDetails
				<div class='card'>
					<ul class='list-group'>
						$scorecard
					</ul>
				</div>
			</div>
";