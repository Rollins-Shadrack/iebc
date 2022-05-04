<?php include 'includes/dashboard_header.php' ?>
<?php 
 $sql = "SELECT * FROM voters";
 $result = mysqli_query($conn,$sql);
 $voters = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div style="margin-top: 100px;" class="container">
<table  class="table table-stripe container">
    <thead>
        <th>No</th>
        <th>Name</th>
        <th>ID</th>
        <th>Voter Number</th>
         <th>Action</th>
    </thead>

<?php if(empty($voters)): ?>
    <p class="lead">No voter Registered</p>

    <?php endif;?>
    <?php foreach($voters as $voter): ?>
        <tbody>
            <tr>
                <td><?php   echo $voter['id'];?></td>
                <td><?php  echo $voter['name'];?></td>
                <td><?php  echo $voter['id_num'];?></td>
                <td><?php  echo $voter['voter_num'];?></td>
                <td style="display: flex;">
                    <a href="/iebc/update.php?updateId=<?php  echo $voter['id'];?>" class="btn btn-info mx-2"><i class="bi bi-pen"></i>Update</a>
                    <a href="/iebc/includes/delete.php?deleteId=<?php  echo $voter['id'];?>" class="btn btn-danger"><i class="bi bi-x h4"></i>Delete</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>

        </table>
        <a href="/iebc/admin_dashboard.php" class="btn btn-primary">Dashboard</a>  
</div>
        <?php include 'includes/footer.php'?>