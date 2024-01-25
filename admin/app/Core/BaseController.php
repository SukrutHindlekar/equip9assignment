<?php

namespace App\Core;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
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
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------

    }

    public function __construct()
    {

        $config         = new \Config\Encryption();
        $config->key    = 'TheBigSecretKeyOfHiddenDataIn2021ForMyProdxn';
        $config->driver = 'OpenSSL';
        $this->encrypter = \Config\Services::encrypter($config);
        $this->curl = \Config\Services::curlrequest();

        date_default_timezone_set('Asia/Kolkata');
        $this->utc_time = date('Y-m-d H:i:s');
        $this->utc_date = date('Y-m-d');
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function encrypt_password($message)
    {
        return password_hash($message, PASSWORD_BCRYPT, array('cost' => 12));
    }

    public function verify_password($input, $password)
    {
        return password_verify($input, $password);
    }

    public function image_upload($image, $path)
    {
        $type = explode("/", $image->getMimeType());

        if ($type[1] == "jpeg" || $type[1] == "png" || $type[1] == "jpg") {

            $newfilename = round(microtime(true)) . '.' . $type[1];

            if ($image->move(IMAGE_UPLOAD_PATH . $path, $newfilename)) {
                return $newfilename;
            } else {
                return -1;
            }
        } else {
            return -2;
        }
    }

    public function video_upload($video, $path)
    {

        $type = explode("/", $video->getMimeType());

        if ($type[1] == "mp4" || $type[1] == "mov" || $type[1] == "mkv") {

            $newfilename = round(microtime(true)) . '.' . $type[1];

            if ($video->move(VIDEO_UPLOAD_PATH . $path, $newfilename)) {
                return $newfilename;
            } else {
                return -1;
            }
        } else {
            return -2;
        }
    }

    public function fetch_image($image, $path)
    {
        return DOMAIN_URL . $path . '/' . $image;
    }
}
