<?php include 'includes/header_home.php' ?>
<?php
$name = $id = $email = $constName = $regName = $constCode = $regCode = $voterNum = $dob = $gender = $password = $Cpassword = '';
$nameErr = $idErr = $emailErr = $constNameErr = $regNameErr =  $constCodeErr = $regCodeErr = $voterNumErr = $dobErr = $genderErr = $passwordErr = $CpasswordErr = '';
$errors = array();
$success = array();
//form submit
if(isset($_POST['submit'])){
    //validate name
    if(empty($_POST['name'])){
        $nameErr = 'Full name is required';
    }else{
        $name = filter_input(INPUT_POST, 'name' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

     //validate id
     if(empty($_POST['id'])){
        $idErr = 'National Identification Number is required';
    }else{
        $id = filter_input(INPUT_POST, 'id' , FILTER_SANITIZE_NUMBER_INT);
    }
     //validate email
     if(empty($_POST['email'])){
        $emailErr = 'Email address is required';
    }else{
        $email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_EMAIL);
    }
     //validate constituency
     if(empty($_POST['constName'])){
        $constNameErr = 'Constituency name is required';
    }else{
        $constName = filter_input(INPUT_POST, 'constName' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
     //validate registration Center
     if(empty($_POST['regName'])){
        $regNameErr = 'Registration Center is required';
    }else{
        $regName = filter_input(INPUT_POST, 'regName' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
     //validate constituency code
     if(empty($_POST['constCode'])){
        $constCodeErr = 'Constituency code is required';
    }else{
        $constCode = filter_input(INPUT_POST, 'constCode' , FILTER_SANITIZE_NUMBER_INT);
    }
     //validate registration center Code
     if(empty($_POST['regCode'])){
        $regCodeErr = 'Registration center Code is required';
    }else{
        $regCode = filter_input(INPUT_POST, 'regCode' ,  FILTER_SANITIZE_NUMBER_INT);
    }
      //validate voters Number
      if(empty($_POST['voterNum'])){
        $voterNumErr = 'Voters Number is required';
    }else{
        $voterNum = filter_input(INPUT_POST, 'voterNum' ,  FILTER_SANITIZE_NUMBER_INT);
    }
  
       //validate dob
       if(empty($_POST['dob'])){
        $dobErr = 'Date of birth is required';
    }else{
        $dob = filter_input(INPUT_POST, 'dob' ,  FILTER_SANITIZE_ADD_SLASHES);
    }
       //validate gender
       if(empty($_POST['gender'])){
        $genderErr = 'Gender is required';
    }else{
        $gender = filter_input(INPUT_POST, 'gender' ,  FILTER_SANITIZE_ENCODED);
    }
       //validate password
       if(empty($_POST['password'])){
        $passwordErr = 'password is required';
    }else{
        $password = filter_input(INPUT_POST, 'password' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //validate confirm password
    if(empty($_POST['Cpassword'])){
        $CpasswordErr = 'Confirm password is required';
    }else{
        $Cpassword = filter_input(INPUT_POST, 'Cpassword' ,  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    //
    if(strlen($password) > 6 && strlen($password) < 20 && preg_match('`[A-Z]`', $password) && preg_match('`[a-z]`', $password) && preg_match('`[0-9]`', $password)){
      
    }else{
        $passwordErr = 'password must be atleast 6 characters and atmost 20 characters <br>
        At least one Uppercase <br>
        At least one lower case <br>
        At least one digit';
    }
    //Checking to see if passwords are same
    if($password != $Cpassword){
        $CpasswordErr = 'Passwords do not match';
    }
    

    //if there is no error
    if(empty($nameErr) && empty($idErr) && empty($emailErr) && empty($constNameErr) && empty($regNameErr) && empty($constCodeErr) && empty($regCodeErr) && empty($voterNumErr) && empty($dobErr) && empty($genderErr) && empty($passwordErr) && empty($CpasswordErr)){
       //check to see if user exists
       $sql = "SELECT * FROM voters WHERE id_num = '$id' AND email = '$email' ";
       $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
       if( mysqli_num_rows($result) > 0){
           array_push($errors, 'Voter Already registered');

       }else{
            //add to database
        $hashedPassword = md5($password);
        $formatDOB = date('Y-m-d', strtotime($dob));
        $sql = "INSERT INTO voters(name, id_num, email, constituency_name, registration_center, constituency_code, registration_code, voter_num, dob, gender, password, image)
        VALUES('$name', '$id', '$email', '$constName', '$regName', '$constCode', '$regCode', '$voterNum', '$formatDOB', '$gender', '$hashedPassword', 'default3.jpg')";

        if(mysqli_query($conn, $sql)){
            //Success
            array_push($success, "voter Registered Successfully ");
          
        }
        else{
             //error
             echo 'Error: '. mysqli_error($conn);
        }
       }

    }
    
}
?>

<div style="padding-top: 50px;" class=" mt-5 text-center">
    <img style="width: 300px; height: 300px; border-radius: 50%;" src="/IEBC/images/s.jpg" alt="">
</div>
<div class="container p-3">
    <h2 class="text-center text-primary ">Voters Registration Form</h2>
    <?php include 'includes/messages.php' ?>
    <p class=" text-center lead text-primary">Please register to be able to voter online in the coming elections</p>
   <div class="row">
       <div class="col-md-5 m-auto">
               <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
               <div class="mb-3">
                   <label for="name" class="form-label">Full Names</label>
                   <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ;?> " id="name" name="name" placeholder=" Enter Full names">
                   <div class="invalid-feedback">
                       <?php echo $nameErr ?>
                   </div>
               </div>
               <div class="mb-3">
                   <label for="id" class="form-label">National Identification Number</label>
                   <input type="number" class="form-control <?php echo $idErr ? 'is-invalid' : null ;?> " id="id" name="id" placeholder=" Enter Identification Number">
                   <div class="invalid-feedback">
                       <?php echo $idErr ?>
                   </div>
               </div>
               <div class="mb-3">
                   <label for="email" class="form-label">Email Address</label>
                   <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ;?> " id="email" name="email" placeholder=" Enter Email Address">
                   <div class="invalid-feedback">
                       <?php echo $emailErr ?>
                   </div>
                </div>
               <div class="row">
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="constName" class="form-label">Constituency Name</label>
                   <input type="text" class="form-control <?php echo $constNameErr ? 'is-invalid' : null ;?> " id="constName" name="constName" placeholder=" Enter Constituency Name">
                   <div class="invalid-feedback">
                       <?php echo $constNameErr ?>
                   </div>    
                </div>
                   </div>
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="regName" class="form-label">Registration Center Name</label>
                   <input type="text" class="form-control <?php echo $regNameErr ? 'is-invalid' : null ;?> " id="regName" name="regName" placeholder=" Enter Registration Center Name">
                   <div class="invalid-feedback">
                       <?php echo $regNameErr ?>
                   </div>    
                </div>
                   </div>
               </div>
               <div class="row">
                   <p class="lead text-primary">Please enter the Correct Identification code</p>
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="constCode" class="form-label">Constituency code</label>
                   <input type="number" class="form-control <?php echo $constCodeErr ? 'is-invalid' : null ;?> " id="constCode" name="constCode" placeholder="Constituency Code">
                   <div class="invalid-feedback">
                       <?php echo $constCodeErr ?>
                   </div>      
                </div>
                   </div>
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="regCode" class="form-label">Registration Center code</label>
                   <input type="number" class="form-control <?php echo $regCodeErr ? 'is-invalid' : null ;?> " id="regCode" name="regCode" placeholder="Registration Center code">
                   <div class="invalid-feedback">
                       <?php echo $regCodeErr ?>
                   </div>     
                </div>

                   </div>
               </div>
               <div class="row">
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="voterNum" class="form-label">Voters Number</label>
                   <input type="number" class="form-control <?php echo $voterNumErr ? 'is-invalid' : null ;?> " id="voterNum" name="voterNum" placeholder="Voters Number">
                   <div class="invalid-feedback">
                       <?php echo $voterNumErr ?>
                   </div>     
                </div>
                   </div>
                   <div class="col-6">
                   <div class="mb-3">
                   <label for="dob" class="form-label">Date of Birth</label>
                   <input type="date" class="form-control <?php echo $dobErr ? 'is-invalid' : null ;?> " id="dob" name="dob" placeholder=" date of Birth">
                   <div class="invalid-feedback">
                       <?php echo $dobErr ?>
                   </div>      
                </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-8 m-auto">
                       <label for="gender">Gender</label> <br>
                       <input type="radio" class=" <?php echo $genderErr ? 'is-invalid' : null ;?> " name="gender" value="female"> Female
                       <input type="radio" class=" <?php echo $genderErr ? 'is-invalid' : null ;?> " name="gender" value="male"> Male
                       <input type="radio" class=" <?php echo $genderErr ? 'is-invalid' : null ;?> " name="gender" value="other"> Other
                       <div class="invalid-feedback">
                       <?php echo $genderErr ?>
                   </div>  
                    </div>
               </div>
               <div class="mb-3">
                   <label for="password" class="form-label">Password</label>
                   <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null ;?>" id="password" name="password" placeholder=" Enter password">
                   <div class="invalid-feedback">
                       <?php echo $passwordErr ?>
                   </div>      
                </div>
               <div class="mb-3">
                   <label for="Cpassword" class="form-label">Confirm Password</label>
                   <input type="password" class="form-control <?php echo $CpasswordErr ? 'is-invalid' : null ;?> " id="Cpassword" name="Cpassword" placeholder=" Confirm password">
                   <div class="invalid-feedback">
                       <?php echo $CpasswordErr ?>
                   </div>      
                </div>
                <div class="mb-3">
                    <input type="checkbox" onclick="showPass()"> show Password
                </div>
               <div class="mb-3">
                   <input type="submit" class="form-control text-light bg-dark " id="submit" name="submit" value="Register" >
               </div>
           </form>
    </div>
</div>
    
</div>

<?php include 'includes/footer.php' ?>