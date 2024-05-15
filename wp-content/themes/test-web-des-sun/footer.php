  <footer class="footer">
    <div class="container">
      <div class="footer__wrap">
        <?php ob_start(); dynamic_sidebar('footer_col_1'); $footer_col_1 = ob_get_clean(); 
          echo $footer_col_1 ? $footer_col_1 :'';
        ?>
        <?php ob_start(); dynamic_sidebar('footer_col_2'); $footer_col_2 = ob_get_clean(); 
          echo $footer_col_2 ? $footer_col_2 :'';
        ?>
        <?php ob_start(); dynamic_sidebar('footer_col_3'); $footer_col_3 = ob_get_clean(); 
          echo $footer_col_3 ? $footer_col_3 :'';
        ?>
        <?php ob_start(); dynamic_sidebar('footer_col_4'); $footer_col_4 = ob_get_clean(); 
          echo $footer_col_4 ? $footer_col_4 :'';
        ?>
      </div>
    </div>
  </footer>
</body>

  <?php wp_footer(); ?>
</html>