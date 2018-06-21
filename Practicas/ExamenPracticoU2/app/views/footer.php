<footer class="row">
      <div class="large-12 columns">
        <hr/>
        <div class="row">
          <div class="large-6 columns">
            <p>&copy; Copyright <?php echo date('Y'); ?>.</p>
          </div>
          <div class="large-6 columns">
            <ul class="inline-list right">
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo RUTA_URL?>/public/js/vendor/modernizr.js"></script>
    <script>
      document.write('<script src=./js/vendor/' +
      ('__proto__' in {} ? 'zepto' : 'jquery') +
      '.js><\/script>')
    </script>
    <script src="./js/zepto.js"></script>
    <script src="./js/vendor/jquery.js"></script>
    <script src="./js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
    <script src="./js/vendor/jquery.js"></script>
    <script src="./js/foundation/foundation.js"></script>
    <script>
          $(document).foundation();

          var doc = document.documentElement;
          doc.setAttribute('data-useragent', navigator.userAgent);
        </script>
  </body>
</html>
