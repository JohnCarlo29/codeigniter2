<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>LAC</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?= base_url('pets/today_schedules'); ?>""><i class="fa fa-calendar"></i> Today's Schedule</a></li>
                  <li><a><i class="fa fa-barcode"></i> Transaction <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('items/retail'); ?>">Retail</a></li>
                      <li><a href="<?= base_url('items/order'); ?>">Order Items</a></li>
                      <li><a href="<?= base_url('items/incoming'); ?>">Incoming Items</a></li>
                      <li><a href="<?= base_url('items/stocks'); ?>">Stock Items</a></li>
                      <li><a href="<?= base_url('items/delivered'); ?>">Delivered Items</a></li>
                      <li><a href="<?= base_url('items/sold_items'); ?>">Sold Items</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user-md"></i> Health Care <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('clients'); ?>">Register Client</a></li>
                      <li><a href="<?= base_url('pets'); ?>">Register Pets</a></li>
                      <li><a href="<?= base_url('pets/admission'); ?>">Admission</a></li>
                      <li><a href="<?= base_url('pets/schedules'); ?>">Schedule</a></li>
                      <li><a href="<?= base_url('pets/history'); ?>">History</a></li>
                      <li><a href="<?= base_url('pets/revenue'); ?>">Revenue</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cut"></i> Grooming <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('grooming/avail'); ?>">Avail</a></li>
                      <li><a href="<?= base_url('grooming/grooming_list');?>">Grooming List</a></li>
                      <li><a href="<?= base_url('grooming/revenue'); ?>">Grooming Revenue</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-files-o"></i> Other Datas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= base_url('products'); ?>">Products</a></li>
                      <li><a href="<?= base_url('suppliers'); ?>">Supplier</a></li>
                      <li><a href="<?= base_url('products/category'); ?>">Category</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="page-content">