<?php
class DatabaseHelper
{
    public $db;
    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    const QUERIES = [
        "SELECT_USER_PASSWORD" => ["SELECT password FROM users WHERE id = ? LIMIT 1", "i"],
        "CHECK_LOGIN" => ["SELECT id, username, password, salt FROM users WHERE email = ? LIMIT 1", "s"],
        "CHECK_LOGIN_ATTEMPTS" => ["SELECT COUNT(*) FROM login_attempts WHERE user_id = ? AND created_at > ?", "is"],
        "INSERT_LOGIN_ATTEMPT" => ["INSERT INTO login_attempts (user_id, created_at) VALUES (?, NOW())", "i"],
        "SELECT_USER_INFO" => ["SELECT * FROM users WHERE id = ?", "i"],
        "INSERT_USER" => ["INSERT INTO users (username, password, salt, full_name, email, profile_picture, description, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())", "sssssss"],
        "UPDATE_USER_INFO" => ["UPDATE users SET username = ?, password = ?, salt = ?, full_name = ?, email = ?, profile_picture = ?, description = ? WHERE id = ?", "sssssssi"],
        "SEARCH_POSTS" => ["SELECT * FROM posts WHERE body LIKE ?", "s"],
        "SELECT_POST" => ["SELECT p.* FROM posts p WHERE p.id = ?", "i"],
        "INSERT_POST" => ["INSERT INTO posts (user_id, body, picture, created_at) VALUES (?, ?, ?, NOW())", "iss"],
        "INSERT_POST_SHARE" => ["INSERT INTO post_shares (user_id, post_id, created_at) VALUES (?, ?, NOW())", "ii"],
        "INSERT_SHARE" => ["INSERT INTO posts (user_id, body, created_at, parent_id) VALUES (?, ?, NOW(), ?)", "isi"],
        "INSERT_COMMENT" => ["INSERT INTO comments (post_id, user_id, body, created_at, parent_id, post_owner_id) VALUES (?, ?, ?, NOW(), ?, ?)", "iisii"],
        "SELECT_ALL_POSTS" => ["SELECT p.* FROM posts p ORDER BY p.created_at DESC", ""],
        "SELECT_USER_POSTS" => ["SELECT p.* FROM posts p  WHERE p.user_id = ? ORDER BY created_at DESC", "i"],
        "SELECT_USER_FEED" => ["SELECT DISTINCT posts.* FROM posts JOIN users ON posts.user_id = users.id JOIN follows ON users.id = follows.followed_id WHERE follows.follower_id = ? OR posts.user_id = ? ORDER BY posts.created_at DESC", "ii"],
        "CHECK_POST_VOTE" => ["SElECT COUNT(*) FROM post_votes WHERE post_id = ? AND user_id = ?", "ii"],
        "CHECK_COMMENT_VOTE" => ["SElECT COUNT(*) FROM comment_votes WHERE comment_id = ? AND user_id = ?", "ii"],
        "UNVOTE_POST" => ["DELETE FROM post_votes WHERE user_id = ? AND post_id = ?", "ii"],
        "VOTE_POST" => ["INSERT INTO post_votes (user_id, post_id) VALUES (?, ?)", "ii"],
        "UNVOTE_COMMENT" => ["DELETE FROM comment_votes WHERE user_id = ? AND comment_id = ?", "ii"],
        "VOTE_COMMENT" => ["INSERT INTO comment_votes (user_id, comment_id) VALUES (?, ?)", "ii"],
        "SELECT_POST_VOTES_COUNT" => ["SELECT COUNT(*) FROM post_votes WHERE post_id = ?", "i"],
        "SELECT_COMMENT_VOTES_COUNT" => ["SELECT COUNT(*) FROM comment_votes WHERE comment_id = ?", "i"],
        "SELECT_COMMENT" => ["SELECT * FROM comments WHERE id = ?", "i"],
        "SELECT_SAVED_POSTS" => ["SELECT * FROM saved_posts WHERE post_id = ?", "i"],
        "SELECT_POST_SHARES" => ["SELECT * FROM post_shares WHERE post_id = ?", "i"],
        "SELECT_POST_COMMENTS" => ["SELECT * FROM comments WHERE post_id = ? AND parent_id IS NULL", "i"],
        "SELECT_POST_COMMENTS_COUNT" => ["SELECT COUNT(*) FROM comments WHERE post_id = ?", "i"],
        "SELECT_NESTED_COMMENTS" => ["SELECT * FROM comments WHERE parent_id = ?", "i"],
        "SELECT_SUGGESTED_USERS" => ["SELECT id, username, full_name, profile_picture FROM users WHERE NOT id = ? ORDER BY RAND() LIMIT ?", "ii"],
        "CHECK_USER_FOLLOW" => ["SElECT COUNT(*) FROM follows WHERE follower_id = ? AND followed_id = ?", "ii"],
        "ADD_FOLLOWER" => ["INSERT INTO follows (follower_id, followed_id) VALUES (?,?)", "ii"],
        "DELETE_FOLLOWER" => ["DELETE FROM follows WHERE follower_id = ? and followed_id = ?", "ii"],
        "SELECT_FOLLOWERS" => ["SELECT * FROM follows WHERE followed_id = ?", "i"],
        "SELECT_FOLLOWED" => ["SELECT * FROM follows WHERE follower_id = ?", "i"],
        "SELECT_USER_ALL_NOTIFICATIONS" => ["SELECT * FROM notifications WHERE user_id = ?", "i"],
        "SELECT_USER_UNSEEN_NOTIFICATIONS" => ["SELECT * FROM notifications WHERE user_id = ? AND seen = FALSE", "i"],
        "INSERT_NOTIFICATION" => ["INSERT INTO notifications (user_id, content, href, created_at) VALUES (?, ?, ?, NOW())", "iss"],
        "DISMISS_NOTIFICATION" => ["UPDATE notifications SET seen = 1 WHERE id = ?", "i"],
        "DELETE_NOTIFICATION" => ["DELETE FROM notifications WHERE id = ?", "i"],
        "CHECK_TAG" => ["SELECT COUNT(*) FROM tags WHERE tag = ?", "s"],
        "INSERT_TAG" => ["INSERT INTO tags (tag) values (?)", "s"],
        "INSERT_POST_TAG" => ["INSERT INTO post_tags (post_id, tag_id) values (?, ?)", "ii"],
        "SELECT_POST_TAG" => ["SELECT posts.* FROM posts JOIN post_tags ON posts.id = post_tags.post_id JOIN tags ON tags.id = post_tags.tag_id WHERE tags.tag = ?", "s"],
        "SELECT_ALL_POST_TAG" => ["SELECT DISTINCT posts.* FROM posts JOIN post_tags ON posts.id = post_tags.post_id JOIN tags ON tags.id = post_tags.tag_id", ""],
        "SELECT_TAG" => ["SELECT DISTINCT * FROM tags WHERE tag = ?", "s"],
        "SELECT_TRENDING_TAGS" => ["SELECT tags.tag, COUNT(post_tags.tag_id) AS popularity FROM tags JOIN post_tags ON tags.id = post_tags.tag_id GROUP BY tags.tag ORDER BY popularity DESC LIMIT ?", "i"],
    ];

    public function preparedQuery(string $queryName, ...$params)
    {
        if (!array_key_exists($queryName, self::QUERIES)) {
            throw new Exception("Invalid query name.");
        }
        $bind_params = self::QUERIES[$queryName][1];
        $query = self::QUERIES[$queryName][0];
        $stmt = $this->db->prepare($query);
        if ($bind_params != "") {
            $stmt->bind_param($bind_params, ...$params);
        }
        $stmt->execute();

        // if it is an insert or delete statement it will return the affected rows
        if ($stmt->affected_rows > 0) {
            return [
                "affected_rows" => $stmt->affected_rows,
                "insert_id" => $stmt->insert_id
            ];
        }
        $result = $stmt->get_result();
        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
        else return false;
    }
}
