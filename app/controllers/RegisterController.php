<?php

use src\Gateways\UserGateway;

class RegisterController extends BaseController {

	public function __construct(UserGateway $userGateway) {
  		$this->userGateway = $userGateway;
	}

	public function getIndex() {
		return View::make('register.index');
	}

	public function postIndex() {

		$data = $this->userGateway->createUser(Input::all());

		if ($data['success']) {
			$this->userGateway->loginUser(Input::all());
			return Redirect::route('settings')->with($data);
		}
		else {
			return Redirect::route('register')->withErrors($data['message'])
											  ->with($data)
											  ->withInput();
		}
	}


}
