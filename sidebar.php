<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="images/profile.jpg" width="120" height="120" alt="Fruitopia"> 
        <h5 style="margin-top:10px;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="adminhome.php" ><i class="fa fa-home"></i> Dashboard</a>
        <a href="#admins"   onclick="showAdmins()" ><i class="fa fa-th"></i> Admins</a> 
        <a href="#users"   onclick="showUsers()" ><i class="fa fa-th"></i> Users</a>    
        <a href="#products"   onclick="showProductItems()" ><i class="fa fa-th"></i> Products</a>
        <a href="#orders" onclick="showOrders()"><i class="fa fa-list"></i> Orders</a>
</div>
<!---->
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>


