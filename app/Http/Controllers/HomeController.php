<?php
namespace App\Http\Controllers;


use App\Http\Contracts\Controller;
use Jan\Component\Database\Database;
use Jan\Component\DI\Container;
use Jan\Component\Http\Contracts\RequestInterface;
use Jan\Component\Http\Request;
use Jan\Foundation\Services\Upload;


/**
 * Class HomeController
 * @package App\Http\Controllers
*/
class HomeController extends Controller
{

     /**
      * @return \Jan\Component\Http\Response
      * @throws \Jan\Component\DI\Exceptions\InstanceException
      * @throws \Jan\Component\DI\Exceptions\ResolverDependencyException
      * @throws \ReflectionException
      */
      public function index(Container $container)
      {
           return $this->render('blog/home/index');
      }


    /**
     * @param Request $request
     * @param Upload $upload
     * @return \Jan\Component\Http\Response
     * @throws \Jan\Component\DI\Exceptions\InstanceException
     * @throws \Jan\Component\DI\Exceptions\ResolverDependencyException
     * @throws \ReflectionException
     */
      public function contact(Request $request, Upload $upload)
      {
          echo $request->getMethod() . ' ' . $request->getPath();
          // dump($_POST, $_FILES);
          dump($uploadedFiles = $request->file('contact'));
          $upload->setUploadedFiles($uploadedFiles);
          dump($upload);

          dump(Database::instance());
          return $this->render('blog/home/contact');
      }

}