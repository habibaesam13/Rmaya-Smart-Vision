<?php

namespace App\Http\Controllers;

use App\Models\Sv_clubs;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Http\Requests\StoreClubRequest;
class ClubsController extends Controller
{
    protected $clubService;

    public function __construct(ClubService $clubService)
    {
        $this->clubService = $clubService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clubs.index', [
            'clubs' => $this->clubService->getAllClubs()
        ]);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClubRequest $request)
    {
        $this->clubService->createClub($request->validated());
        return redirect()->route('clubs.index')->with('success', 'تم إضافة النادي بنجاح.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $club = $this->clubService->getClubById($id);
        return view('clubs.show', compact('club'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $club = $this->clubService->getClubById($id);
        return view('clubs.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->clubService->updateClub($id, $request->validated());
        return redirect()->route('clubs.index')->with('success', 'تم تحديث النادي بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->clubService->deleteClub($id);
        return redirect()->route('clubs.index')->with('success', 'تم حذف النادي بنجاح.');
    }

    public function toggleStatus($id)
    {
        $this->clubService->toggleActiveStatus($id);
        return redirect()->route('clubs.index')->with('success', 'تم تحديث حالة النادي بنجاح.');
    }
}
