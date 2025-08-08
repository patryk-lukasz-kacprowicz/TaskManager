<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends Controller
{
    /** @var UserService  */
    protected UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response {
        $users = User::query()->latest()->get();

        return Inertia::render('UsersIndex', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response {
        return Inertia::render('UsersCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     *
     * @return RedirectResponse
     *
     * @throws UnknownProperties
     */
    public function store(StoreUserRequest $request): RedirectResponse {
        $result = $this->userService->store($request->getDto());

        if($result) {
            return redirect()->route('users.index')->with('success', 'User created successfully');
        }

        return redirect()->route('users.index')->with('error', 'Something went wrong');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return Response
     */
    public function edit(User $user): Response {
        return Inertia::render('UsersEdit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     *
     * @return RedirectResponse
     *
     * @throws UnknownProperties
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse {
        $result = $this->userService->update($request->toDTO(), $user);

        if($result) {
            return back()->with('success', 'User updated successfully');
        }

        return back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse {
        $result = $this->userService->destroy($user);

        if($result) {
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        }

        return back()->with('error', 'Something went wrong');
    }
}
