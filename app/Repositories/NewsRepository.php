<?php 

namespace ActivismeBE\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use ActivismeBE\News;

/**
 * Class NewsRepository
 *
 * @package ActivismeBE\Repositories
 */
class NewsRepository extends Repository
{
    /**
     * The related database model.
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }


    public function getIndexMessages($paginateLimit)
    {
        return $this->model->paginate($paginateLimit);
    }


    public function getArticle($articleId)
    {
    }
}