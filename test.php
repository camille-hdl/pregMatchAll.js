<?php
$tests = array(
	0 => array(
		"pattern" => "/ *([a-zA-Z0-9\-]+) *: *([^;]*)/",
		"subject" => "X-MyHeader: MyValue; X-AZE: adqdsdfff;USERAGENT: Chrome123123 é'",
		"flag" => "PREG_SET_ORDER",
		"offset" => false,
		"nbP" => 2
	),
	1 => array(
		"pattern" => "/^def/",
		"subject" => "abcdef",
		"flag" => "PREG_OFFSET_CAPTURE",
		"offset" => 3,
		"nbP" => 0
	),
	2 => array(
		"pattern" => "/def/",
		"subject" => "abcdef",
		"flag" => "PREG_PATTERN_ORDER",
		"offset" => false,
		"nbP" => 0
	),
	3 => array(
		"pattern" => "/def/",
		"subject" => "abcdef",
		"flag" => "PREG_OFFSET_CAPTURE",
		"offset" => false,
		"nbP" => 0
	),
	4 => array(
		"pattern" => "/ *([a-zA-Z0-9\-]+) *: *([^;]*)/",
		"subject" => "X-MyHeader: MyValue; X-AZE: adqdsdfff;USERAGENT: Chrome123123 é'",
		"flag" => "PREG_OFFSET_CAPTURE",
		"offset" => false,
		"nbP" => 2
	),
	5 => array(
		"pattern" => "/ *([a-zA-Z0-9\-]+) *: *([^;]*)/",
		"subject" => "X-MyHeader: MyValue; X-AZE: adqdsdfff;USERAGENT: Chrome123123 é'",
		"flag" => "PREG_PATTERN_ORDER",
		"offset" => false,
		"nbP" => 2
	),
	6 => array(
		"pattern" => "/<body>([a-z0-9]+?)<\/body>/",
		"subject" => "<body>azeazeaze</body><body></body>",
		"flag" => "PREG_PATTERN_ORDER",
		"offset" => false,
		"nbP" => 1
	),
	7 => array(
		"pattern" => "/<body>([a-z0-9]+)<\/body>/",
		"subject" => "<azeazdy>",
		"flag" => "PREG_PATTERN_ORDER",
		"offset" => false,
		"nbP" => 1
	),
	8 => array(
		"pattern" => "/^def/",
		"subject" => "abcdef",
		"flag" => "PREG_SET_ORDER",
		"offset" => 3,
		"nbP" => 0
	),
	9 => array(
		"pattern" => "/<body>([a-z0-9]+)<\/body>/",
		"subject" => "<azeazdy>",
		"flag" => "PREG_SET_ORDER",
		"offset" => false,
		"nbP" => 1
	)
);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tests</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			table tr td {
				border:solid #C0C0C0 1px;
				max-width:900px;
				overflow-x:auto;
			}
			table tr th {
				font-weight:bold;
				border : solid black 1px;
			}
		</style>
    </head>
    <body>
		<script type="text/javascript" src="pregmatchall.js"></script>
		<table cellspacing="0">
			<tr>
				<th>#</th>
				<th>PHP $matches (json encoded)</th>
				<th>JS matches (JSON.stringify())</th>
			</tr>
		<?php
	
		foreach($tests as $n => $test):
			$flag = constant($test['flag']);
			if($test['offset']!==false) {
				preg_match_all($test['pattern']."s",$test['subject'],$matches,$flag,$test['offset']);
			}
			else {
				preg_match_all($test['pattern']."s",$test['subject'],$matches,$flag);
			}
			?>
			<tr>
				<td><?php echo $n; ?></td>
				<td><pre id="php_output_<?php echo $n; ?>"><?php echo json_encode($matches); ?></pre></td>
				<td><pre id="js_output_<?php echo $n; ?>"></pre></td>
			</tr>
			<?php
		endforeach;
		?>
		</table>
		<script type="text/javascript">
			
			document.addEventListener("DOMContentLoaded",function() {
				<?php // i'm doing this because I want to test with the RegExp literal
					  // I'm not using <?= tags because my local server cfg sucks.
					foreach($tests as $n => $test):
						?>
						var matches_<?php echo $n; ?> = jsPregMatchAll(<?php echo $test['pattern']."gm"; ?>,"<?php echo $test['subject']; ?>","<?php echo $test['flag']; ?>",<?php echo $test['nbP']; ?><?php if($test['offset']) echo ",".$test['offset']; ?>);
					   
						document.getElementById("js_output_<?php echo $n; ?>").innerHTML = JSON.stringify(matches_<?php echo $n; ?>);
						
						<?php
					endforeach;
				?>
			},false);
		</script>
		<?php
		/*6 => array(
		"pattern" => "/<body>([a-z0-9]+?)<\\/body>/",
		"subject" => "<body>azeazeaze</body><body></body>",
		"flag" => "PREG_PATTERN_ORDER",
		"offset" => false,
		"nbP" => 1
	),*/
		preg_match_all("/<body>([a-z0-9]+?)<\/body>/", "<body>azeazeaze</body><body></body>",$matches,PREG_PATTERN_ORDER);
		echo "<pre>";
		var_dump($matches);
		echo "</pre>";
		?>
	</body>
</html>