<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        // Setup view 
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = "Sign Up";

        // Render template
        echo $this->template;
    }

    public function p_signup(){
        // echo'<pre>';
        // print_r($_POST);
        // echo '</pre>';

        // Extra junk to add to DB 
        $_POST['created'] = Time::now();
        $_POST['modified'] = Time::now();

        // Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        // Create an encryption token
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        // Insert this user into the database (and introduce him to Tron...)
        $user_id = DB::instance(DB_NAME)->insert('users',$_POST);

        echo 'You are entering the World of Chaos.  The end of your life draws near.  Ah-uh-ah-uh-ah';
    }   


    public function login($error = NULL) {
        $this->template->content = View::instance('v_users_login');
        $this->template->title = "Login";

        # Pass data to the view 
        $this->template->content->error = $error;

        echo $this->template; 
    }

    public function p_login(){
        // Sanitize the user entered data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        // Hash submitted password so we can compare it agains db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        // Search the db for this email and password
        // Grab token, if it's there
        $q = "SELECT token 
            FROM users
            WHERE email = '".$_POST['email']."'
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        $q = "SELECT user_id FROM users WHERE email = '".$_POST['email']."'";

        $email = DB::instance(DB_NAME)->select_field($q);

        $q = "SELECT user_id FROM users WHERE email = '".$_POST['email']."' AND password = '".$_POST['password']."'";

        $password = DB::instance(DB_NAME)->select_field($q);

        // If we don't find a token, login fails
        if (!$token){
            if (!$email){
                Router::redirect("/users/login/errorE");
            } else if (!$password){
                Router::redirect("/users/login/errorP");
            } 
        // Otherwise, login
        } else {
        setcookie("token", $token, strtotime('+1 year'), '/');

        // Send them to the main page - or wherever
        Router::redirect("/index");    
        }
    }

    public function logout() {
        // Generate and save a new token for next login
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

    public function profile($user_name = NULL) {

        // If user in blank, they're not logged in.
        // Redirect them to login page
        if(!$this->user){
            Router::redirect('/users/login');
        }
        
        $this->template->content = View::instance('v_users_profile');
        $this->template->title = "Profile of ".$this->user->first_name;
        $this->template->content->user_name = $user_name;
        
        $client_files_head = Array("/css/profile.css");
        $this->template->client_files_head = Utils::load_client_files($client_files_head); 
       
        $client_files_body = Array("/js/profile.min.js");
        $this->template->client_files_body = Utils::load_client_files($client_files_body);
        
        echo $this->template;

    }

} # end of the class