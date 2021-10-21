<?php

require_once 'app/require.php';

$user = new UserController;

Session::init();

if (!Session::isLogged()) { Util::redirect('/login.php'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (isset($_POST["updatePassword"])) {
		$error = $user->updateUserPass($_POST);
	}


	if (isset($_POST["activateSub"])) {
		$error = $user->activateSub($_POST);
	}
}

$uid = Session::get("uid");
$username = Session::get("username");
$admin = Session::get("admin");

$sub = $user->getSubStatus();

Util::banCheck();
Util::head($username);
Util::navbar();

?>


<link href="https://unpkg.com/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@webtor/embed-sdk-js/dist/index.min.js" charset="utf-8" async></script>


<div class="bg-gray-900">
<main class="">

			<?php if (isset($error)) : ?>
				<div class="alert alert-primary" role="alert">
					<?php Util::display($error); ?>
				</div>
			<?php endif; ?>
	
  <div class="mx-auto py-12 px-4 max-w-7xl sm:px-6 lg:px-8 lg:py-24">
    <div class="space-y-12">

         <!-- <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-xs-12 my-3">
            <div class="card">
            	<div class="card-body">
            
            		<h4 class="card-title text-center">Update Password</h4>
            
            		<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            
            			<div class="form-group">
            				<input type="password" class="form-control form-control-sm" placeholder="Current Password" name="currentPassword" required>
            			</div>
            
            			<div class="form-group">
            				<input type="password" class="form-control form-control-sm" placeholder="New Password" name="newPassword" required>
            			</div>
            
            			<div class="form-group">
            				<input type="password" class="form-control form-control-sm" placeholder="Confirm password" name="confirmPassword" required>
            			</div>
            
            			<button class="btn btn-outline-primary btn-block" name="updatePassword" type="submit" value="submit">Update</button>
            
            		</form>
            
            	</div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-xs-12 my-3">
            <div class="row">
            
            
            	<div class="col-12 mb-4">
            		<div class="card">
            			<div class="card-body">
            				<div class="h5 border-bottom border-secondary pb-1"><?php Util::display($username); ?></div>
            				<div class="row">
            					<div class="col-12 clearfix">
            						UID: <p class="float-right mb-0"><?php Util::display($uid); ?></p>
            					</div>
            
            					
            				</div>
            			</div>
            		</div>
            	</div>
            </div>
            </div>
            </div> 
        -->

         <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 content-center justify-center">
            <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200 content-center">
               <div class="flex-1 flex flex-col p-8 content-center">
                  <img class="w-32 h-32 flex-shrink-0 mx-auto rounded-full" src="<?= SUB_DIR ?>/assets/cineplex_small.png" alt="">
                  <h3 class="mt-6 text-gray-900 text-sm font-medium"><?php Util::display($username); ?></h3>
                  <dl class="mt-1 flex-grow flex flex-col justify-between">
                     <dt class="sr-only">Title</dt>
                     <dd class="text-gray-500 text-sm">Binge Watcher!</dd>
                     <dt class="sr-only">Role</dt>
                     <dd class="mt-3">
                        <?php if (Session::isAdmin() == true) : ?>
                        <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">Admin</span>
                        <?php else : ?>
                        <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">User</span>
                        <?php endif; ?>
                     </dd>
                  </dl>
               </div>
               <div>
                  <div class="-mt-px flex divide-x divide-gray-200">
                     <div class="w-0 flex-1 flex">
                        <a class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                           <!-- Heroicon name: solid/mail -->
                           <span class="ml-3">UID: <?php Util::display($uid); ?></span>
                        </a>
                     </div>
                     <div class="-ml-px w-0 flex-1 flex">
                        <a href="#comingSoon" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                           <!-- Heroicon name: solid/phone -->
                           <span class="ml-3">Change Password</span>
                        </a>
                     </div>
                  </div>
               </div>
            </li>
            <!-- More people... -->
         </ul>
      </div>
   </div>
</main>
</div>