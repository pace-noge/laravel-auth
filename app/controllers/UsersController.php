<?php

class UsersController extends BaseController {
    protected $layout = "layouts.main";

    public function __construct() {
        $this->beforeFilter('csrf', array("on"=>"post"));
        $this->beforeFilter('auth', array("only"=>"getDashboard"));
    }

    public function getLogin() {
        $this->layout->content = View::make('users.login');
    }

    public function getRegister() {
        $this->layout->content = View::make('users.register');
    }

    public function postSignin() {
        if(Auth::attempt(array('email'=>Input::get('email'), "password"=>Input::get('password')))) {
            return Redirect::to('users/dashboard')->with('message', "yo're now logged in");
        } else {
            return Redirect::to('users/login')
                ->with('message', 'Your username/password combination was incorrect')
                ->withInput();
        }
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);

        if($validator->passes()) {
            $user = new User();
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            Mail::send('users.mails.welcome', array('firstname'=>Input::get('firstname')), function($message){
                $message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'))->subject('Welcome to the Laravel 4 Auth App!');
            });

            return Redirect::to('users/login')->with('message', 'Thanks For registering!');
        } else {
            return Redirect::to('users/register')->with('message', 'The following errors occured')->withErrors($validator)->withInput();
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')
        ->with('message', "You are now logged out");
    }

    public function getDashboard() {
        $this->layout->content = View::make('users.dashboard');
    }
}
