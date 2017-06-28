<?php namespace Modules\Backend\Http\Controllers;

use App\Http\Controllers\CommonController;

abstract class AdminController extends CommonController
{

    protected $this_app = 'admin', $theme_name = 'be_theme';
    protected $module, $asset_theme, $lang;

    protected function __construct()
    {
        parent::__construct();
        view()->share('asset_theme', $this->asset_theme = $this->asset_theme());
        view()->share('theme_app', $this->get_theme());

        //view()->share('master_page', $this->get_theme() . '.master');
        //view()->share('lang', $this->lang = $this->tm_ini->get_be_ini());
        //view()->share('title_heading', (isset($this->lang['title_heading']) ? $this->lang['title_heading'] . ' - ' : '') . 'CMS Webshop');
    }

    public function asset_theme()
    {
        return $this->asset_path . $this->this_app . '/' . $this->get_theme() . '/';
    }

    public function get_theme()
    {
        return $this->get_main_theme($this->theme_name);
    }

    public function set_theme($theme_value)
    {
        $this->set_main_theme($this->theme_name, $theme_value);
    }

    public function set_lang($lang_file = null, $language = null)
    {
        $lang_file = $lang_file ? $lang_file : $this->module;
        $language = $language ? $language : $this->get_current_lang_code();
        $this->lang = [];
        $this->lang = $this->tm_ini->get_be_ini('global', $language); //, $language['lang_code']
        $lang_file = $this->tm_ini->get_be_ini($lang_file, $language);
        if($lang_file)
            $this->lang += $lang_file;
        return $this->lang;
    }

    public function lang_key($lang_key = null, $out_str = 'This value does not exist!')
    {
        return $lang_key && isset($this->lang[$lang_key]) ? $this->lang[$lang_key] : $out_str;
    }

    public function set_module($module)
    {
        $this->module = $module;
    }

    public function route_index()
    {
        return $this->module . '.index';
    }

    public function route_create()
    {
        return $this->module . '.create';
    }

    public function route_store()
    {
        return $this->module . '.store';
    }

    public function route_show()
    {
        return $this->module . '.show';
    }

    public function route_edit()
    {
        return $this->module . '.edit';
    }

    public function route_update()
    {
        return $this->module . '.update';
    }

    public function route_delete()
    {
        return $this->module . '.delete';
    }

    public function view_index()
    {
        return $this->this_app . '.' . $this->get_theme() . '.' . $this->module . '.index';
    }

    public function view_create()
    {
        return $this->this_app . '.' . $this->get_theme() . '.' . $this->module . '.create';
    }

    public function view_show()
    {
        return $this->this_app . '.' . $this->get_theme() . '.' . $this->module . '.show';
    }

    public function view_edit()
    {
        return $this->this_app . '.' . $this->get_theme() . '.' . $this->module . '.edit';
    }

    public function validate_msg($field, $rule, $val1 = null, $val2 = null)
    {
        switch ($rule) {
            case 'between':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_between'], $val1, $val2)];
            case 'mimes':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_file_mimes'], $val1, $val2)];
            case 'images.mimes':
                return ["$field.mimes" => sprintf($this->lang['msg_validate_image_mimes'], $val1, $val2)];
            case 'video.mimes':
                return ["$field.mimes" => sprintf($this->lang['msg_validate_video_mimes'], $val1, $val2)];
            case 'file.mimes':
                return ["$field.mimes" => sprintf($this->lang['msg_validate_file_mimes'], $val1, $val2)];
            case 'max':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_max2'], $val1, $val2)];
            case 'min':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_min2'], $val1, $val2)];
            case 'url':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_url'], $val1, $val2)];
            case 'integer':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_integer'], $val1, $val2)];
            case 'required':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_required'], $val1, $val2)];
            case 'numeric':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_numeric'], $val1, $val2)];
            case 'date':
                return ["$field.$rule" => sprintf($this->lang['msg_validate_date2'], $val1, $val2)];
        }
    }
}
