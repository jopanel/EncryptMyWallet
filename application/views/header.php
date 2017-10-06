<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url()?>resources/favicon.ico">

    <title>Encrypt My Wallet - Advanced Cryptocurrency Protection</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>resources/css/cover.css" rel="stylesheet">
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Encrypt My Wallet</h3>
              <nav class="nav nav-masthead">
                <a class="nav-link <?=navBarHelper($this->uri->segment(1),"")?>" href="<?=base_url()?>">Home</a>
                <a class="nav-link <?=navBarHelper($this->uri->segment(1),"encrypt")?>" href="<?=base_url()?>encrypt">Encrypt</a>
                <a class="nav-link <?=navBarHelper($this->uri->segment(1),"decrypt")?>" href="<?=base_url()?>decrypt">Decrypt</a>
                <a class="nav-link <?=navBarHelper($this->uri->segment(1),"store")?>" href="<?=base_url()?>store">Buy An ID</a>
                <a class="nav-link <?=navBarHelper($this->uri->segment(1),"tos")?>" href="<?=base_url()?>tos">TOS</a>
              </nav>
            </div>
          </div>
