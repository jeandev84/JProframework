<?php
namespace Jan\Component\Templating;


use Jan\Component\Templating\Contracts\TemplateInterface;
use Jan\Component\Templating\Exceptions\ViewException;



/**
 * Class View
 * @package Jan\Component\Templating
*/
class View implements TemplateInterface
{


      /** @var string */
      protected $basePath;


      /** @var array */
      protected $data = [];



      /**
       * View constructor.
       * @param string $basePath
      */
      public function __construct(string $basePath)
      {
           $this->setBasePath($basePath);
      }


      /**
       * @param string $basePath
       * @return $this
      */
      public function setBasePath(string $basePath)
      {
          $this->basePath = rtrim($basePath, '/');

          return $this;
      }


      /**
        * @param $name
        * @param $value
      */
      public function setVariable($name, $value)
      {
          $this->data[$name] = $value;
      }


      /**
       * Set data
       *
       * @param array $data
       * @return View
      */
      public function setVariables(array $data)
      {
           $this->data = array_merge($this->data, $data);

           return $this;
      }


      /**
       * Render view template and optional data
       * @param string $template
       * @return false|string
       * @throws ViewException
      */
      public function renderHtml($template)
      {
           extract($this->data);
           ob_start();
           require $this->resource($template);
           return ob_get_clean();
      }


      /**
       * Factory render method
       *
       * @param string $template
       * @param array $data
       * @return false|string
       * @throws ViewException
      */
      public function render(string $template, array $data = [])
      {
           $this->setVariables($data);
           return $this->renderHtml($template);
      }


      /**
       * Get view file resource
       * @param string $path
       * @return string
       * @throws ViewException
      */
      public function resource(string $path)
      {
          $template = $this->templateFile($path);

          if(! file_exists($template))
          {
              throw new ViewException(
                  sprintf('Template file <b>(%s)</b> does not exist!', $template)
              );
          }

          return $template;
      }


      /**
       * @param string $path
       * @return string
      */
      public function templateFile(string $path = '')
      {
          return $this->basePath . ($path ? DIRECTORY_SEPARATOR . ltrim($path, '\/') : $path);
      }
}