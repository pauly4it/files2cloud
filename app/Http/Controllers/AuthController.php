<?php namespace App\Http\Controllers;

use App\Domain\Core\NotAuthorizedException;
use App\Domain\Core\ValidationException;
use App\Domain\Profiles\Jobs\RegisterUser;
use App\Domain\Profiles\Jobs\LogIn;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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
}
