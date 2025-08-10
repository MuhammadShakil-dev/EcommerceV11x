

INSTALLATION:


1: Install the package through Composer.

  composer require "darryldecode/cart:~4.0" or composer require "darryldecode/cart"

2: check composer.json
  
   "darryldecode/cart": "^4.2", ..........    avilibale or not


3: Open config/app.php and add this line to your Service Providers Array.

     Darryldecode\Cart\CartServiceProvider::class

4:
5:
6:
7:
8:
9:





Open config/app.php and add this line to your Aliases
  'Cart' => Darryldecode\Cart\Facades\CartFacade::class
Optional configuration file (useful if you plan to have full control)
php artisan vendor:publish --provider="Darryldecode\Cart\CartServiceProvider" --tag="config"
