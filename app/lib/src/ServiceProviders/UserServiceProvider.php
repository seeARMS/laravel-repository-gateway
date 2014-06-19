<?php namespace src\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use src\Repositories\EloquentUserRepository;

class UserServiceProvider extends ServiceProvider {
 
	public function register()
	{
		// Bind the user repository interface to our Eloquent-specific implementation
		// This service provider is called every time the application starts
		$this->app->bind(
			'src\Repositories\UserRepository',
			'src\Repositories\EloquentUserRepository'
		);
	}
}
