<?php namespace App\Http\Controllers;

use App\Domain\Core\NotAuthorizedException;
use App\Domain\Core\NotFoundException;
use App\Domain\Core\ValidationException;
use App\Domain\Files\Jobs\DisplayHome;
use App\Domain\Files\Jobs\DownloadFile;
use App\Domain\Files\Jobs\GetUserFiles;
use App\Domain\Files\Jobs\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FileController extends APIController {

    public function index(Request $request)
    {
        try
        {
            $data = $this->dispatch(
                new DisplayHome(
                    $request->route('username')
                )
            );
        }
        catch (NotAuthorizedException $e)
        {
            // user is not logged in yet or usernames do not match
            return redirect()->route('auth');
        }
        catch (\Exception $e)
        {
            return redirect()->route('auth');
        }

        // return CSRF token to be used with AJAX requests
        return view('home', $data)
            ->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));
    }

    /**
     * Get all of a user's uploaded files.
     *
     * @param Request $request
     * @return array|mixed
     */
    public function getFiles(Request $request)
    {
        try
        {
            $data = $this->dispatch(
                new GetUserFiles(
                    $request->route('username')
                )
            );
        }
        catch (ValidationException $e)
        {
            return $this->respondUnprocessable($e->getMessage());
        }
        catch (NotFoundException $e)
        {
            return $this->respondNotFound($e->getMessage());
        }
        catch (\Exception $e)
        {
            return $this->respondServerError($e->getMessage());
        }

        return $this->respondOK($data);
    }

    /**
     * Upload a file.
     *
     * @param Request $request
     * @return array|mixed
     */
    public function store(Request $request)
    {
        try
        {
            $data = $this->dispatch(
                new UploadFile(
                    $request->route('username'),
                    $request->file('file'),
                    $request->file('file')->getClientMimeType(),
                    $request->file('file')->getClientOriginalExtension(),
                    $request->file('file')->getClientOriginalName()
                )
            );
        }
        catch (ValidationException $e)
        {
            return back()->with('message', $e->getMessage());
        }
        catch (NotFoundException $e)
        {
            return back()->with('message', $e->getMessage());
        }
        catch (\Exception $e)
        {
            return back()->with('message', $e->getMessage());
        }

        return redirect()->route('home', $data)->with('success', 'Your file has been uploaded!');
    }

    /**
     * Initiate a download for the specified file.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function download(Request $request)
    {
        try
        {
            $data = $this->dispatch(
                new DownloadFile(
                    $request->route('username'),
                    $request->route('filename')
                )
            );
        }
        catch (NotAuthorizedException $e)
        {
            return back()->with('message', $e->getMessage());
        }
        catch (NotFoundException $e)
        {
            return back()->with('message', $e->getMessage());
        }
        catch (\Exception $e)
        {
            return back()->with('message', $e->getMessage());
        }

        return response()->make($data['file'], 200)->header('Content-Type', $data['mime']);
    }

}
