<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Smartie Class
 *
 * @package        CodeIgniter
 * @subpackage     Libraries
 * @category       Smarty
 * @author         Kepler Gelotte
 * @link           http://www.coolphptools.com/codeigniter-smarty
 */

class Smartie extends Smarty {

    var $debug = false;

    function __construct()
    {
        parent::__construct();

        $this->template_dir = APPPATH . "views";
        $this->compile_dir = APPPATH . "views_c";
        if ( ! is_writable( $this->compile_dir ) )
        {
            @chmod( $this->compile_dir, 0777 );
        } 


        $this->assign( 'FCPATH', FCPATH );     // path to website
        $this->assign( 'APPPATH', APPPATH );   // path to application directory
        $this->assign( 'BASEPATH', BASEPATH ); // path to system directory
        $this->assign("base_url" , base_url());  
        $this->assign('version', file_get_contents('version.txt'));

        log_message('debug', "Smarty Class Initialized");
    }

    function setDebug( $debug=true )
    {
        $this->debug = $debug;
    }

}
// END Smartie Class
