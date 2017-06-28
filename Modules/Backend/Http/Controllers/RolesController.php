<?php namespace Modules\Backend\Http\Controllers;

use App\Models\Role;

class RolesController extends AdminController
{

    function __construct()
    {
        parent::__construct();
        $this->set_middleware();
        $this->set_module('roles');
        view()->share('lang', $this->set_lang());
    }

    /**
     * Display a listing of the roles.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        return dd($this->get_auth_user());
        return view($this->view_index())
            ->with('route_create', $this->route_create())
            ->with('route_index', $this->route_index());
    }

    public function datatable()
    {
        $db = new \Illuminate\Support\Facades\DB;
        $db::statement($db::raw('set @rownum=0'));

        $data_module = Role::select(array(
            $db::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'app_key',
            'value',
            'orders'
        ));

        $data_tables = \Yajra\Datatables\Datatables::of($data_module);

        return $data_tables
            ->setRowId('id')
            ->addColumn('cmd',
                '<a href="{{ URL::route(\'roles.edit\', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
                 <a class="delete-row" href="javascript:void(0)"><i class="glyphicon glyphicon-remove"></i></a>')
            ->make(true);
    }

    /**
     * Show the form for creating a new roles.
     *
     * @return Response
     */
    public function create()
    {
        return view($this->view_create())
            ->with('route_create', $this->route_create())
            ->with('route_form', $this->route_store());
    }

    /**
     * Store a newly created roles in storage.
     *
     * @param CreaterolesRequest $request
     *
     * @return Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $input = $request->all();
        validator($input, $this->validate_rules())->validate();

        $input['images'] = trim($this->upload_images_main('images', $request, $this->module, [128, 85], false), ',');
        $input['app_key'] = $input['_token'];
        $input['created_by'] = $this->get_auth_user();
        $data_module = Role::_create($input);

        \Flash::message($this->lang['msg_success_new']);

        if (intval($input['publish']) == 1)
            return redirect(route($this->route_index()));
        else if (intval($input['publish']) == 2)
            return redirect(route($this->route_create()));
        else
            return view($this->view_create())
                ->with('route_form', $this->route_store())
                ->with('form_data', $input);
    }

    private function validate_rules()
    {
        return [
//            'app_key' => 'required|unique:roles,app_key',
            'value' => 'required|unique:roles,value',
            'orders' => 'required|numeric|min:0',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,gif,bmp'
        ];
    }

    /**
     * Display the specified roles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roles = $this->rolesRepository->findrolesById($id);

        if (empty($roles)) {
            Flash::error('roles not found');
            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('roles', $roles);
    }

    /**
     * Show the form for editing the specified roles.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $data_module = Role::_find_by_id($id);

        if (empty($language)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect(route($this->route_index()));
        }
        //return dd($language->created_at->format('d/m/Y'));
        return view($this->view_create())
            ->with('route_form', $this->route_update())
            ->with('route_create', $this->route_create())
            ->with('form_data', $data_module);
    }

    /**
     * Update the specified roles in storage.
     *
     * @param  int $id
     * @param CreaterolesRequest $request
     *
     * @return Response
     */
    public function update($id, \Illuminate\Http\Request $request)
    {
        $input = $request->all();
        validator($input, $this->validate_rules())->validate();
        $data_module = Role::_find_by_id($id);

        if (empty($language)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect(route($this->route_index()));
        }

        $input['images'] = $language->images;

        $image = trim($this->upload_images_main('images', $request, $this->module, [128, 85], false), ',');

        if ($image)
            $input['images'] = $image;

        $input['updated_by'] = 'admin';
        $data_module = Role::_update($language, $input);

        \Flash::message($this->lang['msg_success_update']);
        if (intval($input['publish']) == 1)
            return redirect(route($this->route_index()));
        else
            return redirect(route($this->route_edit(), [$id]));
    }

    /**
     * Remove the specified roles from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data_module = Role::_find_by_id($id);

        if (empty($data_module)) {
            \Flash::error($this->lang['msg_not_found']);
            return redirect(route($this->route_index()));
        }
        $data_module->delete();

        return response()->json($this->lang['msg_success_delete']);
    }
}
