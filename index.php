

<?php
   $bsei="00.00";
   $nsei=000.00;
session_start();// Include config file
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  
}
else{
  header("location: login.php");

}
require_once "config.php";
if(isset($_POST['submit'])){

  $stockname=mysqli_real_escape_string($link,$_POST['stockname']);
  $quantity=mysqli_real_escape_string($link,$_POST['quantity']);
  $stockexchange=mysqli_real_escape_string($link,$_POST['stockexchange']);
  $marketprice=mysqli_real_escape_string($link,$_POST['marketprice']);
  $product=mysqli_real_escape_string($link,$_POST['product']);
 // echo $stockname;

 $username=$_SESSION["username"];
  $iquery="insert into addstock ( stockname, quantity, stockexchange, marketprice, products,username)
           values('$stockname','$quantity' ,'$stockexchange','$marketprice','$product','$username')";
            mysqli_query($link,$iquery);
            
           
         
}

?>

<?php
if(isset($_POST['sell'])){

$stockname=mysqli_real_escape_string($link,$_POST['stockname']);
//$quantity=mysqli_real_escape_string($link,$_POST['quantity']);
$stockexchange=mysqli_real_escape_string($link,$_POST['stockexchange']);
$marketprice=mysqli_real_escape_string($link,$_POST['marketprice']);
$product=mysqli_real_escape_string($link,$_POST['product']);
// echo $stockname;

$username=$_SESSION["username"];

  $sql="select * from addstock where  username='$username' and stockname='$stockname' and products='$product' and stockexchange='$stockexchange'";
  $result=mysqli_query($link,$sql);
        $num=mysqli_num_rows($result);
      if($num>=1){
                      
        $value = mysqli_fetch_object($result);
       // echo $value->id;
        $id=$value->id;
        $sql="delete  from addstock where  id='$id'";
        $result=mysqli_query($link,$sql); 
        
        $iquery="insert into sell( stockname, stockexchange, targetprice, product,username)
         values('$stockname','$stockexchange','$marketprice','$product','$username')";
        mysqli_query($link,$iquery);
        
      
      }else{

           echo "<script>  alert('no stock avilable') </script>";
      
      }
    
    
          
         
       
}

?>


<html>
    <head>
        <title>
            home
        </title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <div class="Container-fluid">
        
            <nav>
                <div class="nav nav-tabs shadow-sm p-3 mb-5" id="nav-tab" role="tablist">
                  <a class="nav-link active brand" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">BUY </a>
                  <a class="nav-link" id="nav-setting-tab" data-bs-toggle="tab" href="#nav-setting" role="tab" aria-controls="nav-setting" aria-selected="false">SELL</a>
                  <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Portfolio</a>
                  <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Insight</a>
                  <a class="nav-link" id="nav-chat-tab" data-bs-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Histroy</a>
                  
                  
                 <?php   
                          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                            echo "<a class='nav-link '  id='nav-message-tab' data-bs-toggle='tab' href='#nav-message' role='tab' aria-controls='nav-message' aria-selected='false'> <i class='fa fa-user-circle-o' aria-hidden='true'></i>
                            ".$_SESSION['username'];"</a>";
                            echo '<a class="  nav-link float-right" id="nav-contact-tab "  href="logout.php" role="tab" >Logout</a>';
                          
                          }
                          else {
                            echo "<a class='nav-link' id='nav-contact-tab '  href='login.php' role='tab' >Login</a>";
                                  }
                           
                  ?>
                </div>
              </nav>
          
            


              <div class="container">
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                <div class="col-sm-8">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                        <div class="form-group row">
                          <label for="Stock Name" class="col-sm-2 col-form-label">Stock Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3"  name="stockname" placeholder="Enter the stock name" required>
                          </div>
                        </div>
                        <div class="form-group row mt-3">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Quantity</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity"id="inputPassword3" placeholder="Enter the Quantity" required>
                          </div>
                        </div>
                        <fieldset class="form-group">
                          <div class="row mt-3">
                            <legend class="col-form-label col-sm-2 pt-0" > Stock Exchange</legend>
                            <div class="col-sm-10">
                              <div class="form-check" required>
                                <input class="form-check-input" type="radio" name="stockexchange" id="gridRadios1" value="NSE" checked>
                                <label class="form-check-label" for="stockexchange">
                                  NSE
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="stockexchange" id="gridRadios2" value="BSE">
                                <label class="form-check-label" for="stockexchange">
                                  BSE
                                </label>
                              </div>
                             
                        </fieldset>
                        <div class="form-group row mt-3" >
                            <label for="Stock Name" class="col-sm-2 col-form-label">Market price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputEmail3" name="marketprice" placeholder="Enter the latest traded Price">
                            </div>
                          </div>
                          <div class="form-group row mt-3">
                            <label for="inputPassword3" class="col-sm-2 col-form-label ">Product</label>
                            <div class="col-sm-10">
                                <select class="form-select mt-3" name="product"aria-label="Default select example">
                                    <option selected> Product Type</option>
                                    <option value="Intraday">Intraday</option>
                                    <option value="Delivery">Delivery</option>
                                 
                                  </select>  
                            </div>
                          </div>
                    
                          <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                </div></div>
                    
                        <div class="form-group row mt-5">
                         <div class="col-sm-2"></div>
                          <div class="col-sm-4">
                          <input type="submit"  name="submit" class="btn btn-primary" value="BUY">
                          </div>
                        </div>

                      </form>
                    </div>
                    
                    
                    
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="nav-setting" role="tabpanel" aria-labelledby="nav-setting-tab">
                                     <div class="container">
                                           <div class="row">
                                              <div class="col-sm-8">
                                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


