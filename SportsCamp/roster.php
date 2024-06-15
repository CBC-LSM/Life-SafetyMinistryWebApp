<?php
require_once '../database/load.php';
require_once '../PCO/common.php';
require_once '../PCO/redisConnection.php';
require_once '../PCO/redisFunctions.php';
require_once '../PCO/pcoFunctions.php';

$key = $_GET['locations'];

?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <style>
    body{
      background: #0DAFE0;
      font-size: 5vw;
    }
    #p1{
      font-size:10vw;
    }
    #childContainer{
      font-size: 5vw;
    }
  </style>
 
 <?php
if(isset($_GET['locations'])){
?>
<?php
}
?>
  <link rel="shortcut icon" href="#">
<title>SC Roster</title>
</head>
<body>
<?php
if(!isset($_GET['locations'])){
?>
<!-- <p>Locations Parameter not set.  Please add ?locations= followed by the location id's seperated by comma's to the end of the url.</0> -->
<div class="locationsList">
  <ul>
   <a href="roster.php?locations=1530694&Class=Archery%20Armadillos"><li>Archery Armadillos</li></a>
   <a href="roster.php?locations=1484670&Class=Blue%20Jays"><li>Blue Jays</li></a>
   <a href="roster.php?locations=1484678&Class=Cheering%20Cheetahs"><li>Cheering Cheetahs</li></a>
   <a href="roster.php?locations=1484674&Class=Crafty%20Camels"><li>Crafty Camels</li></a>
   <a href="roster.php?locations=1484671&Class=Green%20Hornets"><li>Green Hornets</li></a>
   <a href="roster.php?locations=1484672&Class=Orange%20Tigers"><li>Orange Tigers</li></a>
   <a href="roster.php?locations=1484677&Class=Photo%20Foxes"><li>Photo Foxes</li></a>
   <a href="roster.php?locations=1484673&Class=Purple%20Panthers"><li>Purple Panthers</li></a>
   <a href="roster.php?locations=1484669&Class=Red%20Hawks"><li>Red Hawks</li></a>
   <a href="roster.php?locations=1484668&Class=Yellow%20Jackets"><li>Yellow Jackets</li></a>
  </ul>
  </div>
<?php
}
?>
  <h1 id="p1"><?php echo $_GET['Class']?></h1><br>
<div id="childContainer">
<?php
$ReJsonData = $redis->get($key);
$ReJsonData = json_decode($ReJsonData,true);
$classroom = $ReJsonData['name'];
$datas = $ReJsonData['data'];
usort($datas, function ($a, $b) {
  return strcmp($a['first_name'], $b['first_name']);
});

// Step 2: Store the sorted data in a new array
$dataalphabetical = $datas;

// Step 3: Rewrite the foreach loop to use $dataalphabetical
foreach ($dataalphabetical as $data): ?>
  <?php echo ucfirst($data['first_name'] . " " . $data['last_name']); ?><br>
<?php endforeach; ?>
</div>
</body>
</html>

