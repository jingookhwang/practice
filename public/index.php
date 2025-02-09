<?php
    require_once __DIR__ ."/../util.php";
    use App\util;

    $layout=util::getInstance();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Title</title>
    <style>
        body {
            margin: 0;
            padding-bottom: 60px; /* footer 높이만큼 여백 추가 */
            min-height: 100vh;
        }
        .content-wrapper {
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- C:\Users\진국\OneDrive\Desktop\정리 메모장\php\public -->
    <?php $layout->layout("header")?>
    <div class="content-wrapper">
        <script>
          
            

        </script>
        
    <div class="testtable" id="testtable">
        테스트
    </div>
    <?php $layout->layout("footer")?>
</body>
</html>