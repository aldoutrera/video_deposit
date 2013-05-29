<?php

class Footprint
{
    /**
     * Generate a link to a JavaScript file.
     *
     * <code>
     *      // Generate a link to a JavaScript file
     *      echo HTML::script('js/jquery.js');
     *
     *      // Generate a link to a JavaScript file and add some attributes
     *      echo HTML::script('js/jquery.js', array('defer'));
     * </code>
     *
     * @param  string  $url
     * @param  array   $attributes
     * @return string
     */
    public static function script($path, $attributes = array())
    {
        $url = URL::to_asset($path);
        $public = rtrim(path('public'),"/");
        $path = $public . $path;

        return '<script src="'.$url.'?'.@filemtime($path).'"'.HTML::attributes($attributes).'></script>'.PHP_EOL;
    }

    /**
     *  Given a file, i.e. /css/base.css, replaces it with a string containing the
     *  file's mtime, i.e. /css/base.1221534296.css.
     *
     *  @param $file  The file to be loaded.  Must be an absolute path (i.e.
     *                starting with slash).
     */
    public static function cache_burst($file)
    {
      if(strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
        return $file;

      $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
      return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
    }
}
