<?php
    
    require_once 'Setup.php';

    $setup = new Setup();
    $setup->createTables();
    $setup->setupAdminAccount();
    echo "Setup completed successfully!";
    
?>