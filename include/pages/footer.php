<!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
           <p class="copyright text-muted">Copyright &copy;Les champions 2021</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php 
                if (!isset($repere)) {
                    echo '../vendor/jquery/jquery.min.js';
                }
                else {
                    echo 'vendor/jquery/jquery.min.js';
                }?>"></script>

  <script src="<?php 
                if (!isset($repere)) {
                    echo '../vendor/bootstrap/js/bootstrap.bundle.min.js';
                }
                else {
                    echo 'vendor/bootstrap/js/bootstrap.bundle.min.js';
                }?>"></script>

  <!-- Contact Form JavaScript -->
  <script src="<?php 
                if (!isset($repere)) {
                  echo '../js/jqBootstrapValidation.js';
                }
                else {
                  echo 'js/jqBootstrapValidation.js';
                }?>"></script>

  <script src=" <?php 
                  if (!isset($repere)) {
                      echo '../js/contact_me.js';
                  }
                  else {
                      echo 'js/contact_me.js';
                  }?>"></script>

  <!-- Custom scripts for this template -->
                
  <script src="<?php 
                if (!isset($repere)) {
                    echo '../js/clean-blog.min.js';
                }
                else {
                    echo 'js/clean-blog.min.js';
                }?>"></script>

</body>
</html>