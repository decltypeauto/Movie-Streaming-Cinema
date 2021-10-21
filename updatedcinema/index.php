<?php

require_once 'app/require.php';
require_once 'app/controllers/CheatController.php';

$user = new UserController;
$cheat = new CheatController;

Session::init();

if (!Session::isLogged()) { Util::redirect('/login.php'); }
if (Session::isLogged()) { Util::redirect('/movies/movies.php'); }
$username = Session::get("username");
$codes = $user->getSubCodes(Session::get("uid"));
Util::banCheck();
Util::head($username);
Util::navbar();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>



<main class="container mt-2">


<div class = "row">
		<!--Welome message-->
		<div class="col-12 mt-3 mb-2">
			<div class="alert alert-primary" role="alert">
				Welcome back, <a href="/profile.php"><b><?php Util::display($username) ?></b></a>. Your uid is <?php Util::display($user->getUid()); ?>.
			</div>
		</div>
</div>


	<div class="row">




		<!--Statistics
		<div class="col-lg-9 col-md-12">
			<div class="rounded p-3 mb-3">
				<div class="h5 border-bottom border-secondary pb-1"><i class="fas fa-chart-area"></i> Statistics</div>
				<div class="row text-muted">

					
					<div class="col-12 clearfix">
						UID: <p class="float-right mb-0"><?php Util::display($user->getUid()); ?></p>
					</div>

		

				</div>
			</div>
		</div>-->

		




		<!--Status-->
		<div class="col-lg-3 col-md-15">
			<div class="rounded p-3 mb-3">
				<div class="h5 border-bottom border-secondary pb-1"><i class="fas fa-exclamation-circle"></i> Status</div>
				<div class="row text-muted">

					<!--Detected // Undetected-->
					<div class="col-12 clearfix">
						Total Games: <p class="float-right mb-0"><?php Util::display($cheat->getGameCount()); ?></p>
					</div>

					<!--Cheat version-->
					<div class="col-12 clearfix">
						Total UD: <p class="float-right mb-0"><?php Util::display($cheat->getUndetectedCount()); ?></p>
					</div>
	
					<!-- Check if has sub --> 
					<?php if ($user->getSubStatus() > 0) : ?>
						<div class="col-12 text-center pt-1">
							<div class="border-top border-secondary pt-1">

							<a href="/download.php">Download Loader</a>
							</div>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>

			<!-- Shoutbox
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="box rounded accent my-3">
                        <div class="scroll chatbox">
                            <div id="result"></div>
                        </div>
                        <div class=" container">
                            <form action="shoutbox/post_msgs.php" method="post">
                                <div class="row chatbox-input pt-4">
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <div class="form-group">
                                            <input type="text" name="msg" class="form-control contrast" maxlength="255" placeholder="What's on your mind?" required>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="submit" class="btn" value="Send" name="sendmsg">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Shoutbox -->

		<div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="h5 border-bottom border-secondary pb-1">Subscriptions</div>
								<div class="col-12 mb-2">
									<table class="rounded table">
										<thead>
											<tr>
												<th scope="col">Key</th>
												<th scope="col">Game</th>
												<th scope="col">Length</th>
												<th scope="col">Status</th>
												<th scope="col">Used?</th>
												<th scope="col">Banned?</th>
											</tr>
										</thead>
									<tbody>
										<?php foreach ($codes as $row) : ?>
						<tr>
							<td><?php Util::display($row->code); ?></td>
							
							<td><?php Util::display(($row->game == 1) ? "EFT" : (($row->game == 2)  ? "Arma" : (($row->game == 3)  ? "Fortnite" : (($row->game == 4)  ? "Apex" : (($row->game == 5)  ? "PUBG" : (($row->game == 6)  ? "Squad" :"Error")))))); ?></td>
							<td><?php Util::display($row->length); ?> Days</td>
							<td><?php Util::display(($row->status == 1) ? "Active" : (($row->status == 2)  ? "Expired" : (($row->status == 3)  ? "Banned" : "Error"))); ?></td>
							<td><?php Util::display(($row->used == 0) ? "Not Used" : (($row->status == 1)  ? "Used" : "Error")); ?></td>
							<td><?php Util::display(($row->banned == 1) ? "Banned" : (($row->banned == 0)  ? "Unbanned" : "Error")); ?></td>
						</tr>
					<?php endforeach; ?>
								</tbody>
							</table>
						</div>
                        </div>
                    </div>
                </div>
            </div>


	<div class = "row">
		<div class="col-xl-3 col-sm-6 col-xs-12 mt-3">
			<div class="card">
				<div class=" card-body row">
					<div class="col-6 text-center">
						<h3><i class="fas fa-users fa-2x"></i></h3>
					</div>
					<div class="col-6">
						<h3 class="text-center"><?php Util::display($user->getUserCount()); ?></h3>
						<span class="small text-muted text-uppercase">total users</span>
					</div>
				</div>
			</div>
		</div>


		
		<!--Newest registered user-->
		<div class="col-xl-3 col-sm-6 col-xs-12 mt-3">
			<div class="card">
				<div class=" card-body row">
					<div class="col-6 text-center">
						<h3><i class="fas fa-user fa-2x"></i></h3>
					</div>
					<div class="col-6">
						<h3 class="text-center text-truncate"><?php Util::display($user->getNewUser()); ?></h3>
						<span class="small text-muted text-uppercase">latest user</span>
					</div>
				</div>
			</div>
		</div>


		
		<!--Total banned users-->
		<div class="col-xl-3 col-sm-6 col-xs-12 mt-3">
			<div class="card">
				<div class=" card-body row">
					<div class="col-6 text-center">
						<h3><i class="fas fa-user-slash fa-2x"></i></h3>
					</div>
					<div class="col-6">
						<h3 class="text-center"><?php Util::display($user->getBannedUserCount()); ?></h3>
						<span class="small text-muted text-uppercase">banned users</span>
					</div>
				</div>
			</div>
		</div>


		
		<!--Total active sub users-->
		<div class="col-xl-3 col-sm-6 col-xs-12 mt-3">
			<div class="card">
				<div class=" card-body row">
					<div class="col-6 text-center">
						<h3><i class="fas fa-user-clock fa-2x"></i></h3>
					</div>
					<div class="col-6">
						<h3 class="text-center"><?php Util::display($user->getActiveUserCount()); ?></h3>
						<span class="small text-muted text-uppercase">active subs</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>

</main>
<?php Util::footer(); ?>
