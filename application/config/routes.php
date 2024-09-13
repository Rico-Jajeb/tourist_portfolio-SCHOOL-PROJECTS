<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['default_controller'] = 'system_controller/display_portfolio_image';
$route['default_controller'] = 'system_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



//-------------------------------------------------------------
//                  user_page URL SECTION
//-------------------------------------------------------------
$route['main_page'] = 'system_controller/display_portfolio_image';

//-------------------------------------------------------------
//                  user_page URL SECTION
//-------------------------------------------------------------
$route['Dashboard'] = 'features/dashboard/Dashboard_controller';


//-------------------------------------------------------------
//                  TABLE URL SECTION
//-------------------------------------------------------------
$route['portfolio'] = 'features/portfolio/portfolio_controller/portfolio_img_table';
$route['port_video'] = 'features/portfolio/portfolio_controller/portfolio_video_table';

$route['services_table'] = 'features/services/Services_controller/services_table';

$route['about_table'] = 'features/about/about_controller/about_table';
$route['team_table'] = 'features/team/team_controller/team_table';
$route['audit_logs_table'] = 'features/audit_logs/audit_logs_controller/audit_logs_table';
$route['admin_sign_up'] = 'authentication/authentication_controller/admin_sign_up';

//-------------------------------------------------------------
//                  UPLOAD IMAGE/VIDEO URL SECTION
//-------------------------------------------------------------
$route['insert_portfolio_img'] = 'features/portfolio/portfolio_controller/insert_portfolio_image';
$route['insert_portfolio_video'] = 'features/portfolio/portfolio_controller/insert_portfolio_video';
$route['insert_services'] = 'features/services/Services_controller/insert_services';
$route['insert_about'] = 'features/about/about_controller/insert_about';
$route['insert_team'] = 'features/team/team_controller/insert_team';

//-------------------------------------------------------------
//                  UPDATE URL SECTION
//------------------------------------------------------------
$route['update_services'] = 'features/services/Services_controller/update_services';
$route['update_portfolio_image'] = 'features/portfolio/portfolio_controller/update_portfolio_image';
$route['update_portfolio_video'] = 'features/portfolio/portfolio_controller/update_portfolio_video';
$route['update_about'] = 'features/about/about_controller/update_about';
$route['update_team'] = 'features/team/team_controller/update_team';

//-------------------------------------------------------------
//                  CUSTOMIZE URL SECTION
//-------------------------------------------------------------
$route['Customize'] = 'features/customization/customization_controller/get_system_details';
$route['update_shop_name'] = 'features/customization/customization_controller/update_shop_name';
$route['update_shop_quote'] = 'features/customization/customization_controller/update_shop_quote';
$route['update_shop_logo'] = 'features/customization/customization_controller/update_shop_logo';
$route['update_shop_background_image'] = 'features/customization/customization_controller/update_shop_background_image';
$route['update_facebook'] = 'features/customization/customization_controller/update_facebook_link';
$route['update_twitter'] = 'features/customization/customization_controller/update_twitter_link';
$route['update_instagram'] = 'features/customization/customization_controller/update_instagram_link';


//-------------------------------------------------------------
//                  user_page URL SECTION
//-------------------------------------------------------------
$route['sign_in'] = 'authentication/authentication_controller';
$route['sign_up'] = 'authentication/authentication_controller/sign_up';
$route['sign_up_process'] = 'authentication/authentication_controller/user_sign_up_process';
$route['admin_sign_up_process2'] = 'authentication/authentication_controller/admin_sign_up_process2';


$route['login_process'] = 'authentication/authentication_controller/login_process';


$route['admin_logout'] = 'authentication/authentication_controller/admin_logout';
$route['user_logout'] = 'authentication/authentication_controller/user_logout';


