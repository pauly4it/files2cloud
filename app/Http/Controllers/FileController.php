<?php namespace App\Http\Controllers;

use App\Domain\Core\NotFoundException;
use App\Domain\Core\ValidationException;
use App\Domain\Files\Jobs\GetUserFiles;
use App\Domain\Files\Jobs\UploadFile;
use Illuminate\Http\Request;

class FileController extends APIController {

    /**
     * Get all of a user's uploaded files.
     *
     * @param Request $request
     * @return array|mixed
     */
    public function index(Request $request)
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
            return back()->with('errors', $e->getErrors()->all());
        }
        catch (NotFoundException $e)
        {
            return back()->with('errors', $e->getErrors());
        }
        catch (\Exception $e)
        {
            return back()->with('message', $e->getMessage());
        }

        return redirect()->route('home', $data)->with('success', 'Your file has been uploaded!');
    }

}