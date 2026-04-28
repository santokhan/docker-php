-- =========================
-- USERS
-- =========================
INSERT INTO users (name, email, password, role, parent_id)
VALUES 
('Admin Parent', 'admin@example.com', 'hashed_password', 'parent', NULL);

-- Get parent id safely
SET @parent_id = LAST_INSERT_ID();

INSERT INTO users (name, email, password, role, parent_id)
VALUES 
('User One', 'user1@example.com', 'hashed_password', 'user', @parent_id),
('User Two', 'user2@example.com', 'hashed_password', 'user', @parent_id);

-- =========================
-- IMAGE (linked to User One)
-- =========================
SET @user1_id = (SELECT id FROM users WHERE email='user1@example.com');

INSERT INTO images (user_id, filename, mime_type, size)
VALUES 
(@user1_id, 'sample.jpg', 'image/jpeg', 102400);

SET @image_id = LAST_INSERT_ID();

-- =========================
-- BLOG
-- =========================
INSERT INTO blogs (user_id, title, slug, content, featured_image_id, status)
VALUES 
(@user1_id, 'My First Blog', 'my-first-blog', 'This is blog content', @image_id, 'published');

SET @blog_id = LAST_INSERT_ID();

-- =========================
-- COMMENT (reply system safe)
-- =========================
INSERT INTO comments (blog_id, user_id, parent_id, content)
VALUES 
(@blog_id, @user1_id, NULL, 'Great post!');