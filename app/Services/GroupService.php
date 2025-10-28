<?php

namespace App\Services;

use App\Models\Sv_team;
use App\Models\Sv_member;
use App\Models\Sv_weapons;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Public\GroupRegistrationRequest;

class GroupService
{
    protected PersonalService $personalService;
    /**
     * Create a new class instance.
     */

    public function __construct(PersonalService $personalService)
    {
        $this->personalService = $personalService;
    }

    //Helpers
    public function getGroupById($tid)
    {
        return Sv_team::findOrfail($tid);
    }
    public function getGroupName($tid)
    {
        $group = $this->getGroupById($tid);
        return $group->name;
    }


    //المسجلين فرق
    public function getGroups()
    {
        $groups = Sv_team::with(['club', 'weapon'])->orderByDesc('tid');
        $groups_without_pag = $groups->get();
        $groups = $groups->cursorPaginate(config('app.admin_pagination_number'));
        return ['groups' => $groups, 'groups_without_pag' => $groups_without_pag];
    }
    //تقرير الفرق
    public function getMembersWithGroups()
    {
        $query = Sv_member::with(['team', 'club', 'weapon'])
            ->where('reg_type', 'group');
        $members = $query->orderByDesc('mid')->cursorPaginate(config('app.admin_pagination_number')); // actual data
        $members_without_pag = $query->orderByDesc('mid')->get();
        return [
            'members' => $members,
            'members_without_pag' => $members_without_pag,
        ];
    }


