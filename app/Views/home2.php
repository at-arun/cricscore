<?php
if (empty($series))
{
	echo "No data";
	exit();
}
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
  </ol>
</nav>

<?php
$list = "";
foreach ($series['data'] as $key => $value)
{
	$seriesName = esc($value['name']);
	$seriesId 	= $value['id'];
	$list .= "<li><a href='/seriesInfo/$seriesId'>".$key.'-'.$seriesName."</a></li>";
}

?>

<ul>
	<?=$list; ?>
</ul>

<?= $pager->makeLinks($page, $perPage, $total, 'bootstrap', 2); ?>
