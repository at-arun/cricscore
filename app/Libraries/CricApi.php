<?php
namespace App\Libraries;

class CricApi
{
	private $apiKey = "";

	private $apiEndPoint = "https://api.cricapi.com/v1/";

	public function __construct()
	{
		$key = $this->getApiKey();
		$this->setApiKey($key);
	}

	public function getApiKey()
	{
		return getenv('API_KEY');
	}

	public function setApiKey($key)
	{
		$this->apiKey = $key;
	}

	public function getApiEndPoint()
	{
		return $this->apiEndPoint;
	}

	public function getAllSeries($offset = null)
	{
		$apiEndPoint 	= $this->apiEndPoint . "series?apikey=". $this->apiKey. "&offset=".$offset;

		$json 			= file_get_contents($apiEndPoint);
		$array 			= json_decode($json, true);

		return $array;
	}

	public function searchSeries($search, $offset)
	{
		$apiEndPoint 	= $this->apiEndPoint.
						"series?apikey=".$this->apiKey.
						"&search=".$search.
						"&offset=".$offset;

		$json 			= file_get_contents($apiEndPoint);
		$array 			= json_decode($json, true);

		return $array;
	}

	public function getSeriesInfo(string $id)
	{
		$apiEndPoint 	= $this->apiEndPoint . "series_info?apikey=". $this->apiKey. "&id=".$id;

		$json 			= file_get_contents($apiEndPoint);
		$array 			= json_decode($json, true);

		return $array;
	}

	public function getMatchInfo(string $id)
	{
		$apiEndPoint 	= $this->apiEndPoint . "match_info?apikey=". $this->apiKey. "&id=".$id;

		$json 			= file_get_contents($apiEndPoint);
		$array 			= json_decode($json, true);

		return $array;
	}

	public function getScoreCard(string $id)
	{
		$apiEndPoint 	= $this->apiEndPoint."match_scorecard?apikey=". $this->apiKey. "&id=".$id;

		$json 			= file_get_contents($apiEndPoint);
		$array 			= json_decode($json, true);

		return $array;
	}
}