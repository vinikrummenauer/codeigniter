<?php

namespace App\system\class;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * MainController - Todos os controllers deverão estender essa classe
 * @package mvc.system.class
 * @since 0.1
 */
abstract class MainController extends Controller
{

	/**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
	/**
	 * $view
	 * Objeto view - Exibe o conteúdo ao usuário
	 * @access public
	 *  */
	public $view;
	
	/**
	 * $title
	 * Título das páginas 
	 * @access public
	 */
	public $title;

	/**
	 * $user
	 * Usuario atual
	 * @access public
	 */
	public $user = null;


	/**
	 * $login_required
	 * Se a página precisa de login
	 * @access public
	 */
	public $login_required = false;

	/**
	 * $permission_required
	 * Permissão necessária
	 * @access public
	 */
	public $permission_required = 'any';

	
	public $parametros = array();
	
	/**
	 * Construtor da classe
	 * Configura as propriedades e métodos da classe.
	 * @since 0.1
	 * @access public
	 */
	public function __construct ( ) {
		
		// Verifica o login
		$this->checkUserLogin();
		//Instancia objeto view
		$this->view=new View();
		if($this->user)
			$this->view->setUser($this->user);

	} // __construct
	
	/**
	 * Load model
	 * Carrega os modelos presentes na pasta /models/.
	 * @since 0.1
	 * @access public
	 */
	public function load_model( $model_name = false ) {
		// Um arquivo deverá ser enviado
		if ( ! $model_name ) return;
		// Garante que o nome do modelo tenha letras minúsculas
		$model_name =  strtolower( $model_name );
		//Adiciona o sufixo 'Model'
		$model_name.="Model";
		//transforma a primeira letra da string para maiúsculo
		$model_name=ucfirst($model_name);
		// Inclui o arquivo
		$model = DIR_BASE . '/app/models/' . $model_name . '.php';
		// Verifica se o arquivo existe
		if ( file_exists( $model ) ) {
			
			// Inclui o arquivo
			require_once $model;
			// Remove os caminhos do arquivo (se tiver algum)
			$model_name = explode('/', $model_name);
			// Pega só o nome final do caminho
			$model_name = end( $model_name );
			
			//Verifica a existência da classe definida para o model
			if(class_exists($model_name)){
				return new $model_name();
			}
			return;
		} //if
	} // load_model


	/**
	 * get User
	 * Carrega as informações do usuário logado
	 * @since 0.1
	 * @access public
	 * @author Cândido Farias
	 */
	public function getUser(){
		if($this->user){
			return $this->user;
		}
	
	}// getUser

	/**
	 * check user login
	 * Verifica as permissões do usuário logado
	 * @since 0.1
	 * @access public
	 * @author Cândido Farias
	 */
	public function checkUserLogin(){
		if(isset($_SESSION['user'])){
			$this->user=$_SESSION['user'];
			
		}else{
			$this->user=null;
		}
	}

	/**
	 * get user  Define o usuário corrente
	 * @since 0.1
	 * @param array Array com informações do usúario
	 * @author Cândido Farias
	 */
	public function setUser($user){
		if($user){
			$_SESSION['user']=$user;
			$this->user=$user;
			if($this->view)
				$this->view->setUser($user);
		}
	}
	/**
	 * unset user  Encerra a sessão do usuário corrente
	 * @since 0.1
	 * @author Cândido Farias
	 */
	function unsetUser(){
		if($this->user){
			unset($_SESSION['user']);
		}
	}

} // class MainController
