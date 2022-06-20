<?php
namespace App\Controllers;

class Series extends BaseController
{
	public function view($id)
	{
		try
		{
			$cricapi = \Config\Services::cricapi();
		}
		catch(\Exception $e)
		{
			// var_dump($e->getMessage());
		}
 
    	$result = $cricapi->getSeriesInfo($id);
    	$seriesInfo = $result['data']['info'];
    	$matches = $result['data']['matchList'];

    	$data['seriesInfo'] = $seriesInfo;

    	$data['matches'] = $matches;

		helper('html');

    	echo view('templates/header');
        echo view('Series/seriesInfo', $data);
        echo view('templates/footer');
	}

	public function matchInfo($id)
	{
		try
		{
			$cricapi = \Config\Services::cricapi();
			$result = $cricapi->getMatchInfo($id);
		}
		catch(\Exception $e)
		{
			// var_dump($e->getMessage());
		}

		$data['matchInfo'] = $result['data'];

		helper('html');

    	echo view('templates/header');
        echo view('Series/matchInfo', $data);
        echo view('templates/footer');
	}
}