<div class="form-group row">
  <label for="Stock Name" class="col-sm-2 col-form-label">Stock Name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="inputEmail3"  name="stockname" placeholder="Enter the stock name" required>
  </div>
</div>

<fieldset class="form-group">
  <div class="row mt-3">
    <legend class="col-form-label col-sm-2 pt-0" > Stock Exchange</legend>
    <div class="col-sm-10">
      <div class="form-check" required>
        <input class="form-check-input" type="radio" name="stockexchange" id="gridRadios1" value="NSE" checked>
        <label class="form-check-label" for="stockexchange">
          NSE
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="stockexchange" id="gridRadios2" value="BSE">
        <label class="form-check-label" for="stockexchange">
          BSE
        </label>
      </div>
     
</fieldset>
<div class="form-group row mt-3" >
    <label for="Stock Name" class="col-sm-2 col-form-label">Target price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail3" name="marketprice" placeholder="Enter target Price">
    </div>
  </div>
  <div class="form-group row mt-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label ">Product</label>
    <div class="col-sm-10">
        <select class="form-select mt-3" name="product"aria-label="Default select example">
            <option selected> Product Type</option>
            <option value="Intraday">Intraday</option>
            <option value="Delivery">Delivery</option>
         
          </select>  
    </div>
  </div>

  <div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
</div></div>

<div class="form-group row mt-5">
  <div class="col-sm-10">
  <input type="submit"  name="sell" class="btn btn-danger" value="SELL">
  </div>
</div>

</form>


                                              </div>
                                           </div>
                                     </div>
                      </div>
                                <div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
                                     <div class="container">
                                           <div class="row">
                                              <div class="col-sm-10">
                                              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Stock Name</th>
     
      <th scope="col">Exchange</th>
       <th scope="col">Price </th>
      <th scope="col">Product</th>
  

    </tr>
  </thead>
  <tbody>
    
<?php
 $username=$_SESSION["username"];
 $sql = "SELECT *  FROM  sell  where username='$username'";                  
 
 $result=mysqli_query($link,$sql);
 $num=mysqli_num_rows($result);
