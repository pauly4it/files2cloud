## Files2Cloud

This is my ongoing project to build a Dropbox-like web-app.

## How to Run It Yourself

This package is best run on Vagrant, using Vaprobash (or Homestead).

- Get [Vaprobash](https://github.com/fideloper/Vaprobash) and follow the instructions to set up
- Edit the VagrantFile:
    - change vb.name to a name of your choosing (e.g. Files2Cloud)
    - uncomment apache base
    - uncomment mysql
    - uncomment composer
    - uncomment laravel
- Run `vagrant up` from the directory in which the vagrant file is located. This will start a vm and will create a `laravel` directory with the latest Laravel build.
- Download this git repo as a zip file (or clone the repo into the `laravel` folder and skip the next two steps)
- Delete the contents of the `laravel` folder for Vaprobash
- Replace the contents of the `laravel` folder with this git repo
- Run `vagrant halt` and then `vagrant up`
- Navigate to 192.168.22.10.xip.io in your browser, and you should see the Log In/Register page for the app. There are no existing users.
