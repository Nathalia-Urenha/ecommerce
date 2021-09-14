<?php 
 
namespace Hcode;
 
use Rain\Tpl;
 
class Page {
 
    private $tpl;
    private $options = [];
    private $defaults = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];
 
    public function __construct($opts = array(), $tpl_dir = "views/")
    {   
        $this->options = array_merge($this->defaults, $opts);
 
        $config = array(
            "tpl_dir"   => $tpl_dir,
            "cache_dir" => "./views-cache/",
            "debug"     => true
        );
 
        Tpl::configure($config);
 
        $this->tpl = new Tpl;
 
        $this->setData($this->options["data"]);
 
        if ($this->options["header"] === true) $this->tpl->draw("header");
 
    }
 
    public function __destruct()
    {
 
        if ($this->options['footer'] === true) $this->tpl->draw("footer", false);
 
    }
 
    private function setData($data = array())
    {
 
        foreach($data as $key => $val)
        {
 
            $this->tpl->assign($key, $val);
 
        }
 
    }
 
    public function setTpl($tplname, $data = array(), $returnHTML = false)
    {
 
        $this->setData($data);
 
        return $this->tpl->draw($tplname, $returnHTML);
 
    }
 
}
 
?>