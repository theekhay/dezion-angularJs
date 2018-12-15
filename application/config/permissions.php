<?php
/**
 * @package        permissions.php
 * @subpackage     MyApp
 * @author         Anirudh K. Mahant
 * @created        09/05/2016 - 9:30 PM
 * @license        Creative Commons 3.0 Attribution
 * @licenseurl    https://creativecommons.org/licenses/by/3.0/us/
 * @desc           User Permissions Configuration
 * @link           https://www.ravendevelopers.com
 */

// TABLE TAKES REFRENCES FROM authentication.php IN community_auth CONFIG FILE
$config['user_role_permissions'] = array(
  
  'manager' => array(
    'dashboard'        => array('index'),
    'customer'         => array('index', 'add', 'edit', 'remove'),
    'orders'           => array('index', 'add', 'edit', 'remove'),
    'myauth'           => array('login', 'logout', 'recover', 'recovery_verification'),
  ),


  'staff' => array(
    'dashboard'        => array('index'),
    'customer'         => array('index', 'add', 'edit', 'remove'),
    'orders'           => array('index', 'add'), // Removed 'edit', 'remove' actions
    'myauth'           => array('login', 'logout', 'recover', 'recovery_verification'),
  ),

  
  'operator' => array(
    'dashboard'        => array('index'),
    'customer'         => array('index', 'add'), // Removed 'edit', 'remove' actions
    'orders'           => array('index'), // Removed 'add', 'edit', 'remove' actions
    'myauth'           => array('login', 'logout', 'recover', 'recovery_verification'),
  )
);