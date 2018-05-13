<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
			

		<div id="listarea">
			<ul id="musiclist">
				<?php 
					$files = glob("songs/*.*");
					function getFilesize($file)
					{	
							$f = basename($file);
							$s = filesize("songs/".$f);
							if ($s>0 && $s<1024)
								return " (". $s ." bytes)";
							elseif($s>=1024 && $s<=1048575)
								return " (". round($s/1024) ." kb)";
							else 
								return " (". round($s/(1024*1024)) ." mb)";
					}

					if(empty($_REQUEST)){
						$arrMp3 = glob("songs/*.mp3");
						$arrTxt = glob("songs/*.txt");
						foreach ($arrMp3 as $item) { ?>
							<li class="mp3item">
								<a href="<?=$item?>">
									<?=basename($item).getFilesize($item)?>
								</a>
							</li>
				<?php } foreach ($arrTxt as $item) { ?>
							<li class="playlistitem">
								<a href="?playlist=<?=basename($item)?>">
									<?=basename($item).getFilesize($item)?>
								</a>
							</li>
				<?php 	} 
					} elseif ($_REQUEST["playlist"] == "mypicks.txt") {
						// $listMp3 = file("songs/mypicks.txt");
						$l = file_get_contents("songs/mypicks.txt");
						$listMp3 = explode(",", $l);
						foreach ($listMp3 as $item) { ?>
							<li class="mp3item">
								<a href="<?=$item?>"><?=basename($item)?></a>
							</li>
				<?php 	}
						
					} elseif ($_REQUEST["playlist"] == "playlist.txt") {
						$l = file_get_contents("songs/playlist.txt");
						$listMp3 = explode(",", $l);
						foreach ($listMp3 as $item) { ?>
							<li class="mp3item">
								<a href="<?=$item?>"><?=basename($item)?></a>
							</li>
				<?php 	}
					}?>

			

			</ul>
		</div>
	</body>
</html>
