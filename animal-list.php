<?php
include 'connection.php';
$sql = "SELECT count('id') as count_visitor FROM visitor";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
	$count = $row['count_visitor'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
form{
	width:450px;
}
a{
	text-decoration:none;
	color:black;
	
}
.up-arrow {
    width: 0;
    height: 0;
    border: solid 3px transparent;
    background: transparent;
    border-bottom: solid 6px black;
    border-top-width: 0;
    cursor: pointer;
	
}

.down-arrow {
    width: 0;
    height: 0;
    border: solid 3px transparent;
    background: transparent;
    border-top: solid 6px black;
    border-bottom-width: 0;
    margin-top:1px;
    cursor: pointer;

}
@media only  screen and (max-width :768px){
		form{
	width:auto;
}
	}
</style>
<body>
<div class="container col-md-8" style="overflow-x:auto;">
<center><h4><?php echo "Total Visitors : ".$count; ?></h4></center>

 <form  action="" method="post"  enctype="multipart/form-data" style="margin-top:50px;">

          <div class="row">  
		  <div class="col">
             <select name="cat" class="custom-select mb-3" />
      <option selected>Category</option>
      <option value="Herbivores">Herbivores</option>
      <option value="Omnivores">Omnivores</option>
      <option value="Carnivores0">Carnivores</option>
        
    </select></div>
           
            <div class="col" style="float:right;">
             <select name="span" class="custom-select mb-3" />
      <option selected>Life Expectancy</option>
      <option value="0-1">0-1 years</option>
      <option value="1-5">1-5 years</option>
      <option value="5-10">5-10 years</option>
          <option value="10+">10+ years</option>
    </select>
      </div>
<div class="col">
<center><button class="btn btn-primary solid blank" id="filter" name="filter" type="submit" style="float:left;">Filter</button></center>
</div>
	</div>    
 </form>
 <div style="overflow-x:auto;">
	<table id='data_table' class="table table-striped table-hover table-bordered sortable" id="demo" style="margin-top:10px;">
							<thead>
							<tr>

								<th>
									<a href="animal-list.php?sort=asc"><div class="up-arrow"></div></a>Name
									<a href="animal-list.php?sort=desc"><div class="down-arrow"></div></a>
									
								</th> 
								<th>
									Category
								</th>
								<th id="cell">
									Image
								</th>
								<th>
									Description
								</th>
								<th>
									Life span
								</th>
								<th>
									<a href="animal-list.php?date=asc"><div class="up-arrow"></div></a>Date
									<a href="animal-list.php?date=desc"><div class="down-arrow"></div></a>
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if(isset($_POST['filter']) && isset($_POST['span']) && isset($_POST['cat'])){
								$span=$_POST['span'];
								$cat=$_POST['cat'];
								$sql1 = "SELECT * FROM info where `category` = '$cat' and `life-span` = '$span' ORDER BY id DESC";
								$result = mysqli_query($conn,$sql1);
							}else if(isset($_POST['filter']) && isset($_POST['span'])) {
								$span=$_POST['span'];
								$sql2 = "SELECT * FROM info where `life-span` = '$span' ORDER BY id DESC";
								$result = mysqli_query($conn,$sql2);
							}
							else if(isset($_POST['cat']) && isset($_POST['filter'])) {
								$cat=$_POST['cat'];
								$sql3 = "SELECT * FROM info where `category` = '$cat' ORDER BY id DESC";
								$result = mysqli_query($conn,$sql3);
							}
							else if(isset($_GET['sort'])){
								$sort = $_GET['sort'];	
								$sql4 = "SELECT * FROM info ORDER BY name $sort";
								$result = mysqli_query($conn,$sql4);
							}
							else if(isset($_GET['date'])){
								$date = $_GET['date'];
								$sql5 = "SELECT * FROM info ORDER BY date $date";
								$result = mysqli_query($conn,$sql5);
							}
							else{
							
							$sql = "SELECT * FROM info ORDER BY id DESC";
							$result = mysqli_query($conn,$sql);
							}
							while($row = mysqli_fetch_array($result)) {
							$name = $row['name'];
							$cat = $row['category'];
							$image=$row['image'];
							$desc=$row['description'];
							$span=$row['life-span'];
							$date=$row['date'];
							?>
							
							
							<td><?php echo $name; ?></td>
							<td><?php echo $cat; ?></td>
							
								<td>
									 <?php
									 
									  $dirname = "uploads/";
                                        $images = glob($dirname."*.{jpg,gif,png,jpeg}",GLOB_BRACE);

                                         foreach($images as $pic) {
                                             if($pic == 'uploads/'.$image){
                                                 
                                                 echo '<img src="'.$pic.'" style="width:auto;height:100px" />';
                                               
                                          }
									 }
									 ?>
								</td>
								<td><?php echo $desc; ?></td>
								<td><?php echo $span; ?></td>
								<td><?php echo $date; ?></td>
							</tr>
							
							
							<?php
							}
							?>
							</tbody>
							</table></div></div>
						</div>
						
						
						
					</body>
						</html>