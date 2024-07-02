<!DOCTYPE html>
<html>
    <body>
    
        <?php
            session_start();
            echo "<script>
                if (confirm('Are you sure to logout?')) { 
                window.location='index.php?logout=1'; 
                }else{
                
                }
                </script>";
        ?>
    </body>
</html>