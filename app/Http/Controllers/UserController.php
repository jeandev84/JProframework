<?php
namespace App\Http\Controllers;


use App\Entity\User;
use App\Http\Contracts\Controller;
use Jan\Component\Database\Database;


/**
 * Class UserController
 * @package App\Http\Controllers
*/
class UserController extends Controller
{


        /**
         * @return \Jan\Component\Http\Response
        */
        public function index()
        {
            Database::connect([]);
            dump(Database::pdo()->query('SELECT * FROM users', [], User::class)->get());
            Database::disconnect();
            // dump(Database::getConnection());
            // dd(password_hash('yurev085', PASSWORD_BCRYPT));
            //dd(User::findAll()->get());

            /*
            $user = new User();
            $user->id = 2;
            $user->email = 'demo@site.com';
            $user->password = password_hash('yurev085', PASSWORD_BCRYPT);
            dd($user);
            */

            return $this->render('users/index');
        }


       /**
        * @param string $token
        * @return \Jan\Component\Http\Response
       */
       public function edit(string $token)
       {
           return $this->render('users/edit', compact('token'));
       }
}