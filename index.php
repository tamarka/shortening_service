
<html>
<head>
<link rel="stylesheet" href="shorten.css" type="text/css">
</head>
<body>
<?php
	require_once('encode.php');
	require_once('decode.php');
	session_start();
	$new_arr;

	function post()
	{
		$long_url="";
		$urlError="";
		global $new_arr;
		$key;
		$key1;
		if(isset($_POST['submit']))
		{
			if(isset($_POST['long_url'])&&!empty($_POST['long_url']))
			{
				$long_url=$_POST['long_url'];
				if(empty($_SESSION['long_url']))
				{
					$_SESSION['long_url']=array();
					array_push($_SESSION['long_url'], $long_url);
					$key=array_search($long_url, $_SESSION['long_url']);
					$_SESSION['long_url'];
					//print_r($_SESSION['long_url']);
					return fromLongtoShorten($key+1000);

				}
				else
				{
					$new_arr=$_SESSION['long_url'];
					if(in_array($long_url, $new_arr))
					{
						$key=array_search($long_url, $new_arr);
					}
					else
					{
						array_push($new_arr, $long_url);
						$key=array_search($long_url, $new_arr);
						$_SESSION['long_url']=$new_arr;
					}

					//print_r($new_arr);
					//echo $key;
					$key1 = fromLongtoShorten($key+1000);
					echo '<br/> This is shortened url: '.$key1;
					//return fromIdtoShorten($key);
				}
			}
			else
			{
				echo 'Enter the URL';
			}
		}
	}

	function get(){
		$id;
		$id2;
		if(isset($_GET['submit1']))
		{
			if(isset($_GET['id'])&&!empty($_GET['id']))
			{
				$id=$_GET['id'];
				$id2=fromShortToLong($id);
				$id2=$id2-1000;
				if(array_key_exists($id2, $_SESSION['long_url'])!==false)
				{
					foreach ($_SESSION['long_url'] as $key => $value)
					{
						if($key==$id2)
						{
							$url=$value;
						}

					}
					header('Location: http://'. $url);
					exit();

				}
				else
				{
					header('Location: /404page.html');
					exit();
				}
			}
		}
	}
?>

<form method="POST" action="index.php">
Enter URL: <input type="text" name="long_url">
<input type="submit" value="Shorten link" name="submit"><br/>
<span><?php post();?></span><br/>
</form>
<form method="GET" action="index.php">
Enter id: <input type="text" name="id">
<input type="submit" value="Find long URL" name="submit1"><br/>
<span><?php get();?></span><br/>
</form>
</body>
</html>

