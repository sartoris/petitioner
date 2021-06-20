    <div class="navbar">
        <ul>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*Petition$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">Petitions<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "updatePetition") : ?>class="navbarselected" <?php endif; ?>href="update_petition.php">Update Petition</a>
                    <a <?php if ($page == "checkoutPetition") : ?>class="navbarselected" <?php endif; ?>href="checkout_petitions.php">Bulk Checkout</a>
<?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1) : ?>
                    <a <?php if ($page == "generatePetition") : ?>class="navbarselected" <?php endif; ?>href="generate_petitions.php">Generate Batch</a>
<?php endif; ?>
                    <a href="export_petitions.php">Export Petition List</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*Contact$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">Contacts<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "updateContact") : ?>class="navbarselected" <?php endif; ?>href="update_contact.php">Update Contact</a>
                    <a <?php if ($page == "addContact") : ?>class="navbarselected" <?php endif; ?>href="add_contact.php">Add Contact</a>
<?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1) : ?>
                    <a <?php if ($page == "approveRegistrants") : ?>class="navbarselected" <?php endif; ?>href="approve_registrants.php">Approve Registrants</a>
<?php endif; ?>
                    <a href="export_contacts.php">Export Contact List</a>
                </div>
            </li>
<?php if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1) : ?>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*Depot$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">Depots<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "updateDepot") : ?>class="navbarselected" <?php endif; ?>href="update_depot.php">Update Depot</a>
                    <a <?php if ($page == "addDepot") : ?>class="navbarselected" <?php endif; ?>href="add_depot.php">Add Depot</a>
                    <a href="export_depots.php">Export Depot List</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*Organization$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">Organizations<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "updateOrganization") : ?>class="navbarselected" <?php endif; ?>href="update_organization.php">Update Organization</a>
                    <a <?php if ($page == "addOrganization") : ?>class="navbarselected" <?php endif; ?>href="add_organization.php">Add Organization</a>
                    <a href="export_organizations.php">Export Organization List</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*User$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">Users<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "updateUser") : ?>class="navbarselected" <?php endif; ?>href="update_user.php">Update User</a>
                    <a <?php if ($page == "addUser") : ?>class="navbarselected" <?php endif; ?> href="add_user.php">Add User</a>    
                </div>
            </li>
<?php endif; ?>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*Reports$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">Reports<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "Reports") : ?>class="navbarselected" <?php endif; ?>href="<?php echo $reportsLocation ?>/index.php" target="_blank">Reports</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="dropbtn<?php if (preg_match("/^.*Profile$/", $page)) : ?> navbarselected<?php endif; ?>"
                    href="javascript:void(0)">My Profile<i class="fa fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a <?php if ($page == "updateProfile") : ?>class="navbarselected" <?php endif; ?>href="update_profile.php">Update Profile</a>
                    <a href="logoff.php">Log off</a>
                </div>
            </li>
        </ul>
    </div>