if($num>=1){
         $count=1;      
 while($value = mysqli_fetch_object($result)){
   
     echo "<th scope='row'>".$count++."</th>";
      echo "<td>";
      echo $value->stockname;
       echo "</td>";
       
    
       echo "<td>";
       echo $value->stockexchange;
        echo "</td>";
    
        echo "<td>";
        echo $value->targetprice;
         echo "</td>";
    
         echo "<td>";
         echo $value->product;
          echo "</td>";
       
         
           

      
     
    echo "</tr>";
 }
}
    echo "</tbody>";
   echo "</table>";
                    
        ?>            
                    
                    
                    
                                           

                                              </div>
                                           </div>
                                     </div>
                                </div>
                  






                <div class="tab-pane fade" id="nav-message" role="tabpanel" aria-labelledby="nav-message-tab">

                <?php
                $username=$_SESSION["username"];
                $sql = "SELECT *  FROM  user  where username='$username'";                  
                
                $result=mysqli_query($link,$sql);
                $num=mysqli_num_rows($result);
                $value=mysqli_fetch_object($result);
                ?>
                                     <div class="container">
                                           <div class="row">
                                              <div class="col-sm-4"></div>
                                           <div class="col-sm-4 shadow p-3 mb-5"> 
                                             <div class="userProfile">

                                   <div class="icon"><img src="user.svg" width="150px;" style="margin-left:115px;" alt=""></div>  
                                  <div class="userdetails">
                                         <div class="tabs shadow p-2 mb-3 " id="userid"> <i class="fa fa-at "></i>  <?php echo $value->username; ?> </div>
                                         <div class="tabs shadow p-2 mb-3 " id="userid"> <i class="fa fa-user "></i>  <?php echo $value->fname; echo "__"; echo $value->lname; ?></div>
                                         <div class="tabs shadow p-2 mb-3 " id="userid"> <i class="fa fa-mars "></i>  <?php echo $value->gender; ?></div>
                                       
                                         <div class="tabs shadow p-2 mb-3 "id="userid">  <i class="fa fa-mobile "></i>  <?php echo $value->mobile; ?></div>
                                         <div class="tabs shadow p-2 mb-3 "id="userid"> <i class="fa fa-envelope-open "></i> <?php echo $value->email; ?></div>
                                         <div class="tabs shadow p-2 mb-3 "id="userid"> <i class="fa fa-globe "></i>  <?php echo $value->address; ?></div>
                                  </div>
                                  <div class="row mt-5">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2"> </div>
                                    <div class="col-sm-6"> <button class="btn btn-danger" href="logout.php" >

                                    <?php    echo '<a class="btn btn-danger" id="nav-contact-tab "  href="logout.php" role="tab" >Logout</a>';
                           
                                    ?>
                                    </button> </div>
                                  </div>






                                           </div></div>
                                           <div class="col-sm-4">

                                           </div>


                                           </div>
                                     </div>




                                </div>
                  
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                       
                     
                    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Stock Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Exchange</th>
       <th scope="col">Price </th>
      <th scope="col">Product</th>
  

    </tr>
  </thead>
  <tbody>
    
<?php
 $username=$_SESSION["username"];
 $sql = "SELECT *  FROM  addstock  where username='$username'";                  
 
 $result=mysqli_query($link,$sql);
 $num=mysqli_num_rows($result);
