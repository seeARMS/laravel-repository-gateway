<?php namespace src\Gateways;
 
use src\Repositories\UserRepository;

use \Auth;
use \Validator;
use \Hash;
use \Mail;

class UserGateway {
 
	protected $userRepository;

	public function __construct(UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}

	public function createUser($input) {

		// Ensure the user's input matches our validation rules
		$validator = Validator::make($this->user->getRules);

		if ($validator->fails()) {
			$data['success'] = false;
			$data['message'] = $validator->messages();
			return $data;
		}

		$input['password'] = Hash::make($input['password']);
		
		$this->userRepository->create($input);

	    Mail::send('emails.welcome', $input, function($message) use ($input) {
	        $message->to($input['email'], $input['username'])->subject('Welcome to the site!');
	    });

		$data['success'] = true;
		$data['message'] = 'You have successfully registered.';
		return $data;
	}

	public function loginUser($input) {

		$userInfo = array(
			'username' => $input['username'], 
			'password' => $input['password']
		);

		if (Auth::attempt($userInfo)) {
			$data['success'] = true;
		} else {
			$data['success'] = false;
			$data['message'] = 'Your username or password was incorrect.';
		}

		return $data;

	}
 
}

