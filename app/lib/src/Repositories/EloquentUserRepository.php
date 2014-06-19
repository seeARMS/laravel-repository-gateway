<?php namespace src\Repositories;
 
use User;

class EloquentUserRepository extends BaseRepository implements UserRepository {
 
  protected $user;

  public function __construct(User $user) {
    parent::__construct($user);
    $this->user = $user;
  }

  	// Any additional methods specific to this repository
  	// go here

}
