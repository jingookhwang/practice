### SQL 쿼리 통합 관리

#### 1. 단일 SQL 파일 생성 (`/db.sql`):
-- 게시글 목록 전체조회
-- @name: board.list
SELECT id, regDate, updateDate, title, body  
FROM article 
ORDER BY id DESC;

-- 게시글 단일 조회
-- @name: board.detail
SELECT id, regDate, updateDate, title, body
FROM article
WHERE id = :id;

-- 게시글 등록
-- @name: board.insert
INSERT INTO article (title, body, regDate, updateDate)
VALUES (:title, :body, NOW(), NOW());

-- 게시글 수정
-- @name: board.update
UPDATE article 
SET title = :title, body = :body, updateDate = NOW()
WHERE id = :id;