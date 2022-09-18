<?php 
    session_unset();
    echo '
      <script>
        $(document).ready(function(){
          window.location="?page=home";
        })
      </script>
    ';
?>