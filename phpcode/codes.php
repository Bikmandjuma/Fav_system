<?php
class fac{

	//function of DBConnection
	public function DBConnection(){
		include '../Connect/connection.php';
	}
	//Admin register new user
	function register_user(){
		$ErrorToAddUser=$UserAddedWell=null;
		if (isset($_POST['submit'])) {
			include '../Connect/connection.php';
			
			try{
				$firstname=$_POST['fname'];
				$lastname=$_POST['lname'];
				$gender=$_POST['gender'];
				$phone=$_POST['phone'];
				$email=$_POST['email'];
				$dob=$_POST['dob'];
				$username=$_POST['email'];
				$password=md5($_POST['phone']);
				$image='user.png';

				$sql="INSERT INTO  users values ('','$firstname','$lastname','$gender','$phone','$email','$dob','$username','$password','','','$image')";
				$result=mysqli_query($con,$sql);
				if ($result) {
					echo "<script>window.location.assign('SystemUsers.php')</script>";
					$UserAddedWell='<script type="text/javascript">toastr.success("New user added !")</script>';
				}else{
					$ErrorToAddUser='<script type="text/javascript">toastr.error("Error to add user !")</script>';
				}
        		
			}catch(PDOException $e){
			    echo $sql . "<br>" . $e->getMessage();
			}

		}
	}

	//Admin users informations
	public function Select_user(){
		include "../Connect/connection.php";
		$fname=$lname=$gender=$phone=$email=$image=null;
		$result=mysqli_query($con,"SELECT * FROM users");
		while ($row=mysqli_fetch_assoc($result)) {
			$fname=$row['firstname'];
		   	$lname=$row['lastname'];  	
		   	$gender=$row['gender'];  	
		   	// $sitename=$row['sitename'];
		   	$image=$row['image'];
		   	
		   	echo "
		   		<tr>
				<td>"."<img src='../style/dist/img/".$image."'' style='width:50px;height:50px;border-radius:50%;border:1px solid gray;'><span id='online_icon'></span>"."</td>
				<td>".$fname."</td>
				<td>".$lname."</td>
				<td>".$gender."</td>
          		<td><a href='#View' ><i class='fa fa-eye text-info'></i></a></td>
          		<td><a href='#Edit' ><i class='fa fa-edit text-success'></i></a></td>
          		</tr>
		   	";

		}

		if ($fname==null and $fname==null and $phone==null and $email==null) {
				echo "<td colspan='6'>No users data found !</td>";
			
		}
	}

	public function System_user_count(){
		include '../Connect/connection.php';
		$sql="SELECT * FROM users";
		$result=mysqli_query($con,$sql);
        $sum =mysqli_num_rows($result);

        echo $sum;
	}


