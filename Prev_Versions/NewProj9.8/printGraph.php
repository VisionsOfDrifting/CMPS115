<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();

$query = "SELECT first_name, last_name  FROM users WHERE active= 1";
$temp = "";
if ($result = $mysqli->query($query)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
       $temp =  $row[0]. ' ' .$row[1];
	}
    /* free result set */
    $result->close();
}
?>

<!DOCTYPE html>
<html>
   <head>
      <script src="plotly-latest.min.js"> //this is what gets the graph lib</script>
   </head>
<title>BudgetTrace</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="WebContent.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">BudgetTrace</a>
    <a href="description.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Description of the Project</a>
    <a href="teamProj.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Team Project</a>
    <a href="contact.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
   
  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;margin-top:43px;" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>
  <a class="w3-bar-item w3-button w3-hover-black" href="WebContent.php">Home</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="profile.php">Profile</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="insertBudget.php">Update Budget</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="printTable.php">Print your Budget</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="datePrint.php">Print by Date</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="printCategory.php">Print by Category</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="printGraph.php" >Graph your Budget</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="insertTransaction.php">Insert New Transaction</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="deleteTrans.php">Delete Transaction</a>
  <a class="w3-bar-item w3-button w3-hover-black" href="logout.php">Logout</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
  <div class="w3-twothird w3-container">
	  
      <title>This is your Budget Table</title>

          
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ir";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT tr_name FROM budget WHERE name = '$temp'"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $result_array = Array();
    foreach(new RecursiveArrayIterator(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        $result_array[] = $v;
    }
    //convert the PHP array into JSON format, so it works with javascript  , , 
    $json_tr_names = json_encode($result_array);
    //some magic between php and javascript
    
    $stmt2 = $conn->prepare("SELECT tr_type FROM budget WHERE name = '$temp'"); 
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $result_array2 = Array();
    foreach(new RecursiveArrayIterator(new RecursiveArrayIterator($stmt2->fetchAll())) as $k=>$v) { 
        $result_array2[] = $v;
    }
    //convert the PHP array into JSON format, so it works with javascript  , , 
    $json_tr_types = json_encode($result_array2);
    
    $stmt3 = $conn->prepare("SELECT tr_cost FROM budget WHERE name = '$temp'"); 
    $stmt3->execute();
    $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $result_array3 = Array();
    foreach(new RecursiveArrayIterator(new RecursiveArrayIterator($stmt3->fetchAll())) as $k=>$v) { 
        $result_array3[] = $v;
    }
    //convert the PHP array into JSON format, so it works with javascript  , , 
    $json_tr_costs = json_encode($result_array3);
    $stmt4 = $conn->prepare("SELECT date FROM budget WHERE name = '$temp'"); 
    $stmt4->execute();
    $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
    $result_array4 = Array();
    foreach(new RecursiveArrayIterator(new RecursiveArrayIterator($stmt4->fetchAll())) as $k=>$v) { 
        $result_array4[] = $v;
    }
    //convert the PHP array into JSON format, so it works with javascript  , , 
    $json_dates = json_encode($result_array4);
    
    $stmt5 = $conn->prepare("SELECT total FROM budget WHERE name = '$temp'"); 
    $stmt5->execute();
    $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
    $result_array5 = Array();
    foreach(new RecursiveArrayIterator(new RecursiveArrayIterator($stmt5->fetchAll())) as $k=>$v) { 
        $result_array5[] = $v;
    }
    $json_total = json_encode($result_array5);
      
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
      
<script>
      //var tr_names = <?php echo $json_tr_names; ?>;
      //document.write(<?php echo json_encode($json_dates); ?>);
</script>
      
      <div class="form">
      <p>Date vs Cost (Bar)</p>
      <p id="demo"></p>
      <p id="demo2"></p>
      <p id="demo3"></p>
      <p id="demo4"></p>
      <div id="tester" style="width:1100px;height:450px;"></div>
      <div id="spacer" style="width:600px;height:250px;"></div>
      <p>Percent by Transaction Type (Pie)</p>
      <div id="tester2" style="width:600px;height:250px;"></div>
      <div id="spacer2" style="width:600px;height:250px;"></div>
      <p>Date vs Cost (Scatter)</p>
      <div id="tester3" style="width:1100px;height:450px;"></div>
      <p>Transactions vs Budget (Scatter)</p>
      <div id="tester4" style="width:1100px;height:450px;"></div>
      <p id="demo5"></p>
      <p id="demo6"></p>
      <p id="demo7"></p>
          
<script>
    //now put it into the javascript
    var tr_names = <?php echo json_encode($json_tr_names); ?>;
    var tr_types = <?php echo json_encode($json_tr_types); ?>;
    var tr_costs = <?php echo json_encode($json_tr_costs); ?>;   
    var tr_dates = <?php echo json_encode($json_dates); ?>;
    var tr_total = <?php echo json_encode($json_total); ?>;
    //eyyyyyyy!!!!!
    //sort of...
    //str = JSON.stringify(tr_names, null, 4); 
  /*document.writeln(typeof tr_names);
    document.writeln(tr_names);
    document.write(typeof tr_types);
    document.write(tr_types);
    document.write(typeof tr_costs);
    document.write(tr_costs);
    document.write(typeof tr_dates);
    document.write(tr_dates);*/
    var resl = tr_names.substring(1,tr_names.length-1);
    //document.writeln(typeof resl);
    //document.writeln(resl);
    var res = resl.split("{\"tr_name\":\"");
    //document.writeln(typeof res);
    //document.writeln(res);
    var re = [];
    //document.writeln(res.length);
    for (var i = 1; i < res.length; i++) {
       re[i-1] = res[i].substring(0,res[i].indexOf("\""));}
    var Re = [];
    for (var i = 1; i < res.length; i++) {
       Re[i-1] = re[i];}
    //document.writeln(typeof re);
   // document.writeln(Re);
    //hot damn
    //document.getElementById("demo").innerHTML = re;
    
    var resl2 = tr_types.substring(1,tr_types.length-1);
    var res2 = resl2.split("{\"tr_type\":\"");
    var re2 = [];
    for (var i = 1; i < res2.length; i++) {
       re2[i-1] = res2[i].substring(0,res2[i].indexOf("\""));}
    //document.getElementById("demo2").innerHTML = re2;
    
    
    var resl3 = tr_costs.substring(1,tr_costs.length-1);
    //document.getElementById("demo5").innerHTML = resl3;
    var res3 = resl3.split("{\"tr_cost\":\"");
    //document.getElementById("demo6").innerHTML = res3;
    var re3 = [];
    for (var i = 1; i < res3.length; i++) {
        if(res3[i].substring(0,1) == "-"){ 
            re3[i-1] = res3[i].substring(1,res3[i].indexOf("\""));
        }else{
            re3[i-1] = "0";}}
    //document.getElementById("demo7").innerHTML = re3;
    
    var resl4 = tr_dates.substring(1,tr_dates.length-1);
    //document.writeln(typeof resl4);
    //document.writeln(resl4);
    var res4 = resl4.split("{\"date\":\"");
    //document.writeln(typeof res4);
    //document.writeln(res4);
    var re4 = [];
    //document.writeln(res4.length);
    for (var i = 1; i < res4.length; i++) {
        var temp = res4[i].substring(0,res4[i].indexOf("\""));
        re4[i-1] = temp.replace(/\\\//g, "-")
    }
     //document.writeln(re4);
    
    var resl5 = tr_total.substring(1,tr_total.length-1);
    var res5 = resl5.split("{\"total\":\"");
    var re5 = [];
    for (var i = 1; i < res5.length; i++) {
       re5[i-1] = res5[i].substring(0,res5[i].indexOf("\""));}
    //document.getElementById("demo3").innerHTML = re5;
    // document.writeln(re5);
    //document.writeln(typeof re4);
    //document.writeln(re4);
    //document.getElementById("demo4").innerHTML = re4;
    
    
    var cost_Type = [];
    var sum_Type= [];
    cost_Type.push(re2[0]);
    sum_Type[0] = Number(0);
    loop1:
    for (var i = 0; i < re2.length; i++) {
        loop2:
        for (var j = 0; j < cost_Type.length; j++) {
            if(re2[i] == cost_Type[j]){
                sum_Type[j] += Number(re3[i]);
                continue loop1;
            }else if((j+1) == cost_Type.length){ 
                cost_Type.push(re2[i]);
                sum_Type.push(Number(0));
            }
         }
    }
    //document.write(cost_Type);
    //document.write(sum_Type);
    
    //some magic with js libs
    //and we have graphs
    TESTER = document.getElementById('tester');
    Plotly.plot( TESTER, [{
    x: re4,
    y: re3,
    text: Re,
    type: 'bar'}], {
    barmode: 'relative',
    margin: { t: 0 } } );
    
    TESTER2 = document.getElementById('tester2');
    Plotly.plot( TESTER2, [{
    values: sum_Type,
    labels: cost_Type,
    type: 'pie'}], {
    height: 400,
    width: 500
    } );
   
    TESTER3 = document.getElementById('tester3');
    Plotly.plot( TESTER3, [{
    x: re4,
    y: re3,
    text: Re,
    mode: 'markers'}], { 
    margin: { t: 0 } } );
    
    var transNum = [];
    for (var i = 0; i < Re.length; i++) {
        transNum[i] = i+1;
        }
    //document.writeln(transNum);
    TESTER4 = document.getElementById('tester4');
    Plotly.plot( TESTER4, [{
    x: transNum,
    y: re3,
    text: Re,
    name: "Transactions",
    fill: 'tozeroy',
    type: 'scatter',
    mode: 'markers'},{
    x: transNum,
    y: re5,
    name: "Budget",
    fill: 'tozeroy',
    type: 'scatter',
    mode: 'none'}], { 
    yaxis: {title: 'Dollar Ammount'},
    xaxis: {title: 'Transaction Number'},
    margin: { t: 0 } } );
    
   /*  var Trace = function(Dates,Total_onDate,Type) {
        x: Dates,
        y: Total_onDate,
        name: Type,
        type: 'bar'
    };*/
    /*var Ntr = [];
    
    
    var layout = {
    xaxis: {title: 'X axis'},
    yaxis: {title: 'Y axis'},
    barmode: 'relative',
    title: 'Relative Barmode'
    };
    Plotly.plot('myDiv', data, layout);*/
    
    //var trace = new Trace(re4,re3, );
   // var layout = { margin: { t: 0 } };
   // Ploty.plot(TESTER3, data, layout);
</script>

</div>
</div>
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
  
  
 <!-- <div class="w3-row">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Heading</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
        dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div class="w3-third w3-container">
      <p class="w3-border w3-padding-large w3-padding-32 w3-center">AD</p>
      <p class="w3-border w3-padding-large w3-padding-64 w3-center">AD</p>
    </div>
  </div> -->

<!-- END MAIN -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>


