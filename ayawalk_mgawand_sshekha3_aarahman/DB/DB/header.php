<header>
	<div id="logo"><img src="images/ncstate-brick-4x1-red.png" alt="NC State Logo" /></div>
	<div id="nav">
		<span id="nav_links_left"><a href="index.php">Home</a></span>
		<span id="nav_links_right" style="text-align:right;">
			<?php
				if (!empty($_SESSION['ID']))
				{
			?>
				<span id="user_info">Signed in as <strong><?php echo $_SESSION['fullname'];?></strong></span>
				 (<a href="logout.php">Sign out</a>)
			<?php
				}
			?>
		</span>
	</div>
</header>
<br/><br/>