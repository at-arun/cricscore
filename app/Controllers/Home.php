<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {

    }
    public function index($page = 0)
    {
        $page = (int) $page;

		try
		{
			$cricapi = \Config\Services::cricapi();
		}
		catch(\Exception $e)
		{
			// var_dump($e->getMessage());
		}
    	
        $offset = ($page > 1) ? (($page - 1) * 25) + 1 : 0;
    	$allSeries = $cricapi->getAllSeries($offset);

        $meta = $allSeries['info'];

        $totalResult    = $meta['totalRows'];
        $currentPage    = $meta['offsetRows'];
        $perPage        = 25;

        $pager          = \Config\Services::pager();

        $data['series'] = $allSeries;
        $data['pager']  = $pager;
        $data['total'] = $totalResult;
        $data['page'] = $currentPage +1;
        $data['perPage'] = $perPage;
        $data['segment'] = 2;

        helper('html');

       	echo view('templates/header');
        echo view('home', $data);
        echo view('templates/footer');
    }

    public function searchSeries($page = 0)
    {
        $search = $this->request->getVar('search');

        $search = urlencode($search);

        $page = (int) $page;

        try
        {
            $cricapi = \Config\Services::cricapi();
        }
        catch(\Exception $e)
        {
            // var_dump($e->getMessage());
        }
        
        $offset = ($page > 1) ? (($page - 1) * 25) + 1 : 0;
        $allSeries = $cricapi->searchSeries($search, $offset);

        $meta = $allSeries['info'];

        $totalResult    = $meta['totalRows'];
        $currentPage    = $meta['offsetRows'];
        $perPage        = 25;

        $pager          = \Config\Services::pager();

        $data['series'] = $allSeries;
        $data['pager']  = $pager;
        $data['total'] = $totalResult;
        $data['page'] = $currentPage;
        $data['perPage'] = $perPage;
        $data['segment'] = 2;

        helper('html');

        echo view('templates/header');
        echo view('home', $data);
        echo view('templates/footer');
    }
}
