<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    } 

    public function index() {
        // $this->template->content = View::instance('v_index_index');
        // $this->template->client_files_body = '<script type="text/javascript" src="/js/sign.js"></script>';

        // $this->template->content->error = $error;

        echo $this->template;
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

        $_POST['location'] = "Location...";
        $_POST['website'] = "Website...";
        $_POST['bio'] = "Bio...";

        // Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        // Create an encryption token
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        // Insert this user into the database (and introduce him to Tron...)
        $user_id = DB::instance(DB_NAME)->insert('users',$_POST);

        Router::redirect ('/users/login');
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
        Router::redirect("/users/profile");    
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
        
        // $client_files_head = Array("/bootstrap3-editable/css/bootstrap3-editable.css", "/bootstrap3-editable/js/bootstrap3-editable.js");
        // $this->template->client_files_head = Utils::load_client_files($client_files_head); 
        
        //$client_files_body = ("/js/profile.js");
        $this->template->client_files_body = '<script type="text/javascript" src="../js/profile.js"></script><link href="../bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"><script src="../bootstrap3-editable/js/bootstrap-editable.js"></script>';//Utils::load_client_files($client_files_body);
        
        echo $this->template;

    }

    public function p_edit_profile(){
        foreach ($_POST as $key => $value){
                    if ($_POST[$key] == ""){
                        unset($_POST[$key]);
                    }
        }
        $q = [$_POST['name'] => $_POST['value']];

           
        DB::instance(DB_NAME)->update('users',$q,'WHERE user_id = '.$_POST['pk']);
        Router::redirect('/users/profile');
    }

} # end of the class