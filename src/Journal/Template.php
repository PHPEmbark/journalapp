<?php
namespace Journal;

class Template {
    protected $tplPath;
    protected $baseTemplate;
    protected $page;

    public function __construct($tpl_path, $base_tpl)
    {
        $this->tplPath = $tpl_path;
        $this->baseTemplate = $base_tpl;
    }

    public function render($page, $data = array(), $base_tpl = null)
    {
        if(is_null($base_tpl)) {
            $base_tpl = $this->baseTemplate;
        }

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        $this->page = $page;

        require $this->tplPath . '/' . $base_tpl;
    }

    public function content()
    {
        require $this->tplPath . '/' . $this->page;
    }
    
    public function escapeHtml($data)
    {
        return htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
    }

    public function wrapText($data)
    {
        return nl2br(htmlspecialchars($data, ENT_COMPAT, 'UTF-8'));
    }
}