	public function Admin_modify_password(){
		require '../Connect/connection.php';

            $current_password=$new_password=$confirm_new_password=$password_required=$current_password_incorrect=$password_mustbe_greaterthan_8=$new_password_do_not_match="";

            if (isset($_POST['submit_pswd'])) {
	                $current_password=md5($_POST['current_password']);
	                $new_password=md5($_POST['new_password']);
	                $confirm_new_password=md5($_POST['confirm_new_password']);

	                $sql="SELECT password from admin where email='".$_SESSION['email']."'";
	                $result=mysqli_query($con,$sql);
	                while ($row=mysqli_fetch_assoc($result)) {
	                    $user_password=$row['password'];
	                }

	                if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
	                    $password_required="<span style='color:red;'>All fields required !</span>";
	                }

	                else{
		                if ($current_password != $user_password) {
		                    $current_password_incorrect="<span style='color:red;'>Current password is incorrect !</span>";
		                }elseif (strlen($new_password) < 8) {
		                    $password_mustbe_greaterthan_8="<span style='color:red;'>Password must be greater than 8 character</span>";
		                }elseif ($new_password != $confirm_new_password) {
		                    $new_password_do_not_match="<span style='color:red;'>New password do not match !</span>";

		                }else{
			                  if ($new_password == $confirm_new_password) {
			                    $sql_password="UPDATE admin SET password='".$confirm_new_password."' where email='".$_SESSION['email']."'";
			                    $result_password=mysqli_query($con,$sql_password);
			                    if ($result_password == true) {
			                      echo "<script>alert('Password changed successfully !');</script>";
			                    }
			                  }else{
			                    echo "password can not be changed !";
			                  }
		                }
					}
                
            }     

	
	}

	//Register citizen data
	public function Register_citizen(){
		$citizen_added=$error_citizen_add=$allfield_required=$star=null;
		if (isset($_POST['submit_citizen_data'])) {
			include '../Connect/connection.php';
			
			try{
				$card_id=mysqli_real_escape_string($con,$_POST['card_id']);
				$firstname=mysqli_real_escape_string($con,$_POST['fname']);
				$midname=mysqli_real_escape_string($con,$_POST['midname']);
				$lastname=mysqli_real_escape_string($con,$_POST['lname']);
				$gender=mysqli_real_escape_string($con,$_POST['gender']);
				$phone=mysqli_real_escape_string($con,$_POST['phone']);
				$province=mysqli_real_escape_string($con,$_POST['province']);
				$district=mysqli_real_escape_string($con,$_POST['district']);
				$sector=mysqli_real_escape_string($con,$_POST['sector']);
				$cellule=mysqli_real_escape_string($con,$_POST['cellule']);
				$village=mysqli_real_escape_string($con,$_POST['village']);
				$dob=mysqli_real_escape_string($con,$_POST['dob']);
				$registered_date=mysqli_real_escape_string($con,date("y-m-d"));

				if (empty($card_id) || empty($firstname) || empty($midname) || empty($lastname) || empty($gender) || empty($phone) || empty($province) || empty($district) || empty($sector) || empty($cellule) || empty($village) || empty($dob)) {
					
					$allfield_required='
									<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
					                     All fields with (*) are required !
					                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					                      <span aria-hidden="true">&times;</span>
					                    </button>
					                </div>
					';

					$star="<span style='color:red;font-size:20px;'>*</span>";

				}else{
					$sql="INSERT INTO  citizentb values ('','$card_id','$firstname','$midname','$lastname','$gender','$phone','$province','$district','$sector','$cellule','$village','$dob','$registered_date')";
					$result=mysqli_query($con,$sql);
					if ($result) {

						$citizen_added='
										<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
						                     Citizen data added successfully !
						                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						                      <span aria-hidden="true">&times;</span>
						                    </button>
						                </div>
						';

					}else{

						$error_citizen_add='
										<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
						                     Error to add Citizen data !
						                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						                      <span aria-hidden="true">&times;</span>
						                    </button>
						                </div>
						';

					}
				}
        		
			}catch(PDOException $e){
			    echo $sql . "<br>" . $e->getMessage();
			}

		}
	}

	public function all_citizen_numbers(){
		include '../Connect/connection.php';
		$sql="SELECT * FROM citizentb";
		$result=mysqli_query($con,$sql);
        $sum =mysqli_num_rows($result);
        echo $sum;
	}

	public function all_citizen_attend_today_nums(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $today=date("Y-m-d");

	    $sum=0;
		$sql="SELECT MIN(a_id) FROM attendance where attend_date='$today' group by citizen_fk_id";
		$result=mysqli_query($con,$sql);
        $sum =mysqli_num_rows($result);

        echo $sum;
	}

	public function citizen_attended_yesterday_nums(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
		$d=strtotime("Yesterday");
	    $today=date("Y-m-d",$d);
	    $sum=0;
		$sql="SELECT * FROM attendance where attend_date='$today' group by citizen_fk_id";
		$result=mysqli_query($con,$sql);
        $sum =mysqli_num_rows($result);

        echo $sum;
	}


	public function Fetch_citizen_attend_today(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $today=date("Y-m-d");
      	
      	$sql="SELECT MIN(a_id) as a_id,card_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.attend_date='$today' group by citizen_fk_id";

	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$id=$row['c_id'];
        	$card_id=$row['card_id'];
        	$fnames=$row['firstname'];
        	$lnames=$row['lastname'];
        	$gender=$row['gender'];
        	$phone=$row['phone'];

        	$times_query=mysqli_query($con,"SELECT * from attendance where citizen_fk_id='$id' and attend_date='$today'");
        	$times_number=mysqli_num_rows($times_query);

        	echo "<tr>
        		<td>".$card_id."</td>
        		<td>".$fnames."</td>
        		<td>".$lnames."</td>
        		<td>".$gender."</td>
        		<td>".$phone."</td>
        		<td><span class='badge badge-info' id='times_number_of_attend' title='attendance bunches of time'>x <b>".$times_number."</b></span></td>
        	  </tr>";
	     } 

	     $number=mysqli_num_rows($query);

	     if ($number == 0) {
	      	echo "<tr><td colspan='7'>No results found !</td></tr>";

	      	?>
	      		<style>
	      			#composer_msg_btn{
	      				display: none;
	      			}
	      		</style>
	      	<?php
	      } 
	}

	public function num_last_days(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
		$d=strtotime("Yesterday");
	    $Yesterday=date("Y-m-d",$d);
	    $today=date("Y-m-d");
	    $sum=0;
		$sql="SELECT * FROM attendance where attend_date!='$today' and attend_date!='$Yesterday'";
		$result=mysqli_query($con,$sql);
        $sum =mysqli_num_rows($result);

        echo $sum;
	}

	public function Fetch_citizen_attend_yesterday(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $Yesterday=date("Y-m-d",strtotime('Yesterday'));

      	$sql="SELECT * from citizentb left join attendance on citizentb.c_id=attendance.citizen_fk_id  where attendance.attend_date='$Yesterday'";

	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$id=$row['c_id'];
        	$fnames=$row['firstname'];
        	$lnames=$row['lastname'];
        	$gender=$row['gender'];
        	$phone=$row['phone'];

        	echo "<tr>
        		<td>".$fnames."</td>
        		<td>".$lnames."</td>
        		<td>".$gender."</td>
        		<td>".$phone."</td>
        		<td>Action</td>
        	  </tr>";
	     } 

	     $number=mysqli_num_rows($query);

	     if ($number == 0) {
	      	echo "<tr><td colspan='5'>No results found !</td></tr>";

	      	?>
	      		<style>
	      			#composer_msg_btn{
	      				display: none;
	      			}
	      		</style>
	      	<?php
	      }
	}


	public function Fetch_System_name(){
		include '../Connect/connection.php';
      	$sql="SELECT * from system_name";
	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$name=$row['system_name'];
        }

        echo $name;
	}

	//data in archive
	public function Fetch_year_Data_in_Archive(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $Current_year=date("Y");
	    $Last_year=date("Y")-1;
		
		$sql=$sql="SELECT MIN(a_id) as a_id,year,citizen_fk_id,attend_date,attend_time from attendance group by year order by year desc";
	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$year=$row['year'];

        	if ($year == $Current_year) {
        		$years="Current year (".$Current_year.")";
        	}elseif ($year == $Last_year) {
        		$years ="Last year (".$Last_year.")";
        	}else{
        		$years = $year;
        	}

        	?>
        		<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 bg-info" style='font-size:25px;border-radius:5px;'><a href="ArchiveDataYear.php?year=<?php echo $year;?>" class="float-left"><i id="blink" class="fa fa-folder"></i>&nbsp;<?php echo $years;?></a></div>
                    <div class="col-md-2"></div>
                </div><br>
        	<?php
        }

	}

	public function Fetch_Monthly_Data_in_Archive(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $Current_month=date("m");
	    $Current_months=date("M");
	    $curr_year=$_REQUEST['year'];

		$sql="SELECT MIN(a_id) as a_id,year,citizen_fk_id,attend_date,attend_time,month from attendance where year='$curr_year' group by month order by month desc";
	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$month=$row['month'];

        	if ($month == $Current_month) {
        		$months="Current month (".$Current_months.")";
        	}

        	// elseif ($month == $Last_month) {
        	// 	$months ="Last month (".$Last_months.")";
        	// }

        	else{

        		switch ($month) {
        			case 12:
        				$months='December';
        				break;
        			
        			case 11:
        				$months='November';
        				break;
        			
        			case 10:
        				$months='October';
        				break;
        			
        			case 9:
        				$months='September';
        				break;
        			
        			case 8:
        				$months='August';
        				break;
        			
        			case 7:
        				$months='July';
        				break;
        			
        			case 6:
        				$months='June';
        				break;

        			case 5:
        				$months='May';
        				break;
        			
        			case 4:
        				$months='April';
        				break;
        			
        			case 3:
        				$months='March';
        				break;
        			
        			case 2:
        				$months='February';
        				break;
        			
        			case 1:
        				$months='January';
        				break;
        		}
        	}


        	?>
        		<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 bg-info" style='font-size:25px;border-radius:5px;'><a href="ArchiveDataMonth.php?month=<?php echo $month;?>&year=<?php echo $curr_year;?>" class="float-left"><i id="blink" class="fa fa-folder"></i>&nbsp;<?php echo $months;?></a></div>
                    <div class="col-md-2"></div>
                </div><br>
        	<?php
        }

	}
	
	public function Fetch_All_date_Data_in_Archive(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $Today=date("Y-m-d");    
	    $Yesterday=date("Y-m-d",strtotime('Yesterday'));
	    $Curr_month=$_REQUEST['month'];
		$curr_year=$_REQUEST['year'];

		$sql="SELECT MIN(a_id) as a_id,year,citizen_fk_id,attend_date,attend_time,month from attendance where year='$curr_year' and month='$Curr_month' group by attend_date order by attend_date desc";
	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$today_date=$row['attend_date'];
        	$Todays = $today_date;

        	if ($Todays == date('Y-m-d')) {
        		$today_name="Today";
        	}elseif($Todays == date('Y-m-d',strtotime('Yesterday'))){
        		$today_name="Yesterday";
        	}else{
        		$today_name=$Todays;
        	}

        	$sql_num="SELECT MIN(a_id) as a_id from attendance where attend_date='$Todays' group by citizen_fk_id";

        	$query_num=mysqli_query($con,$sql_num);
        	$citiz_num=mysqli_num_rows($query_num);

        	if ($citiz_num >= 1000 and $citiz_num < 2000) {
        		$cit_nums='1k';
        	}elseif ($citiz_num >= 2000 and $citiz_num < 3000) {
        		$cit_nums='2k';        		
        	}elseif ($citiz_num >= 3000 and $citiz_num < 4000) {
        		$cit_nums='3k';        		
        	}elseif ($citiz_num >= 4000 and $citiz_num < 5000) {
        		$cit_nums='4k';        		
        	}elseif ($citiz_num >= 5000 and $citiz_num < 6000) {
        		$cit_nums='5k';        		
        	}elseif ($citiz_num >= 6000 and $citiz_num < 7000) {
        		$cit_nums='6k';        		
        	}elseif ($citiz_num >= 7000 and $citiz_num < 8000) {
        		$cit_nums='7k';        		
        	}elseif ($citiz_num >= 8000 and $citiz_num < 9000) {
        		$cit_nums='8k';        		
        	}elseif ($citiz_num >= 9000 and $citiz_num < 10000) {
        		$cit_nums='9k';        		
        	}elseif ($citiz_num >= 10000 and $citiz_num <= 10999) {
        		$cit_nums='10k';        		
        	}else{
        		$cit_nums=$citiz_num;
        	}

	        	?>
	        		<div class="row">
	                    <div class="col-md-2"></div>
	                    <div class="col-md-8 bg-info" style='font-size:25px;border-radius:5px;'><a href="ArchiveDataDaily.php?year=<?php echo $curr_year;?>&month=<?php echo $Curr_month;?>&dates=<?php echo $today_date;?>" class="float-left"><i id="blink" class="fa fa-folder"></i>&nbsp;<?php echo $today_name;?></a><span class="badge badge-light float-right" style="margin-top:5px;"><?php echo $cit_nums;?></span> </div>
	                    <div class="col-md-2"></div>
	                </div><br>
	        	<?php
        }		
	
	}

	public function Average_Attendance_per_day(){
		include '../Connect/connection.php';
		$sum=$Total=$Average=$numbs=0;
		$sql="SELECT MIN(a_id) as a_id,attend_date from attendance group by attend_date";
	    $query=mysqli_query($con,$sql);
	    $numbs=mysqli_num_rows($query);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$date=$row['attend_date'];
        	$sql_num="SELECT * from attendance where attend_date='$date' group by citizen_fk_id";
        	$query_num=mysqli_query($con,$sql_num);
        	$citiz_num=mysqli_num_rows($query_num);
        	$Total=$sum+=$citiz_num;
        }
        
        $Average=$Total/$numbs;
        echo round($Average,0);
	}

	public function Count_years(){
		include '../Connect/connection.php';
		$sql="SELECT MIN(a_id) a_id,attend_date,year from attendance group by year";
		$query=mysqli_query($con,$sql);
		$nums=mysqli_num_rows($query);

		if ($nums == 1) {
			echo $nums." year";
		}elseif ($nums > 1) {
			echo $nums." years";
		}
		
	}

	public function Fetch_citizen_attend_daily(){
		include '../Connect/connection.php';
		$month=$_REQUEST['month'];
		$year=$_REQUEST['year'];
		$date=$_REQUEST['dates'];

		$sql="SELECT MIN(a_id) as a_id,card_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_date,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.year='$year' and attendance.month='$month' and attendance.attend_date='$date' group by citizen_fk_id";

	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$id=$row['c_id'];
        	$card_id=$row['card_id'];
        	$fnames=$row['firstname'];
        	$lnames=$row['lastname'];
        	$gender=$row['gender'];
        	$phone=$row['phone'];
        	$attend_date=$row['attend_date'];
        	$attend_time=$row['attend_time'];

        	echo "<tr>
        		<td>".$card_id."</td>
        		<td>".$fnames."</td>
        		<td>".$lnames."</td>
        		<td>".$gender."</td>
        		<td>".$phone."</td>
        		<td>".$attend_time."</td>
        	  </tr>";
	     } 

	     $number=mysqli_num_rows($query);

	     if ($number == 0) {
	      	echo "<tr><td colspan='5'>No results found !</td></tr>";

	      	?>
	      		<style>
	      			#composer_msg_btn{
	      				display: none;
	      			}
	      		</style>
	      	<?php
	      }

	}

	public function count_citizen_attended_daily(){
		include '../Connect/connection.php';
		$month=$_REQUEST['month'];
		$year=$_REQUEST['year'];
		$date=$_REQUEST['dates'];

		$sql="SELECT MIN(a_id) as a_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.year='$year' and attendance.month='$month' and attendance.attend_date='$date' group by citizen_fk_id";
	    $query=mysqli_query($con,$sql);
	    $number=mysqli_num_rows($query);

	    echo $number;

	}

	public function search(){
		include '../Connect/connection.php';
		if (isset($_POST['submit_searchdata'])) {
			$today=date('Y-m-d');
			$Yesterday=date('Y-m-d',strtotime('Yesterday'));

		  	$Datas=$data=null;
		  	$Datas=mysqli_real_escape_string($con,$_POST['search_data']);
	      	$result=mysqli_query($con,"SELECT * from attendance WHERE attend_date Like '%".mysqli_real_escape_string($con,$Datas)."%'");

	      	$num=mysqli_num_rows($result);
	      	
	      	$result_num=mysqli_query($con,"SELECT MIN(a_id) as a_id,citizen_fk_id,attend_date,attend_time from attendance where attendance.attend_date='$Datas' group by citizen_fk_id");
	      	$number=mysqli_num_rows($result_num);
	      		
	      	if ($Datas == $today) {
	      		$Data="Today (".$Datas.")";
	      	}elseif ($Datas == $Yesterday) {
	      		$Data="Yesterday (".$Datas.")";
	      	}else{
	      		$Data=$Datas;
	      	}

	      	if ($num >= 1) {


	      		if ($num == 1) {
	      			echo "
		      			<div class='card-header text-center bg-info style='font-size:30px;''>
		      				result of <b>".$Data."</b> is <b>".$number."</b><button class='btn btn-light float-left' data-toggle='modal' data-target='#msg_Modal'><i class='fa fa-envelope'></i>&nbsp;Send message</button>
		      			</div>
	      			";
	      		}elseif($num > 1){
	      			echo "
		      			<div class='card-header text-center bg-info style='font-size:30px;''>
		      				results of <b>".$Data."</b> are <b>".$number."</b><button class='btn btn-light float-left' data-toggle='modal' data-target='#msg_Modal'><i class='fa fa-envelope'></i>&nbsp;Send message</button>
		      			</div>
	      			";
	      		}
	      		
		      	
		        while ($row = mysqli_fetch_assoc($result)){
		        	$attend_date=$row["attend_date"];
			    }

			    $sql_data="SELECT MIN(a_id) as a_id,card_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_date,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.attend_date='$attend_date' group by citizen_fk_id";
			    $query_data=mysqli_query($con,$sql_data);
			    ?>
			    	<div class='card-body' style='overflow: auto'>
			    <?php
			    echo '
			        <table class="table table-bordered table-striped" style="margin-top:0px;">
			        <tr class="bg-info">
			          <th>card_id</th>
			          <th>Firstname</th>
			          <th>Lastname</th>
			          <th>Gender</th>
			          <th>Phone</th>
			          <th>Attend&nbsp;date</th>
			          <th>Attend&nbsp;time</th>
			        </tr>';

			    while ($row=mysqli_fetch_assoc($query_data)) {
			    		$id=$row['c_id'];
			        	$card_id=$row['card_id'];
			        	$fnames=$row['firstname'];
			        	$lnames=$row['lastname'];
			        	$gender=$row['gender'];
			        	$phone=$row['phone'];
			        	$attend_date=$row['attend_date'];
			        	$attend_time=$row['attend_time'];

			        	?>
			        	
				        		<tr>
					        		<td><?php echo $card_id;?></td>
					        		<td><?php echo $fnames;?></td>
					        		<td><?php echo $lnames;?></td>
					        		<td><?php echo $gender;?></td>
					        		<td><?php echo $phone;?></td>
					        		<td><?php echo $attend_date;?></td>
					        		<td><?php echo $attend_time;?></td>
				        	  	</tr>
			        	<?php 
			    }

			    ?>
			    	</div>
			    <?php

			      echo '
			        </table>
			        ';
			    ?>
			    <!--Message modal-->
		        <!--Add new task model-->
		            <div class="modal fade" id="msg_Modal" role="dialog">
		             <div class="modal-dialog">
		                          
		               <!-- Modal content-->
		               <div class="modal-content">
		                 <div class="modal-header bg-info">
		                   <span class="float-center"><h2>Send them a warning message</h2></span><!--  <button type="button" class="close" data-dismiss="modal" style="font-size: 30px;color: white">&times;</button> -->
		                 </div>
		                 <div class="modal-body" style="overflow:auto;">
		                   <form class="form-group" method="POST" action="">
		                    <label><i class="fa fa-home"></i>&nbsp;Sitename</label>
		                     <input type="text" name="subject" placeholder="Enter firstname" class="form-control" required disabled value="Nyabugogo"><br>
		                     <label><i class="fa fa-envelope"></i>&nbsp;Message</label>
		                     
		                     <textarea name="msg" rows="3" placeholder="Typing message . . . . . ." class="form-control" autofocus></textarea><br>
		                   
		                     <button type="submit" class="btn btn-primary float-left" name="submit">Send&nbsp;<i class="fa fa-paper-plane"></i></button>

		                     <button type="reset" class="btn btn-danger float-right" class="close" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>

		                   </form>
		                 </div>
		              </div>
		             <!--end of Modal content-->
			    <?php
	      	}else{
	      		echo "<div class='row'><div class='col-md-12 text-center' style='font-size:30px;'>No Result  of <span style='color:red;'><b>".$Data."</b></span> found !!</div></div>";
                      echo '
                            <div class="row">
                              <div class="col-md-12 text-center">
                                <img src="../images/NoSearch.jpg">
                              </div>
                            </div>';

	      	}

		}

	}

	public function Fetch_all_citizen_info(){
		require '../Connect/connection.php';
		$name=$description=$picture=null;

		$per_page=3;
		$Pages_query=mysql_query("SELECT count('c_id') FROM citizentb");
		$pages=ceil(mysql_result($Pages_query, 0)/$per_page);
		$page=(isset($_GET['page'])) ? (int)$_GET['page']:1;
		$start=($page-1)*$per_page;

		?>	<div style="overflow: auto;">
			<table style="text-align: center;" class="table table-bordered table-striped">
	        <thead>
		        <tr class="text-white bg-success">
		          	<th>card_id</th>
			        <th>Firstname</th>
			        <th>Lastname</th>
			        <th>Gender</th>
			        <th>Phone</th>
		        </tr>

	        </thead>
		<?php
        

		if ($id == NULL) {
        	echo "<tr><td colspan='5'>No records found ?</td>";
        }else{
        	$result=mysql_query("SELECT * FROM citizentb LIMIT $start,$per_page ");
	        while ($row=mysql_fetch_assoc($result)) {
	            $card_id=$row['card_id'];
	            $fname=$row['firstname'];
	            $lname=$row['lastname'];
	            $gender=$row['gender'];
	            $phone=$row['phone'];
	            
	            echo "<tr>
	            		<td>".$card_id."</td>
	            		<td>".$fname."</td>
	            		<td>".$lname."</td>
	            		<td>".$gender."</td>
	            		<td>".$phone."</td>
	            	 </tr>";
	        }

	    }

		$prev=$page-1;
		$next=$page+1;
		
		echo "  </table></div>";
		echo "<br><div id='no_pages_num' class='text-center' style='font-size:20px;'>";
		//echo "Pages &nbsp;&nbsp;";
		if (!($page<=1)) {
			echo "<a href='ViewFilesList.php?page=$prev'>Prev</a>  &nbsp";
		}

		if ($pages>=1) {
			for ($i=1;$i<=$pages;$i++) { 
				echo ($i==$page) ? '<b><a href="?page='.$i.'">'.$i.'</a></b> ': '<a href="?page='.$i.'">'.$i.'</a> ';
			}
		}
		if (!($page>=$pages)) {
		    echo "&nbsp; <a href='ViewFilesList.php?page=$next'>Next</a>";
		}

		echo "</div>";
	}

	//site_name
	public function count_site_names(){
		
		include "../Connect/connection.php";
		$result=mysqli_query($con,"SELECT * FROM site_name");
		$site_count=mysqli_num_rows($result);
		echo $site_count;

	}

	public function display_sitename_to_users(){
		include "../Connect/connection.php";
		$result=mysqli_query($con,"SELECT * FROM site_name");
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<option value="<?php echo $row['id'];?>"><?php echo $row['sitename'];?></option>
			<?php
		}
	}

	public function display_sitename(){
		include "../Connect/connection.php";
		$result=mysqli_query($con,"SELECT * FROM site_name");
		$count=1;
		while ($row=mysqli_fetch_assoc($result)) {
			$Sitename=$row['sitename'];
			$Entrance=$row['entrance'];

			echo "
			   		<tr>
						<td>".$count++."</td>
						<td>".$Sitename."</td>
						<td>".$Entrance."</td>
		          		<td><a href='#View' ><i class='fa fa-eye text-info'></i></a></td>
		          		<td><a href='#Edit' ><i class='fa fa-edit text-success'></i></a></td>
	          		</tr>
			";

		}

	}

	public function SitenameEntrance(){
		echo $_SESSION['sitename'].$_SESSION['entrance'];
	}

	//Admin register new SiteName
	public function register_Sitename(){
		if (isset($_POST['SubmitSitename'])) {
			include '../Connect/connection.php';
			
			try{
				$Entrance=$_POST['entrance'];
				$SiteName=$_POST['sitename'];

				$sql="INSERT INTO  site_name values ('','$SiteName','$Entrance')";
				$result=mysqli_query($con,$sql);
				if ($result) {
					echo "<script>window.location.assign('sites.php')</script>";
				}else{
					echo "<script>alert('Error to insert data !')<script>";
				}
        		
			}catch(PDOException $e){
			    echo $sql . "<br>" . $e->getMessage();
			}

		}
	}

	public function Sitename_counter(){
		require '../Connect/connection.php';
		$sql="SELECT * FROM site_name";
		$result=mysqli_query($con,$sql);
        $sum =mysqli_num_rows($result);

        echo $sum;
	}

	public function Online_User_Counter(){
		require '../Connect/connection.php';
		$online_user_sql=mysqli_query($con,"SELECT * from online_users where status='ON'");
		$online_user_nums=mysqli_num_rows($online_user_sql);

		echo $online_user_nums;
	}

	public function Online_User(){
		require '../Connect/connection.php';
		$user_id=$_SESSION['u_id'];
		$online_user_sql=mysqli_query($con,"SELECT * from online_users where status='ON' and fk_user_id='".$user_id."'");
		$online_user_nums=mysqli_num_rows($online_user_sql);

		if ($online_user_nums == 1) {
			?>
				<div style="width:15px;height:15px;margin-top:-10px; background-color:green;border-radius:100%;"></div>
			<?php
		}
	}


	//Send message to citizen attend today
	public function SendSMS_to_citizen_attend_today(){
		include '../Connect/connection.php';
		date_default_timezone_set("Africa/Kigali");
	    $today=date("Y-m-d");
		$site_id=$_SESSION['site_id'];
      	
      	$sql="SELECT MIN(a_id) as a_id,card_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.fk_site_id='$site_id' and attendance.attend_date='$today' group by citizen_fk_id";

	    $query=mysqli_query($con,$sql);
     	while ($row=mysqli_fetch_assoc($query)) {
        	$fnames=$row['firstname'];
        	$lnames=$row['lastname'];
        	$phone=$row['phone'];
        	$attend=$row['attend_time'];

	    } 
	}

	//use profile picture
	public function User_Profile_Picture(){
		include '../Connect/connection.php';
		$user_id=$_SESSION['u_id'];
		$result=mysqli_query($con,"SELECT * FROM users where u_id='$user_id'");
		while ($row=mysqli_fetch_assoc($result)) {
			echo $image=$row['image'];
		}
	}

	//use profile picture
	public function Admin_Profile_Picture(){
		include '../Connect/connection.php';
		$user_id=$_SESSION['id'];
		$result=mysqli_query($con,"SELECT * FROM admin where id='$user_id'");
		while ($row=mysqli_fetch_assoc($result)) {
			echo $image=$row['image'];
		}
	}


}
?>