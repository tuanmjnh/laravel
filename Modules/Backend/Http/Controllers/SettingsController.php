<?php namespace Modules\Backend\Http\Controllers;

use App\Libraries\AAI\Repository;
use App\Libraries\Repositories\settingRepository;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends AdminController
{

    /** @var  settingRepository */
    private $settingRepository;

    function __construct(settingRepository $settingRepo)
    {
        parent::__construct();
        $this->set_middleware();
        $this->set_module('settings');
        view()->share('lang', $this->set_lang());
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $result = $this->settingRepository->search($input);

        $settings = $result[0];

        $attributes = $result[1];

        $s = new Setting();
        //$s->fillable();
        $s->SVSubApp = 'admin';
        $s->SVKey = 'setting';
        $s->SVSKey = 'theme';
        $s->SVValue = 'lighting';
        $s->SVDesc = 'This is lighting theme';
        //$array=array('SVSubApp'=>'admin','SVKey'=>'setting','SVSKey'=>'theme','SVValue'=>'lighting','SVDesc'=>'This is lighting theme');
        $array = array('SVSubApp' => 'admin', 'SVKey' => 'setting', 'SVSKey' => 'theme', 'SVValue' => 'default', 'SVDesc' => 'This is default theme');
        //$allsetting = $this->settingRepository->create($array);
        $allsetting = Setting::_find_by_fields(['app' => 'ghghk']); //$this->settingRepository->all([app,app_key ,sub_key ]);//['app','app_key ','sub_key ']
        return view($this->view_index())
            ->with('route_create', $this->route_create())
            ->with('route_index', $this->route_index())
            ->with('settings', $settings)
            ->with('attributes', $attributes);
    }

    /**
     * Show the form for creating a new setting.
     *
     * @return Response
     */
    public function create()
    {
        //flash()->overlay('setting saved successfully.','Notification');
        //\Flash::message('setting saved successfully.');
        //session()->flash('setting saved successfully.');
        //flash()->success('setting saved successfully.');
        return view($this->view_create())
            ->with('title', 'Thêm mới cài đặt');
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param CreatesettingRequest $request
     *
     * @return Response
     */
    public function store(CreatesettingRequest $request)
    {
        $input = $request->all();
        $setting = Setting::_create($input);
        \Flash::success('setting saved successfully.');
        return redirect(route($this->route_index()));
        //return redirect(route('default.settings.index'));
    }

    /**
     * Display the specified setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->settingRepository->findsettingById($id);

        if (empty($setting)) {
            flash()->error('setting not found');
            return redirect(route($this->route_index()));
        }

        return view($this->view_show())->with('setting', $setting);
    }

    /**
     * Show the form for editing the specified setting.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->findsettingById($id);

        if (empty($setting)) {
            flash()->error('setting not found');
            return redirect(route($this->route_index()));
        }

        return view($this->view_edit())->with('setting', $setting);
    }

    /**
     * Update the specified setting in storage.
     *
     * @param  int $id
     * @param CreatesettingRequest $request
     *
     * @return Response
     */
    public function update($id, CreatesettingRequest $request)
    {
        $setting = $this->settingRepository->findsettingById($id);

        if (empty($setting)) {
            flash()->error('setting not found');
            return redirect(route($this->route_index()));
        }

        $setting = $this->settingRepository->update($setting, $request->all());

        flash()->message('setting updated successfully.');

        return redirect(route($this->route_index()));
    }

    /**
     * Remove the specified setting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->findsettingById($id);

        if (empty($setting)) {
            flash()->error('setting not found');
            return redirect(route($this->route_index()));
        }

        $setting->delete();

        flash()->message('setting deleted successfully.');

        return redirect(route($this->route_index()));
    }

}
