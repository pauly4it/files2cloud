<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Files2Cloud</title>
    <meta name="csrf_token" value="{{ Session::token() }}" />
    <link href="/css/main.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Raleway:500,600,700|Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="header">
        <div id="header-content">
            <div id="company">
                <img src="/images/logo.png" height="40px" />
            </div>
            <div id="logout">
                <a href="{{ route('auth.logout') }}">Log Out</a>
            </div>
        </div>
    </div>

    <div class="center">
        <div id="welcome"><h1>Welcome {{ $username }}!</h1></div>
        @if (session('message') !== null)
            <div class="alert-danger">
                <strong>Whoops!</strong> Something went wrong:<br>
                {{ session('message') }}
            </div>
        @elseif (session('success') !== null)
            <div class="alert-success">
                <strong>Your file has been uploaded!</strong><br>
            </div>
        @endif
        <div>
            <form id="formUpload" action="files" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
                <input type="file" id="fileUpload" name="file" />
                <input type="submit" disabled="true" value="Upload File" name="submit" />
            </form>
        </div>
        <div id="app"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.13.1/react.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.13.1/JSXTransformer.js"></script>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script>
        window.config = { username: "{{ $username }}" };
        // when a file is selected
        $('#fileUpload').bind('change', function() {
            // check the file size
            if (this.files[0].size > 50000)
            {
                // if it's greater than the 50KB limit, then reset form, disabled upload button, and alert user
                $('#formUpload').trigger("reset");
                $('input[type="submit"]').attr('disabled','disabled');
                alert('Your file is too big! Maximum file size is 50KB.');
            }
            else
            {
                // file is valid size, enable upload button
                $('input[type="submit"]').removeAttr('disabled');
            }
        });
    </script>
    <script type="text/jsx;harmony=true" src="/js/FileList.js"></script>
    <script type="text/jsx;harmony=true" src="/js/FileSearchBar.js"></script>
    <script type="text/jsx;harmony=true" src="/js/FileUploadApp.js"></script>
</body>
</html>
