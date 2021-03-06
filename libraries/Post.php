<?php

class Post {
	public static function get_posts_by_user($user_id){
		$q = "SELECT 
                posts.content,
                posts.created,
                posts.user_id AS post_user_id,
                users_users.user_id AS follower_id,
                users.first_name,
                users.last_name
            FROM posts
            INNER JOIN users_users 
                ON posts.user_id = users_users.user_id_followed
            INNER JOIN users 
                ON posts.user_id = users.user_id
            WHERE users_users.user_id = '".$user_id."'
            ORDER BY posts.created DESC";

        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        return $posts;
	}
}