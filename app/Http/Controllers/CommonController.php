<?php namespace App\Http\Controllers;

use App\Libraries\TM_INI;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\ImageManagerStatic as Image;

abstract class CommonController extends BaseController
{
    protected $tm_ini;
    //protected $asset_be_url, $asset_fe_url;
    protected $asset_path;
    protected $theme_be, $theme_fe;
    protected $upload_path = 'uploads', $images_path = '', $thumbs_path = '', $file_upload = 10485760;//10MB
//    protected $image_resize_100 = [100, 100], $image_resize_300 = [300, 300], $image_resize_500 = [500, 500],
//        $image_resize_750 = [750, 750], $image_resize_1000 = [1000, 1000], $image_resize_1500 = [1500, 1500];
    protected $image_resize_100 = 100, $image_resize_300 = 300, $image_resize_500 = 500,
        $image_resize_750 = 750, $image_resize_1000 = 1000, $image_resize_1500 = 1500, $image_resize_2500 = 2500;
    protected $language_all = 'language_all', $language_current = 'language_current', $language_default = 'vi-VN';

    protected function __construct()
    {
        //parent::__construct();
        //Load TM_INI
        $this->tm_ini = new TM_INI();
        //Backend asset url
        //$this->asset_be_url = url()->asset('assets/admin') . '/';
        //Frontend asset url
        //$this->asset_fe_url = url()->asset('assets/site') . '/';

        //$asset_path
        $this->images_path = public_path($this->upload_path . '/images') . '/';
        view()->share('images_path', $this->current_domain() . "/$this->upload_path/images/");

        //
        $this->thumbs_path = public_path('thumbs/images') . '/';
        view()->share('thumbs_path', $this->current_domain() . "/thumbs/images/");

        //
        view()->share('asset_path', $this->asset_path = url()->asset('assets') . '/');

        //
        view()->share($this->language_all, $this->get_language_all());
        view()->share($this->language_current, $this->get_language_current());
    }

    public function current_domain()
    {
        return URL::to('/');
    }

    public function get_language_all()
    {
        if (!Session::has($this->language_all))
            $this->set_language_all();
        return Session::get($this->language_all);
    }

    public function set_language_all()
    {
        Session::put($this->language_all, \App\Models\Language::_get_all_fillable(['id', 'created_at', 'updated_at']));
    }

    public function get_language_current()
    {
        if (!Session::has($this->language_current))
            $this->set_language_current();
        return Session::get($this->language_current);
    }

    public function set_language_current($language = null)
    {
        $language = $language ? $language : $this->language_default;
        $language_current = \App\Models\Language::_find_by_fields(['lang_code' => $language]);
        Session::put($this->language_current, \App\Models\Language::_get_to_fillable($language_current)); //\App\Models\Language::_get_all()
    }


    public function set_middleware($guard = 'admin', $except = ['except' => 'logout'])
    {
        $this->middleware($guard, $except);
    }

    public function get_current_lang_code()
    {
        $lang_code = $this->get_language_current();
        return (empty($lang_code) && isset($lang_code['lang_code'])) ? $this->language_default : $lang_code['lang_code'];
    }

    public function current_url()
    {
        return URL::current();
    }

    public function current_route_name()
    {
        return self::current_route()->getName();
    }

    public function current_route()
    {
        return Route::getCurrentRoute();
    }

    public function current_controller()
    {
        self::current_route()->parameterNames()[0];
    }

    public function current_prefix()
    {
        return self::current_route()->getPrefix();
    }

    public function merge_data($data_main, $data_sub)
    {
        foreach ($data_main as $mk => $mv) {
            if (isset($data_sub[$mk])) $data_main[$mk] = $data_sub[$mk];
        }
        return $data_main;
    }

