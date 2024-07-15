<div>
  <h2>All Admins</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Username </th>
        <th class="text-center">Email</th>
        <th class="text-center">Joining Date</th>
		<th class="text-center">Action</th>
      </tr>
    </thead>
    <?php
      include_once "connection.php";
      $sql="SELECT * from users where user_type='admin'";
      $result=$con-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["username"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["date"]?></td>
	  <td><button class="btn btn-danger" style="height:40px" onclick="userDelete('<?=$row['id']?>')">Delete</button></td>
    </tr>
    <?php
        $count=$count+1;
 
        }
      }
    ?>
  </table>