    public function searchQuery(Request $request)
    {
        // Validate date inputs
        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
        ], [
            'date_to.after_or_equal' => 'يجب أن يكون تاريخ النهاية بعد أو يساوي تاريخ البداية.',
        ]);

        // Query builder
        return Sv_team::with(['club', 'weapon'])
            ->when($request->team_name, fn($q) => $q->where('name', 'like', "%{$request->team_name}%"))
            ->when($request->weapon_id, fn($q) => $q->where('weapon_id', $request->weapon_id))
            ->when(
                $request->date_from,
                fn($q) => $q->whereDate('created_at', '>=', $request->date_from)
            )
            ->when(
                $request->date_to,
                fn($q) => $q->whereDate('created_at', '<=', $request->date_to)
            )
            ->orderBy('tid');
    }


    public function search(Request $request, $pag)
    {
        return $pag ? $this->searchQuery($request)
            ->cursorPaginate(config('app.admin_pagination_number'))
            ->appends($request->query()) : $this->searchQuery($request)->get();
    }

    //المسجلين فرق
    public function membersByGroupSearch(Request $request, $pag)
    {
        $query = Sv_member::query()
            ->where('sv_members.reg_type', 'group')
            ->join('sv_teams as t', 'sv_members.team_id', '=', 't.tid')
            ->when(
                $request->weapon_id,
                fn($q) =>
                $q->where('sv_members.weapon_id', $request->weapon_id)
            )
            ->when(
                $request->team_name,
                fn($q) =>
                $q->where('t.name', 'LIKE', "%{$request->team_name}%")
            )
            ->select('sv_members.*', 't.name as team_name')
            ->orderBy('sv_members.mid');
        return $pag ? $query->cursorPaginate(config('app.admin_pagination_number')) : $query->get();
    }



    public function deleteGroup($tid)
    {
        $group = $this->getGroupById($tid);
        return $group->delete();
    }
    public function viewGroupMembers($tid)
    {
        $group = $this->getGroupById($tid);

        if ($group) {
            return Sv_member::where('reg_type', 'group')->where('team_id', $tid)->get();
        }
        return false;
    }
    public function updateGroupData($data, $tid)
    {
        $group = $this->getGroupById($tid);
        if ($group) {
            return $group->update($data);
        }
        return false;
    }


    //update member group data
    public function updateMemberData($data, $mid, Request $request)
    {

        $member = $this->personalService->getMemberByID($mid);
        if ($request->hasFile('front_id_pic')) {
            if ($member->front_id_pic && Storage::disk('public')->exists($member->front_id_pic)) {
                Storage::disk('public')->delete($member->front_id_pic);
            }

            $data['front_id_pic'] = $request->file('front_id_pic')->store('national_ids', 'public');
        }

        if ($request->hasFile('back_id_pic')) {
            if ($member->back_id_pic && Storage::disk('public')->exists($member->back_id_pic)) {
                Storage::disk('public')->delete($member->back_id_pic);
            }

            $data['back_id_pic'] = $request->file('back_id_pic')->store('national_ids', 'public');
        }
        $member->update($data);
        return $member;
    }

    //groups registration
    // public function createNewGroup($data)
    // {
    //     return DB::transaction(function () use ($data) {

    //         $team = Sv_team::create([
    //             'name' => $data['team_name'],
    //             'club_id' => $data['club_id'] ?? null,
    //             'weapon_id' => $data['weapon_id'],
    //         ]);

    //         foreach ($data['members'] as $member) {

    //             $path_front = null;
    //             $path_back = null;
    //             //dd($member);
    //             // Handle front ID pic
    //             if (isset($member['front_id_pic']) && $member['front_id_pic'] instanceof \Illuminate\Http\UploadedFile) {
    //                 $file = $member['front_id_pic'];
    //                 $newfile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    //                 $file->move(public_path() . '/storage/national_ids/', $newfile);
    //                 $path_front = 'national_ids/' . $newfile;
    //             }

    //             // Handle back ID pic
    //             if (isset($member['back_id_pic']) && $member['back_id_pic'] instanceof \Illuminate\Http\UploadedFile) {
    //                 $file = $member['back_id_pic'];
    //                 $newfile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    //                 $file->move(public_path() . '/storage/national_ids/', $newfile);
    //                 $path_back = 'national_ids/' . $newfile;
    //             }

    //             // Create member record
    //             $team->teamMembers()->create([
    //                 'reg_type' => 'group',
    //                 'team_id' => $team->tid,
    //                 'weapon_id' => $data['weapon_id'],
    //                 'name' => $member['name'],
    //                 'ID' => $member['ID'],
    //                 'Id_expire_date' => $member['Id_expire_date'],
    //                 'dob' => $member['dob'],
    //                 'phone1' => $member['phone1'],
    //                 'front_id_pic' => $path_front,
    //                 'back_id_pic' => $path_back,
    //             ]);
    //         }

    //         return $team;
    //     });
    // }

    /**old for session worked */
    /** working for local session paths  */
    // public function createNewGroup(GroupRegistrationRequest $request)
    // {
    //     $data = $request->validated();
    //     $tempFiles = session('temp_files', []); // get stored temp images from session

    //     return DB::transaction(function () use ($data, $tempFiles) {
    //         $team = Sv_team::create([
    //             'name'      => $data['team_name'],
    //             'club_id'   => $data['club_id'] ?? null,
    //             'weapon_id' => $data['weapon_id'],
    //         ]);

    //         foreach ($data['members'] as $index => $member) {
    //             // Retrieve paths from session if they exist
    //             $frontKey = "members[{$index}][front_id_pic]";
    //             $backKey  = "members[{$index}][back_id_pic]";

    //             $frontSessionPath = $tempFiles[$frontKey] ?? null;
    //             $backSessionPath  = $tempFiles[$backKey] ?? null;
    //             //dd($frontSessionPath);
    //             // Decide which path to use (session or request)

    //             $frontPath = $this->handleFileInput($member['front_id_pic'] ?? $frontSessionPath, 'front');
    //             $backPath  = $this->handleFileInput($member['back_id_pic'] ?? $backSessionPath, 'back');
    //             //dd($frontPath);
    //             $team->teamMembers()->create([
    //                 'reg_type'         => 'group',
    //                 'team_id'          => $team->tid,
    //                 'weapon_id'        => $data['weapon_id'],
    //                 'name'             => $member['name'],
    //                 'ID'               => $member['ID'],
    //                 'Id_expire_date'   => $member['Id_expire_date'],
    //                 'dob'              => $member['dob'],
    //                 'phone1'           => $member['phone1'],
    //                 'front_id_pic'     => $frontPath,
    //                 'back_id_pic'      => $backPath,
    //                 'registration_date' => now()->toDateString(),
    //             ]);
    //         }

    //         //  clear the session after successful insert
    //         session()->forget('temp_files');
    //         return $team;
    //     });
    // }

    /**
     * Move file from temporary session folder to final location.
     */
    // protected function moveTempFile(string $urlPath): ?string
    // {
    //     // Handle both URL or relative path
    //     if (str_contains($urlPath, '/storage/')) {
    //         $relativePath = str_replace(url('/storage/'), '', $urlPath);
    //     } else {
    //         $relativePath = ltrim($urlPath, '/'); // e.g., "temp/abc.jpg"
    //     }

    //     if (Storage::disk('public')->exists($relativePath)) {
    //         $newPath = str_replace('temp/', 'national_ids/', $relativePath);
    //         Storage::disk('public')->move($relativePath, $newPath);
    //         return $newPath;
    //     }

    //     return null;
    // }

    // protected function handleFileInput($fileInput, string $prefix = 'file'): ?string
    // {
    //     // 1️⃣ If it's an UploadedFile, store it normally
    //     if ($fileInput instanceof \Illuminate\Http\UploadedFile) {
    //         return $fileInput->store("national_ids", "public");
    //     }

    //     // 2️⃣ If it's a temp file path (either full URL or relative path)
    //     if (
    //         is_string($fileInput) &&
    //         (str_contains($fileInput, '/storage/temp/') || str_starts_with($fileInput, 'temp/'))
    //     ) {
    //         return $this->moveTempFile($fileInput);
    //     }

    //     // 3️⃣ If it's already stored path
    //     if (is_string($fileInput) && str_contains($fileInput, 'national_ids/')) {
    //         return $fileInput;
    //     }

    //     return null;
    // }
    //new for session
    public function createNewGroup($data)
    {
        $tempFiles = session('temp_files', []); // paths like 'temp/xxxx.jpg'

        return DB::transaction(function () use ($data, $tempFiles) {
            $team = Sv_team::create([
                'name'      => $data['team_name'],
                'club_id'   => $data['club_id'] ?? null,
                'weapon_id' => $data['weapon_id'],
            ]);

            foreach ($data['members'] as $index => $member) {
                // Field names in session
                $frontKey = "members[{$index}][front_id_pic]";
                $backKey  = "members[{$index}][back_id_pic]";

                // Get file paths from session (not from request)
                $frontPath = $tempFiles[$frontKey] ?? null;
                $backPath  = $tempFiles[$backKey] ?? null;

                // Move files from /temp → /national_ids
                $path_front = $frontPath ? $this->moveTempFile($frontPath) : null;
                $path_back  = $backPath ? $this->moveTempFile($backPath) : null;

                // Save member with final file paths
                $team->teamMembers()->create([
                    'reg_type'          => 'group',
                    'team_id'           => $team->tid,
                    'weapon_id'         => $data['weapon_id'],
                    'name'              => $member['name'],
                    'ID'                => $member['ID'],
                    'Id_expire_date'    => $member['Id_expire_date'],
                    'dob'               => $member['dob'],
                    'phone1'            => $member['phone1'],
                    'front_id_pic'      => $path_front,
                    'back_id_pic'       => $path_back,
                    'registration_date' => now()->toDateString(),
                ]);
            }

            // Clear session after success
            session()->forget('temp_files');

            return $team;
        });
    }

    protected function moveTempFile(string $relativePath): ?string
    {
        // Normalize (remove any leading slashes)
        $relativePath = ltrim($relativePath, '/');

        $sourcePath = public_path('storage/' . $relativePath);
        $filename = uniqid() . '_' . basename($sourcePath);
        $destinationPath = public_path('storage/national_ids/' . $filename);

        // Ensure national_ids folder exists
        if (!file_exists(dirname($destinationPath))) {
            mkdir(dirname($destinationPath), 0755, true);
        }

        // Move the file
        if (file_exists($sourcePath)) {
            rename($sourcePath, $destinationPath);
            return 'national_ids/' . $filename;
        }

        return null;
    }
}