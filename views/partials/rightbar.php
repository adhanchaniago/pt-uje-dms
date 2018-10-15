<div class="card">
	<div class="card-body text-center">
		<img src="/assets/img/profil/<?php echo getProfile()['foto'] ?>" width="150px" class="rounded-circle">
		<p class="profile-name"><?php echo strtoupper(getProfile()['nama']).'<br>'.strtolower($_SESSION['akses']) ?></p>
	</div>
</div>