    public function add_assets($data)
    {
        $asset['css'] = [];
        $asset['js'] = [];
        $asset['favicon'] = '';
        foreach ($data as $k => $v) {
            $tmp = [];
            if (is_array($v))
                $tmp = self::add_asset($v[0], $v[1]);
            else
                $tmp = self::add_asset($v, null);
            array_push($asset[$tmp[0]], $tmp[1]);

//            if (preg_match('/css$/i', $k))
//                in_array($k, $css) ?: array_push($css, '<link href="' . $v . $k . '" rel="stylesheet">');
//            elseif (preg_match('/js$/i', $k))
//                in_array($k, $js) ?: array_push($js, '<script type="text/javascript" src="' . $v . $k . '"></script>');
//            else
//                $favicon = '<link rel="icon" href="' . $v . $k . '" type="image/x-icon"/>';
        }
        return $asset;//['css' => $css, 'js' => $js, 'favicon' => $favicon];
    }

    public function add_asset($data, $url = null)
    {
        $asset = [];
        $url = ($url) ? $url : base_path('resources/assets/');
        if (preg_match('/css$/i', $data))
            $asset['css'] = '<link href="' . $url . $data . '" rel="stylesheet">';
        elseif (preg_match('/js$/i', $data))
            $asset['js'] = '<script type="text/javascript" src="' . $url . $data . '"></script>';
        else
            $asset['favicon'] = '<link rel="icon" href="' . $url . $data . '" type="image/x-icon"/>';

        return $asset;
    }

    public function get_main_theme($theme_name = 'fe_theme')
    {
        if (isset($_COOKIE[$theme_name]))
            return $_COOKIE[$theme_name];
        else {
            $this->set_main_theme($theme_name);
            return 'default';
        }
    }

    public function set_main_theme($theme_name = 'fe_theme', $theme_value = null)
    {
        $theme_value = $theme_value ?: 'default';
        setcookie($theme_name, $theme_value, time() + 31536000);
    }

    public function set_size_file_upload($size)
    {
        $this->file_upload = $size;
    }

    public function upload_images_main($file_upload, $request, $path = null, $size = null, $random_name = true, $encode = 'jpg', $msg = ['Null', 'Error Size', 'Error invalid'])
    {
        $path = $path ? "$path/" : "/others/";
        self::make_directory($this->upload_path . '/images/' . $path);//Storage::makeDirectory($upload_path);
        $encode = ".$encode";
        $files = $request->$file_upload;
        $str_file = ',';
        $size = $size ?: [$this->image_resize_1000, null];
        if ($request->hasFile($file_upload)) {
            //if ($request->file($file_upload)->isValid()) {
            foreach ($files as $file) {
                if ($file->getClientSize() <= $this->get_size_file_upload()) {
                    //Image make
                    $image = Image::make($file);
                    //Set width Height
                    $width = $size[0] ? ($image->width() > $size[0] ? $size[0] : $image->width()) : null;
                    $height = $size[1] ? ($image->height() > $size[1] ? $size[1] : $image->height()) : null;
                    //Checking
                    if (!$width || !$height)
                        $image->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    else
                        $image->resize($width, $height);
                    //Image Name
                    if ($random_name) {
                        $path .= date('Y.m.d') . '_' . md5(date('Y-m-d H:i:s') . rand(9, 9999)) . $encode;
                        //Encode and
                        $image->encode($encode, 100);
                    } else {
                        //Not random name
                        $path .= $file->getClientOriginalName();
                        //$image->encode($encode, 100);
                    }
                    //Save images
                    $image->save($this->images_path . $path);
                    $str_file .= $path . ',';
                } else
                    continue;
                //return $msg[1];
            }
            return $str_file;
//            } else
//                return $error_invalid;
        } else {
            return null;
        }
    }

    public function make_directory($directory)
    {
        Storage::disk('public')->makeDirectory($directory);
    }

    public function get_size_file_upload()
    {
        return $this->file_upload;
    }

    public function storage_disk($disk = 'public')
    {
        return Storage::disk($disk);
    }

    public function flash_msg_error($message)
    {
        Session::flash('error_msg', $message);
    }

    public function flash_msg_success($message)
    {
        Session::flash('success_msg', $message);
    }

    public function flash_msg_warning($message)
    {
        Session::flash('warning_msg', $message);
    }

    public function flash_msg_notice($message)
    {
        Session::flash('notice_msg', $message);
    }
}