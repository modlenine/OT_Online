<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet"> -->
    <script src="<?= base_url("js/jquery.min.js") ?>"></script>
    <script src="<?=base_url('js/fontawsome.js')?>"></script>
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
    <link href="<?= base_url() ?>main.css" rel="stylesheet">

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.dataTables.min.css">
    <script src="<?= base_url("js/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= base_url("js/dataTables.responsive.min.js") ?>"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" />
    <script src="<?= base_url("js/dataTables2.responsive.min.js") ?>"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.1/js/dataTables.scroller.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <!-- Data table -->






    <!-- Date pickadate Style -->
    <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.css" id="theme_base">
    <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.date.css" id="theme_date">
    <!-- Date pickadate Style -->






    <style>
    /* thai */
@font-face {
  font-family: 'Sarabun';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?=base_url('assets/fonts/DtVjJx26TKEr37c9aAFJn2QN.woff2')?>) format('woff2');
  unicode-range: U+0E01-0E5B, U+200C-200D, U+25CC;
}
/* vietnamese */
@font-face {
  font-family: 'Sarabun';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?=base_url('assets/fonts/DtVjJx26TKEr37c9aBpJn2QN.woff2')?>) format('woff2');
  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}
/* latin-ext */
@font-face {
  font-family: 'Sarabun';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?=base_url('assets/fonts/DtVjJx26TKEr37c9aBtJn2QN.woff2')?>) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Sarabun';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?=base_url('assets/fonts/DtVjJx26TKEr37c9aBVJnw.woff2')?>) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

        * {
            font-family: 'Sarabun', sans-serif;
        }

        body {
            font-size: .85rem !important;
        }
        thead input {
        width: 100%;
    }
    </style>
</head>
<?php
date_default_timezone_set("Asia/Bangkok");
getModal();
?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-light">
            <div class="app-header__logo">
                <div class="logo-src"><span style="font-size:18px;"><b><span style="color:red">OT</span> ONLINE</b></span></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <!-- <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div> -->
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    
                                </div>
                                <!-- Check Dept For use in jQuery ################################################-->
                                <input hidden type="text" name="checkDept" id="checkDept" value="<?= getUser()->DeptCode ?>">

                                <!-- Check Position For use in jQuery ################################################-->
                                <input hidden type="text" name="checkPosi" id="checkPosi" value="<?= getUser()->posi ?>">


                                <div class="widget-content-left  ml-3 header-user-info">
                                    
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="app-main  scroll-area-sm">
            <div class="app-sidebar sidebar-shadow scrollbar-container">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div> -->
                <!-- <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div> -->
<?php
$dashboard_act = '';
$listot_act = '';
$report_act = '';

if($this->uri->segment(2) == 'listot'){
    $dashboard_act = '';
    $listot_act = 'mm-active';
    $report_act = '';
}else if($this->uri->segment(2) == 'report'){
    $dashboard_act = '';
    $listot_act = '';
    $report_act = 'mm-active';
}else if($this->uri->segment(1) == ''){
    $dashboard_act = 'mm-active';
    $listot_act = '';
    $report_act = '';
}



?>

                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="<?= base_url() ?>" class="<?=$dashboard_act?>">
                                    <i class="metismenu-icon fas fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Program</li>
                            <li>
                                <a href="<?= base_url('main/listot') ?>" class="<?=$listot_act?>">
                                    <i class="metismenu-icon far fa-file-alt"></i>
                                    รายการขอทำโอที
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('main/report')?>" class="<?=$report_act?>">
                                    <i class="metismenu-icon fas fa-print"></i>
                                    รายงาน
                                </a>
                            </li>

                            <!-- <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-diamond"></i>
                                    Elements
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>

                                    <li>
                                        <a href="elements-list-group.html">
                                            <i class="metismenu-icon">
                                            </i>List Groups
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-navigation.html">
                                            <i class="metismenu-icon">
                                            </i>Navigation Menus
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-utilities.html">
                                            <i class="metismenu-icon">
                                            </i>Utilities
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-buttons-standard.html">
                                            <i class="metismenu-icon"></i>
                                            Buttons
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-dropdowns.html">
                                            <i class="metismenu-icon">
                                            </i>Dropdowns
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-icons.html">
                                            <i class="metismenu-icon">
                                            </i>Icons
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-badges-labels.html">
                                            <i class="metismenu-icon">
                                            </i>Badges
                                        </a>
                                    </li>
                                    <li>
                                        <a href="elements-cards.html">
                                            <i class="metismenu-icon">
                                            </i>Cards
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="app-sidebar__heading">User Profile</li>
                            <li>
                                <a>
                                    <i class="metismenu-icon fas fa-user"></i>
                                    สวัสดี &nbsp;<?= getUser()->Fname . "&nbsp;" . getUser()->Lname ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('login/logout') ?>">
                                    <i class="metismenu-icon fas fa-sign-out-alt"></i>
                                    <button class="btn btn-danger btnlogout" onclick="confirm('คุณต้องการออกจากระบบใช่หรือไม่')">Logout</button>
                                </a>
                            </li>

                            <!-- <li class="app-sidebar__heading">Setting</li>
                            <li>
                                <a href="index.html" class="mm-active">
                                    <i class="metismenu-icon fas fa-cog"></i>
                                    Manage User
                                </a>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </div>

            <div class="app-main__outer">
                <div class="app-main__inner">

                    <!-- HEAD ZONE ###############################################
        #####################################################################
    ##########################################################################
#################################################################
        #####################################################################
    ##########################################################################
#################################################################
#################################################################-->
