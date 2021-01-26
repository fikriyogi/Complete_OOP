<?php 	
	include('header.php');
?>
<?php 
	if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
	<div class="success-message" id="box-pesan"><?php echo $_SESSION['message']; ?></div>
	<?php
	unset($_SESSION['message']);
	}
?>
<h3>Settings</h3>
<hr/>
    <div class="container">
	    <div class="row">
            <div class="col-md-4">
                <div class="menu">
                    <div class="list-group">
                        <a href="settings.php?tab=general" class="list-group-item list-group-item-action <?php echo $active; ?>" aria-current="true">
                            General
                        </a>
                        <a href="settings.php?tab=account" class="list-group-item list-group-item-action <?php echo $active; ?>">Account Setting</a>
                        <a href="settings.php?tab=security" class="list-group-item list-group-item-action <?php echo $active; ?>">Security &amp; Password</a>
                        <a href="settings.php?tab=mobile" class="list-group-item list-group-item-action <?php echo $active; ?>">Mobile Phone</a>
                        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Vestibulum at eros</a>
                    </div>

    <!--                <ul class="menu-list">-->
    <!--                    <li><a href="settings.php?tab=general">Web</a></li>-->
    <!--                    <li><a href="settings.php?tab=account">General</a></li>-->
    <!--                    <li><a href="settings.php?tab=security">Security and Login</a></li>-->
    <!--                    <li><a href="settings.php?tab=mobile">Mobile</a></li>-->
    <!--                </ul>-->
                </div>
            </div>
            <div class="col-md-8">
                <div class="badan">
                    <?php
                        if(isset($_GET['tab'])){
                            $page = $_GET['tab'];

                            switch ($page) {
                                case 'general':
                                    include "pages/settings/general.php";
                                    break;
                                case 'account':
                                    include "pages/settings/account.php";
                                    $active = "active";
                                    break;
                                case 'security':
                                    include "pages/settings/security.php";
                                    $active = "active";
                                    break;
                                case 'mobile':
                                    include "pages/settings/mobile.php";
                                    $active = "active";
                                    break;
                                default:
                                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                                    break;
                            }
                        }else{
                            include "pages/settings/general.php";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>



<?php include 'footer.php' ?>