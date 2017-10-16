<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Vassetmanager for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Vassetmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Headers;

class IndexController extends AbstractActionController
{

    protected function retrieveAsset($assetType) {
        if (is_string($this->getServiceLocator()->get('Config')['asset_manager']['asset_types'][$assetType]))
            $assetExtensions = array($this->getServiceLocator()->get('Config')['asset_manager']['asset_types'][$assetType]);

        $response = $this->getResponse();
        $headers = new Headers();

        foreach($assetExtensions as $fileExt) {
            if (is_null($this->params('assetName'))) {
                if (is_null($this->params('controllerName')))
                    $assetName = $this->params('moduleName');
                else
                    $assetName = $this->params('controllerName');
            }
            else
                $assetName = $this->params('assetName');

            $filename = sprintf(
                $this->getServiceLocator()->get('Config')['view_manager']['template_path_stack'][$this->params('moduleName')] .
                '/assets/%s' .
//                 ($this->params('moduleName')        ? '/' . $this->params('moduleName')         : '') .
                ($this->params('controllerName')    ? '/' . $this->params('controllerName')     : '') .
//                 ($this->params('assetName')         ? '/' . $this->params('assetName')          : '/index') .
                '/' . $assetName . '%s'
                , $assetType, $fileExt);

//             echo 'moduleName: ' . $this->params('moduleName') . '<br>';
//             echo 'controllerName: ' . $this->params('controllerName') . '<br>';
//             echo 'actionName: ' . $this->params('actionName') . '<br>';
//             echo 'assetName: ' . $this->params('assetName') . '<br>';
//             echo 'filename:' . $filename . '<br>';
//             return array();

            if (file_exists($filename)) {
                $headers->addHeaderLine('Content-Type', 'text/javascript');
                $response->setContent(file_get_contents($filename));
                $response->setHeaders($headers);
                return $response;
            }
        }
        return $response->setStatusCode(404);
    }

    public function jsAction() {
        return $this->retrieveAsset('js');
    }

    public function cssAction() {
        return $this->retrieveAsset('css');
    }

    public function imgAction() {
        return $this->retrieveAsset('img');
    }
}
