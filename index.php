<link rel="stylesheet" href="public/resource/index.css">
<?php include 'public/header&footer/header.php'; ?>
    <?php
   session_start();

   // 플래시 메시지가 있으면 alert로 출력하고, 메시지는 제거
   if (isset($_SESSION['flash_message'])) {
       echo '<script>alert("' . $_SESSION['flash_message'] . '");</script>';
       unset($_SESSION['flash_message']);
   }
   ?>
    <main>
        <h2>메인페이지</h2>
        
    </main>

<?php include 'public/header&footer/footer.php'; ?>

