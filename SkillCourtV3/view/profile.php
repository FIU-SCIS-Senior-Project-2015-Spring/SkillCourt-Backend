<div class="container profileContainer">
	<div class="row">
  		<div class="col-sm-12"><h2 class="whiteHeaders"><?php echo is_null($lastName) ? $username : $firstName . " " . $lastName ?></h2></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
            <?php 	
            $currentUser->fetch();
            $isPersComplete = $currentUser->get("isPersComplete");
    		$isAthComplete = $currentUser->get("isAthComplete");
    		$isVarComplete = $currentUser->get("isVarComplete");
    		?>

    		<!-- If the profile is not completed, show message to complete it -->
			<?php if($isPersComplete && $isAthComplete && $isVarComplete) :?>
			<div class="panel panel-default">
        		<div class="panel-heading"><strong>Your profile is Complete.</strong></div>
          	</div>
          	<?php else : ?>
      		<div class="panel panel-default">
            	<div class="panel-heading"><a href="#settings" id="incompleteProfile" >Click here to complete your Profile</a></div>
          	</div>
          	<?php endif ?>

			<!-- Display the personal information of the user only -->
	        <?php if($isPersComplete) :?>
			<div class="panel panel-default">
				<div class="panel-heading">Personal Information </div>
				<div class="panel-body">
					<strong>Full Name:</strong> <?php echo $currentUser->get("firstName") . " " . $currentUser->get("lastName");  ?><br>
					<strong>Gender:</strong> <?php echo $currentUser->get("gender"); ?> <br>
					<strong>Phone number: </strong> <?php echo $currentUser->get("phone"); ?>
				</div>
          	</div>
          	<?php endif ?>

			<!-- Display the Athletic information only -->
			<?php if($isAthComplete) :?>
			<div class="panel panel-default">
				<div class="panel-heading">Athletic Information </div>
				<div class="panel-body">
					<strong>Position:</strong> <?php echo $currentUser->get("position");  ?> <br>
					<strong>Dominant Leg:</strong> <?php echo $currentUser->get("preferredFoot");  ?>
				</div>
          	</div>
          	<?php endif ?>

          	<!-- Display the Various information only -->
			<?php if($isVarComplete) :?>
			<div class="panel panel-default">
            	<div class="panel-heading">Favorite Soccer Teams:<i class="fa fa-link fa-1x"></i></div>
            	<div class="panel-body">
	            	<?php 
	            		$favoriteTeams = $currentUser->get("favTeams");
						for($x = 0; $x < count($favoriteTeams); $x++) {
						    echo "<strong>" . $favoriteTeams[$x] . "</strong></br>";
						}
	            	?>
            	</div>
          	</div>        	
            <?php endif ?>
               
          	<div class="panel panel-default">
            	<div class="panel-heading">Social Media</div>
            	<div class="panel-body" id="connectIcons">
            		<i class="fa fa-facebook fa-2x"></i>  
	            	<i class="fa fa-twitter fa-2x"></i> 
	            	<i class="fa fa-instagram fa-2x"></i> 
	            	<i class="fa fa-google-plus fa-2x"></i>
	            	<i class="fa fa-linkedin fa-2x"></i>
            	</div>
          	</div>
          
        </div><!--/col-3-->
    	
    	<!-- Profile Complete -->
    	<div class="col-sm-9">
			
			<ul class="nav nav-tabs nav-justified" id="myTab">
            	<li class="active" id="lihome"><a class="topTab regLinks" href="#homeTab" data-toggle="tab" id="ahome">Home</a></li>
            	<li id="limessages"><a class="topTab regLinks" href="#messages" data-toggle="tab" id="amessages">Messages</a></li>
            	<li id="lisettings"><a class="topTab regLinks" href="#settings" data-toggle="tab" id="asettings">Settings</a></li>
          	</ul>
              
          	<div class="tab-content">
            	
            	<div class="tab-pane fade in active" id="homeTab">
              		<h2 class="whiteHeaders">This will be your new home!</h2>
             	</div><!--/tab-pane-->
	            
	            <div class="tab-pane fade" id="messages">
               		<h2 class="whiteHeaders">Messages</h2>
               		<ul class="list-group">
                  		<li class="list-group-item text-muted">Inbox</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Here is your a link to the latest summary report from the..</a> 2.13.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Hi Joe, There has been a request on your account since that was..</a> 2.11.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Nullam sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Thllam sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Wesm sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">For therepien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Also we, havesapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                  		<li class="list-group-item text-right"><a href="#" class="pull-left">Swedish chef is assaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                	</ul> 
             	</div><!--/tab-pane-->

             	<div class="tab-pane fade" id="settings">
             		<!-- Registration tab -->
             		<ul class="nav nav-tabs nav-justified">
             			<li class="active"><a class="regTab" data-toggle="tab" href="#personalInfo">Personal Info</a></li>
             			<li><a class="regTab" data-toggle="tab" href="#athleticInfo">Athletic Profile</a></li>
             			<li><a class="regTab" data-toggle="tab" href="#variousInfo">Various Info</a></li>
             		</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="personalInfo">
							<form class="form" action="javascript:validatePersonalSignUp()" method="post" id="registrationFormPer">
							    <div class="form-group">
							        <div class="col-xs-4">
							            <label for="first_name"><h4 class="whiteHeaders">First Name</h4></label>
							            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="Enter your first name" required>
							         </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-2">
							            <label for="middle_name"><h4 class="whiteHeaders">Middle Initial</h4></label>
							            <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="MI" title="Enter your Middle Initial" maxlength="1">
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-4">
							            <label for="last_name"><h4 class="whiteHeaders">Last Name</h4></label>
							            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="Enter your last name if any." required>
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-2">
							            <label for="gender"><h4 class="whiteHeaders" title="Select a gender">Gender</h4></label>
										<select class="form-control" id="gender" required>
											<option></option>
											<option>Male</option>
											<option>Female</option>
										</select>
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-4">
							            <label for="mobile"><h4 class="whiteHeaders">Alternate Email</h4></label>
							            <input type="email" class="form-control" name="altemail" id="altemail" placeholder="Enter Alt-Email" title="Enter your alternate email address">
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-4">
							            <label for="phone"><h4 class="whiteHeaders">Phone Number</h4></label>
							            <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any." required>
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-12">
							            <br>
							            <button class="btn btn-sm btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
							            <button class="btn btn-sm" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
							        </div>
							    </div>
							</form>
							
						</div>
						<div class="tab-pane fade" id="athleticInfo">
							<form class="form" action="javascript:validateAthleticSignUp()" method="post" id="registrationFormAth">
							    <div class="form-group">
							        <div class="col-xs-2">
							            <label for="middle_name"><h4 class="whiteHeaders">Coach</h4></label>
							            <select class="form-control" id="isCoach" name="isCoach" onchange="changeFunc(value);" required>
							            	<option value=""></option>
							            	<option value="Y">YES</option>
							            	<option value="N">NO</option>
							            </select>
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-6">
							            <label for="position"><h4 class="whiteHeaders">Preferred Position </h4></label>
							            <select class="form-control" id="createPositionInput" name="createPositionInput" required>
									        <option value=""></option>
									        <option value="Goalkeeper">Goalkeeper</option>
									        <option value="Center-Back">Center-Back</option>
									        <option value="Left-Back">Left-Back</option>
									        <option value="Right-Back">Right-Back</option>
									        <option value="Left Wing Back">Left Wing Back</option>
									        <option value="Right Wing Back">Right Wing Back</option>
									        <option value="Defending Midfielder">Defending Midfielder</option>
									        <option value="Central Midfielder">Central Midfielder</option>
									        <option value="Attacking Midfielder">Attacking Midfielder</option>
									        <option value="Left Wing">Left Wing</option>
									        <option value="Right Wing">Right Wing</option>
									        <option value="Withdrawn Striker">Withdrawn Striker</option>
									        <option value="Striker">Striker</option>
									  		<option value="Coach" style="display: none;">Coach</option>
									    </select>
							         </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-4">
							            <label for="preferred_foot"><h4 class="whiteHeaders">Dominant Leg</h4></label>
							            <select class="form-control" id="preferredFoot" name="preferredFoot" required>
							            	<option value=""></option>
							            	<option value="Left">Left</option>
							            	<option value="Right">Right</option>
							            </select>
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-12">
							            <br>
							            <button class="btn btn-sm btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
							            <button class="btn btn-sm" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
							        </div>
							    </div>
							</form>
						</div>
						<div class="tab-pane fade" id="variousInfo">
							<form class="form" action="javascript:validateVariousSignUp()" method="post" id="registrationFormVar">
							    <div class="form-group">
							    	<label for="Favorite_teams"><h4 class="whiteHeaders">Enter your favorite Soccer Teams</h4></label>
							        <div class="input_fields_wrap">
							        	<button class="btn btn-md btn-link add_field_button" type="button">Add More Teams</button>
							        	<div class="col-xs-2"><input class="form-control" type="text" name="teams" title="Enter your favorite team" placeholder="Team name" required></div>
							        </div>
							    </div>
							    <div class="form-group">
							        <div class="col-xs-12">
							            <br>
							            <button class="btn btn-sm btn-success" type="submit" id="varSubmitButton"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
							            <button class="btn btn-sm" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
							        </div>
							    </div>
							</form>
						</div>
					</div> <!-- tab content end -->

                	

            	</div><!--/tab-pane-->
         	</div><!--/tab-content-->
     	</div><!--/col-sm-9-->          
	</div><!--/row-->
</div> <!--Container -->