<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    } 

    public function signin($error = NULL) {
        # Setup view 

        $this->template->content1 = View::instance('v_users_signup');
        $this->template->content2 = View::instance('v_users_login');
        $this->template->title = "Soapbox - Sign In";

        $this->template->content1->error = $error;
        $this->template->content2->error = $error;

        $client_files_head = Array("../css/signin.css");
        $this->template->client_files_head = Utils::load_client_files($client_files_head); 

        # Render template
        echo $this->template;
    }

    public function p_signup(){

        # Extra junk to add to DB 
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();

        $_POST['location'] = "Location...";
        $_POST['website'] = "Website...";
        $_POST['bio'] = "Bio...";

        # Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Create an encryption token
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        # Check to see if this email is already in DB
        $q = "SELECT user_id FROM users WHERE email = '".$_POST['email']."'";

        $error = DB::instance(DB_NAME)->select_field($q);

        if ($error){
            Router::redirect('/users/signin/errorEmail');
        } else {

        }
        # Insert this user into the database (and introduce him to Tron...)
        DB::instance(DB_NAME)->insert('users',$_POST);

        # Now let's go ahead and sign in
        $token = Token::look_for_token($_POST['email'], $_POST['password']);
        setcookie("token", $token, strtotime('+1 year'), '/');

        # Finally, user should be following him or herself 
        $q = "SELECT user_id FROM users WHERE email = '".$_POST['email']."'";
        $user_id = DB::instance(DB_NAME)->select_field($q);        

        $insert = Array("created"=>Time::now(), "user_id"=>$user_id, "user_id_followed"=> $user_id);  
        DB::instance(DB_NAME)->insert("users_users",$insert);

        Router::redirect ('/users/profile');
    }   

    public function p_login(){
        # Sanitize the user entered data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it agains db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Grab token, if it's there
        $token = Token::look_for_token($_POST['email'], $_POST['password']);

        # If we don't find a token, login fails
        if (!$token){
            Router::redirect("/users/signin/errorLogin");

        # Otherwise, login
        } else {
        setcookie("token", $token, strtotime('+1 year'), '/');

        # Send them to the main page - or wherever
        Router::redirect("/users/profile");    
        }
    }

    public function logout() {
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array has one entry
        $data = Array("token"=>$new_token);

        # Update 
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete the token cookie by setting to to a date in the past
        setcookie("token", "", strtotime("-1 year"), "/");

        # Send them back to index
        Router::redirect("/"); 
    }

    public function profile($user_id = NULL) {
    # This view is only accessable to logged in users 
        if(!$this->user){
            Router::redirect('/users/signin/errorProtected');
        } 

        # Whether we're looking at our profile or another's,
        # there will be posts loaded, so start with this

        $this->template->content3 = View::instance('v_posts_index');

        # We're also going to use the same CSS, so load that

        $client_files_head = Array("/css/profile.css");
        $this->template->client_files_head = Utils::load_client_files($client_files_head); 
        
        # Then check to see if we're looking at our own profile
        # i.e. there's no additional argument passed into profile()
        if($user_id == NULL){

        # Load up the editable profile
            $this->template->content1 = View::instance('v_users_profile_self');

        # Load up the add post widget 
            $this->template->content2 = View::instance('v_posts_add');

        # Grab the posts associated with this user 
            $this->template->content3->posts = Post::get_posts_by_user($this->user->user_id);

        # Load the title from the user object's name properties 
            $this->template->title = "Profile of ".$this->user->first_name." ".$this->user->last_name;
        
        # Load the JS and CSS that handles the x-editable stuff
            $this->template->client_files_body = '<script type="text/javascript" src="../js/profile.js"></script><link href="../bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"><script src="../bootstrap3-editable/js/bootstrap-editable.js"></script>';

        } else {

        # Load the read only profile 
            $this->template->content1 = View::instance('v_users_profile_other');
        
        # Get DB info about user 
            $q = "SELECT first_name, last_name, user_id, bio, location, website
            FROM users
            WHERE user_id = ".$user_id;
 
        # Store the result array in the variable $user
            $user = DB::instance(DB_NAME)->select_rows($q);

        # Make user properties accessable to the profile view 
            $this->template->content1->user = $user;

        # Grab the posts associated with this user        
            $this->template->content3->posts = Post::get_posts_by_user($user_id);

        # Get the title out of $users 
            $this->template->title = "Profile of ".$user[0]['first_name']." ".$user[0]['last_name'];
        }

         # Build the query to figure out what connections does this user already have? 
        $q = "SELECT * 
            FROM users_users
            WHERE user_id = ".$this->user->user_id;

        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

        $this->template->content3->connections = $connections;
        $this->template->content1->connections = $connections;

        # Go!
        echo $this->template;

    }

    public function p_edit_profile(){
        
        $q = [$_POST['name'] => $_POST['value'], 'modified' => Time::now()];

        DB::instance(DB_NAME)->update('users',$q,'WHERE user_id = '.$_POST['pk']);
        Router::redirect('/users/profile');
    }

    public function p_search(){
        # Sanitize $_POST data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Set up query to grab user info 
        $q = "SELECT first_name, last_name, user_id, bio, location
            FROM users
            WHERE first_name LIKE '%".$_POST['search']."%'
            OR last_name LIKE '%".$_POST['search']."%'
            OR bio LIKE '%".$_POST['search']."%'
            OR location LIKE '%".$_POST['search']."%'";   

        # Query and put the results in the $results array
        $results = DB::instance(DB_NAME)->select_rows($q);

    //     # Package up the array for ease of transport 
    //     // $results = serialize($results);

    //     # Ship out the data 
    //     Router::redirect("/users/search/");
    // }

    // public function search($results = NULL){

        # Unpackage data  
        //$results = unserialize($results);

         $client_files_head = Array("/css/search.css");
        $this->template->client_files_head = Utils::load_client_files($client_files_head); 

        # Display results
        $this->template->content1 = View::instance('v_users_search');

        # Load results into template 
        $this->template->content1->results = $results;

        echo $this->template;
    }
} # end of the class