if($num>=1){
         $count=1;      
 while($value = mysqli_fetch_object($result)){
   
     echo "<th scope='row'>".$count++."</th>";
      echo "<td>";
      echo $value->stockname;
       echo "</td>";
       echo "<td>";
      echo $value->quantity;
       echo "</td>";
    
       echo "<td>";
       echo $value->stockexchange;
        echo "</td>";
    
        echo "<td>";
        echo $value->marketprice;
         echo "</td>";
    
         echo "<td>";
         echo $value->products;
          echo "</td>";
       
         
           

      
     
    echo "</tr>";
 }
}
    echo "</tbody>";
   echo "</table>";
                    
        ?>            
                    
                    
                    </div>
                    


                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class='container'> 
                   <div class="row"> 
                     <div class="col-6 ">
                    <div class="card  shadow-sm p-3 mb-5" style="width: 18rem;">
                                  <div class="card-body" style="font-size:40px;">
                                       <h5 class="card-title"> Investment In NSE </h5>
                                      
                                        <p class="card-text text-success"> <i class="fa fa-inr" aria-hidden="true"></i> 
                                        <?php
                                      //  $sql = "SELECT *  FROM  NSE " ;
                                        //echo $value;
                                        
                                       
                                        $sql = "SELECT sum(marketprice * quantity)  As sumv FROM  addstock where stockexchange='NSE' and username='$username' " ;
                                        $result=mysqli_query($link,$sql);                                
                                        $num=mysqli_num_rows($result);
                                       if($num>=1){
                                                $value = mysqli_fetch_object($result);
                                               if( $value->sumv){
                                                 echo $value->sumv;
                                                  $nsei=$value->sumv;
                                               }else{
                                                  echo "00.00";
                                               }
                                       }else{
                                         echo "00.00";
                                       }
                                          
                                          ?>    

                                        
                                        </p>
                                       
                                  </div>
                     </div>
                    </div>

                    <div class="col-6">
                      <div class="card  shadow-sm p-3 mb-5" style="width: 18rem;">
                                    <div class="card-body">
                                         <h5 class="card-title"> Investment In BSE</h5>
                                          <h6 class="card-subtitle mb-2 text-muted"></h6>
                                          <p class="card-text text-success " style="font-size:40px;"> <i class="fa fa-inr" aria-hidden="true"></i> 
                                          
                                          <?php
                                      //  $sql = "SELECT *  FROM  NSE " ;
                                        //echo $value;
                                        
                                       
                                        $sql = "SELECT sum(marketprice * quantity)  As sumv FROM  addstock where stockexchange='BSE' and username='$username' " ;
                                        $result=mysqli_query($link,$sql);                                
                                        $num=mysqli_num_rows($result);
                                       if($num>=1){
                                                $value = mysqli_fetch_object($result);
                                               if( $value->sumv){
                                                 echo $value->sumv;
                                                 $bsei=$value->sumv;
                                               }else{
                                                  echo "00.00";
                                               }
                                       }else{
                                         echo "00.00";
                                       }
                                          
                                          ?>    
                                          
                                          </p>
                                       

                                    </div>
                       </div>
                      </div>


                   </div>


                   <div class="row mt-5"> 
                    <div class="col-6">
                   <div class="card shadow-sm p-3 mb-5 " style="width: 18rem;">
                                 <div class="card-body" style="font-size:40px;">
                                      <h5 class="card-title" >Total No of Equity</h5>
                                       <h6 class="card-subtitle mb-2 text-muted" >Quantity</h6>
                                       <p class="card-text text-success">
                                       

                                       <?php
                                      //  $sql = "SELECT *  FROM  NSE " ;
                                        //echo $value;
                                        
                                       
                                        $sql = "SELECT sum(quantity)  As sumv FROM  addstock where  username='$username' " ;
                                        $result=mysqli_query($link,$sql);                                
                                        $num=mysqli_num_rows($result);
                                       if($num>=1){
                                                $value = mysqli_fetch_object($result);
                                               if( $value->sumv){
                                                 echo $value->sumv;
                                               }else{
                                                  echo "00.00";
                                               }
                                       }else{
                                         echo "00.00";
                                       }
                                          
                                          ?>    
                                       
                                       
                                        </p>


                                      
                                 </div>
                    </div>
                   </div>
                             
                   <div class="col-6">
                     <div class="card shadow-sm p-3 mb-5" style="width: 18rem;">
                                   <div class="card-body" style="font-size:40px;">
                                        <h5 class="card-title">Total Value</h5>
                                         <h6 class="card-subtitle mb-2 text-muted">NSE and BSE</h6>
                                         <p class="card-text text-success"> <i class="fa fa-inr" aria-hidden="true"></i> <?php 
                                         echo $bsei+$nsei;
                                         ?></p>
                                        
                                   </div>
                      </div>
                     </div>


                  </div>


                 


              </div>
            
            
            
            
            </div>
           


        </div>

    </body>
    <script>
          function deleteFunction(){
            <?php 
            
            ?>
            
          }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</html>