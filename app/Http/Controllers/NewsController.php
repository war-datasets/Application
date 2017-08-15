<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\NewsValidator;
use ActivismeBE\Repositories\CategoryRepository;
use ActivismeBE\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->getRandomCategories(15);
        $messages   = $this->newsRepository->getIndexMessages(10);

        return view('news.index', compact('categories', 'messages'));
    }

    /**
     * @param  integer $articleId
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        //
    }

    public function store(NewsValidator $input)
    {

    }

    public function edit($articleId)
    {

    }

    public function update(NewsValidator $input, $articleId)
    {

    }

    public function delete($articleId)
    {

    }
}
