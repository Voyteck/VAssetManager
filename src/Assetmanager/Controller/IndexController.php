<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Assetmanager for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Assetmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function jsAction() {
        $filename = $this->getServiceLocator()->get('Config')['view_manager']['template_path_stack'][$this->params('moduleName')] .
            '/assets/js' .
            ($this->params('moduleName')        ? '/' . $this->params('moduleName')         : '') .
            ($this->params('controllerName')    ? '/' . $this->params('controllerName')     : '') .
            ($this->params('actionName')        ? '/' . $this->params('actionName')         : '') .
            ($this->params('assetName')         ? '/' . $this->params('assetName')          : '') .
            '.js';

        echo $filename;

        echo file_get_contents($filename);
    }

    public function cssAction() {
        return array('text' => 'css action from asset controller');
    }
}
