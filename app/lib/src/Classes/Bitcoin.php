<?php namespace src\Classes;
use \Config;

class Bitcoin {

	private $bitcoin;

	public function __construct()
	{
		$configArray = Config::get('bitcoin');
		$this->bitcoin = new jsonRPCClient($configArray['url']);
	}

	public function getInfo() {
		return $this->bitcoin->getinfo();
	}

	public function getNewAddress() {
		return $this->bitcoin->getnewaddress('public');
	}	

	public function sendToAddress($address, $amount) {
		return $this->bitcoin->sendtoaddress($address, $amount, 'https://bitindy.com withdrawal');
	}	

}