<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\User;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Class apiKeyRepository
 *
 * @package ActivismeBE\Repositories
 */
class ApiKeyRepository extends Repository
{
    /**
     * The user variable for the user model.
     *
     * @var User
     */
    private $user;

    /**
     * ApiKeyRepository constructor.
     *
     * @param App        $app
     * @param Collection $collection
     * @param User       $user
     */
    public function __construct(App $app, Collection $collection, User $user)
    {
        parent::__construct($app, $collection);
        $this->user = $user;
    }

    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return ApiKey::class;
    }

    public function createKey($serviceName)
    {
        if($dbKey = $this->model->make(auth()->user())) {
            if ($this->addServiceDescription($dbKey->id, $serviceName)) {
                return $dbKey->key; // Return the generated api key.
            }
        }

        return false; // The api key nor the serv ice description could be added in the DB.
    }

    /**
     * The add the service name to the api key.
     *
     * @param  integer $id          The primary key for the api key in the database.
     * @param  string  $serviceName The name of the service where the api key is needed for.
     * @return bool
     */
    private function addServiceDescription($id, $serviceName)
    {
        $key = $this->model->findOrFail($id);
        $key->service = $serviceName;

        if ($key->save()) { // Update = SUCCESS
            return true; // The service name has been added to the api key.
        }

        return false; // Could nod add the service name to the api key.
    }

    /**
     * Delete all the api keys for the given user.
     *
     * @param  mixed $user
     * @return void
     */
    public function deleteUserApiKeys($user)
    {
        $keys = $this->model->where('apikeyable_id', $user->id)->get();

        foreach($keys as $key) { // Loop through the keys
            $this->delete($key->id); // The key has been deleted.
        }
    }
}