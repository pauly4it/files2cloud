<?php namespace App\Http\Controllers;

use App\Domain\Core\NotAuthorizedException;
use App\Domain\Core\ValidationException;
use App\Domain\Profiles\Jobs\DisplayLogIn;
use App\Domain\Profiles\Jobs\LogOut;
use App\Domain\Profiles\Jobs\RegisterUser;
use App\Domain\Profiles\Jobs\LogIn;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /**
     * Display the register/log in view
     *
     * @return array|mixed
     */
    public function index()
    {
        try
        {
            $data = $this->dispatch(
                new DisplayLogIn()
            );
        }
        catch (NotAuthorizedException $e)
        {
            // user is not logged in yet
            return view('login');
        }
        catch (\Exception $e)
        {
            return view('login');
        }

        // direct to home
        return redirect()->route('home', $data);
    }

    /**
     * Register a new user
     *
     * @param Request $request
     * @return array|mixed
     */
    public function create(Request $request)
    {
        try
        {
            $data = $this->dispatch(
                new RegisterUser(
                    $request->only('username-register', 'password-register')
                )
            );
        }
        catch (ValidationException $e)
        {
            return back()->with('errors', $e->getErrors()->all());
        }
        catch (\Exception $e)
        {
            return back()->with('message', $e->getMessage());
        }

        return redirect()->route('home', $data);
    }

    /**
     * Log a user in
     *
     * @param Request $request
     * @return array|mixed
     */
    public function login(Request $request)
    {
        try
        {
            $data = $this->dispatch(
                new LogIn(
                    $request->only('username-login', 'password-login')
                )
            );
        }
        catch (ValidationException $e)
        {
            return back()->with('errors', $e->getErrors()->all());
        }
        catch (NotAuthorizedException $e)
        {
            return back()->with('errors', [$e->getMessage()]);
        }
        catch (\Exception $e)
        {
            return back()->with('message', $e->getMessage());
        }

        return redirect()->route('home', $data);
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        try
        {
            $this->dispatch(
                new LogOut()
            );
        }
        catch (\Exception $e)
        {
            return redirect()->route('auth');
        }

        // user is not logged in yet
        return redirect()->route('auth');
    }
}
