
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.html">Start Bootstrap</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../index.php';
                }
                else {
                    echo 'index.php';
                }?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../pages/conversation.php';
                }
                else {
                    echo 'pages/conversation.php';
                }?>">Topic</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../pages/about.php';
                }
                else {
                    echo 'pages/about.php';
                }?>">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../pages/post.php';
                }
                else {
                    echo 'pages/post.php';
                }?>">Sample Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php 
                if (!isset($repere)) {
                    echo '../pages/contact.php';
                }
                else {
                    echo 'pages/contact.php';
                }?>">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
