<?php namespace src\Repositories;
 
interface UserRepository {
   
	public function all(array $related = null);

	public function get($id, $related = null);

	public function getWhere($column, $value, array $related = null);

	public function getRecent($limit, array $related = null);

	public function create(array $data);

	public function update(array $data);

	public function delete($id);

	public function deleteWhere($column, $value);
 
}
