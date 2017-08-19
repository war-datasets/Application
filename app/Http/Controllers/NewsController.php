<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\NewsValidator;
use ActivismeBE\Repositories\CategoryRepository;
use ActivismeBE\Repositories\NewsRepository;
use Illuminate\Http\Request;
use ActivismeBE\Traits\Conditions\Helpdesk as HelpdeskConditions;

class NewsController extends Controller
{
    use HelpdeskConditions; // Used to place the conditions in the if/else operators.

    private $categoryRepository;
    private $newsRepository;

    /**
     * NewsController constructor.
     *
     * @param CategoryRepository $categoryRepository
     * @param NewsRepository     $newsRepository
     */
    public function __construct(CategoryRepository $categoryRepository, NewsRepository $newsRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);

        $this->categoryRepository = $categoryRepository;
        $this->newsRepository     = $newsRepository;
    }

    /**
     * Get the index page for the application news. 
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (auth()->check()) { // User is authenticated.
            if ($this->userHasAdminRights()) { // Te authenticated user has admin rights.
                return redirect()->route('news.admin');
            }
        }

        $categories = $this->categoryRepository->getRandomCategories(15);
        $messages   = $this->newsRepository->getIndexMessages(10);

        return view('news.index', compact('categories', 'messages'));
    }

    /**
     * Get the admin panel for the news messages.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $messages = $this->newsRepository->getIndexMessages(25);
        return view('news.admin', compact('messages'));
    }

    /**
     * Show a specific article in the application. 
     * 
     * @param  integer $articleId The id in the database for the article.
     * @return mixed
     */
    public function show($articleId)
    {
        if ($this->newsRepository->articleExists($articleId)) {
            $news = $this->newsRepository->getArticle($articleId);
            return view('news.show', compact('news'));
        }

        flash("Wij konden het nieuwsbericht helaas niet vinden")->error();
        return redirect()->route('news.index');
    }

    /**
     * Create view for a new article. 
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        //
    }

    /**
     * Store a new article in the database. 
     *
     * @param  NewsValidator $input The user given input.
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function store(NewsValidator $input)
    {

    }

    /**
     * Edit view for a specific article in the database.
     *
     * @param  integer $articleId The article id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($articleId)
    {
        return view();
    }

    /**
     * Update a specific news article.
     *
     * @param  NewsValidator $input     The user given input.
     * @param  integer       $articleId The article id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsValidator $input, $articleId)
    {

    }

    /**
     * Delete an article in the application.
     *
     * @param  integer $articleId The article id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($articleId)
    {
    
    }
}
