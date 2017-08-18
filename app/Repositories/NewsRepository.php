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

    /**
     * Get the new messages for the index page.
     *
     * @param  int $paginateLimit The amount of posts you want per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getIndexMessages($paginateLimit)
    {
        return $this->model->paginate($paginateLimit);
    }

    /**
     * Find a new article in the database.
     *
     * @param  integer $articleId The id for the article in the database.
     * @return mixed
     */
    public function getArticle($articleId)
    {
        return $this->findOrFail($articleId);
    }
}