<!DOCTYPE html>
<html lang="ko">
<?php
        include "..\lib\header.php";
?>
<body>

<div class="board-container">
        <div class="board-title">자유게시판</div>
    <form action="write.php" method="post">    
        <table>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>글쓴이</th>
                    <th>등록일</th>
                    <th>조회</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="hidden" name="idx" value="1">
                    1
                </td>
                <td>
                    <input type="hidden" name="write" value="글쓰기 테스트 1011">
                    글쓰기 테스트 1011
                </td>
                <td>
                    <input type="hidden" name="name" value="포길동">
                    포길동
                </td>
                <td>
                    <input type="hidden" name="date" value="2023-02-27">
                    2023-02-27
                </td>
                <td>
                    <input type="hidden" name="code" value="2">
                    2
                </td>
            </tr>
            </tbody>
        </table>
    
        <div class="pagination">
            <a href="#">First</a>
            <a href="#">1</a>
        </div>
        <div>
            <button type="submit" >글쓰기</button>
        </div>
        </form>
    </div>
</body>
</html>