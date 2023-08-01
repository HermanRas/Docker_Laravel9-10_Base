## Setup base laravel latest:
docker-compose run --rm composer create-project laravel/laravel .
## Setup base laravel 9
docker-compose run --rm composer create-project laravel/laravel:^9.0 .

## remember to config .env 
- MY SQL DB
```.env file
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
- User Picture update (public access)
```.env file
CACHE_DRIVER=file
FILESYSTEM_DISK=pubic
```

- User Document upload (private)
```.env file
CACHE_DRIVER=file
FILESYSTEM_DISK=local
```

## WHEN MOVING OR RESTARTING A PROJECT (if needed don't run all)
docker-compose run --rm composer update
docker-compose run --rm npm install
docker-compose run --rm npm run dev
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan migrate

## Setup bootstrap for UI
docker-compose run --rm npm install
docker-compose run --rm composer require laravel/ui --dev
docker-compose run --rm artisan ui bootstrap
docker-compose run --rm npm install
docker-compose run --rm npm run dev

## Building Controller
docker-compose run --rm artisan make:controller Auth\\RegisterController
docker-compose run --rm artisan make:controller DashboardController
docker-compose run --rm artisan make:controller Auth\\LoginController

## Building model
docker-compose run --rm artisan make:model Listing

## Building Migrations
docker-compose run --rm artisan make:migration create_listings_table
docker-compose run --rm artisan migrate
docker-compose run --rm artisan db:seed
docker-compose run --rm artisan migrate:refresh
docker-compose run --rm artisan migrate:refresh --seed

## Building Factories
docker-compose run --rm artisan make:factory Listing

## Switching frameworks from providers like (tailwind) default ui
docker-compose run --rm artisan vendor:publish
 - NotificationServiceProvider (flashMessage / SweetAlert / MessagePopper)
 - MailServiceProvider  (phpMailer / AzureSend / AWS-Deliver)
 - PaginationServiceProvider (Bootstrap / Tailwind / Semantic-ui)

## Storage
docker-compose run --rm artisan storage:link
 - Remember it will use Default or ENV if configured:
    - (FILESYSTEM_DISK=local)
    - (FILESYSTEM_DISK=public)

## Access DB
docker exec -it mysql mysql -u homestead -psecret homestead


## turn project into PWA
docker-compose run --rm composer require ladumor/laravel-pwa
docker-compose run --rm artisan laravel-pwa:publish
- in the root blade file / index.blade.php / app.blade.php add the PWA header
    ``` HTML
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    ```
 - Add following code in root blade file / index.blade.php / app.blade.php before close the body, 
    ``` HTML
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    ```

















## Custom Request for user & email auth login
 - add Route 
 ``` PHP
 //form fields [username,password] where [username] can contain email or password
 Route::post('/login', [LoginController::class, 'login']);
 ```
 - app\Http\Controllers\LoginController.php
``` PHP
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) :
            return back()->withErrors(['username' => 'Invalid user or password'])->onlyInput('username');
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended()->with('message', 'Welcome back ' . $user['username'] . ' !');;
    }
}
```

 - app\Http\Requests\LoginRequest.php
``` PHP
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCredentials()
    {
        // The form field for providing username or password
        // have name of "username", however, in order to support
        // logging users in with both (username and email)
        // we have to check if user has entered one or another
        $username = $this->get('username');

        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }

        return $this->only('username', 'password');
    }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();
    }
}
```