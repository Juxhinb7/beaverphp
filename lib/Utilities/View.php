<?php

namespace Beaver\Utilities;
use Smarty\Smarty;

final class View extends Smarty
{
    protected function __construct(
        protected string $view,
        protected array $params = [],
    ) {
        parent::__construct();
        $this->setTemplateDir(SMARTY_CONFIG['views'] . '/');
        $this->setCompileDir(SMARTY_CONFIG['compile'] . '/');
        $this->setConfigDir(SMARTY_CONFIG['configs'] . '/');
        $this->setCacheDir(SMARTY_CONFIG['cache'] . '/');
        $this->setEscapeHtml(true);

        

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
    }

    public static function make(string $view, array $params = []): View 
    {
        return new View($view, $params);
    }

    public function render()
    {
        foreach ($this->params as $key => $someVal) {
            $this->assign($key, $someVal);
        }
        
        $this->display($this->view . '.tpl');
    }
}