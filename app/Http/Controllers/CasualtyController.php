<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\CasualtyRepository;
use Illuminate\Http\Request;

class CasualtyController extends Controller
{
    /**
     * The casualty repository
     *
     * @var $casualtyRepository;
     */
    private $casualtyRepository;

    /**
     * IndexController constructor.
     *
     * @param  CasualtyRepository $casualtyRepository
     */
    public function __construct(CasualtyRepository $casualtyRepository)
    {
        $this->casualtyRepository = $casualtyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casualties = $this->casualtyRepository->paginate(50);
        $count      = $this->casualtyRepository->countAllCasualties();

        return view('casualties.index', compact('casualties', 'count'));
    }

    public function search(Request $input)
    {
        $casualties = $this->casualtyRepository->search($input->term)->paginate(50);
        $count      = $casualties->count();

        return view('casualties.search', compact('casualties', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $serviceNumber
     * @return \Illuminate\Http\Response
     */
    public function show($serviceNumber)
    {
        $casualty = $this->casualtyRepository->findBy('service_no', $serviceNumber);

        return view('casualties.show', compact('casualty'));
    }
}
