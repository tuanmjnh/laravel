<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{$asset_theme}}images/img.jpg" alt=""><span class="span-hiden">
                            {{empty(Auth::guard('admin')->user()->property_name)? Auth::guard('admin')->user()->username: Auth::guard('admin')->user()->property_name}}
                        </span>
                        <span class="span-hiden fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li><a href="/admin/auth/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="{{$asset_theme}}images/img.jpg"
                                                         alt="Profile Image"></span>
                                <span>
          <span>John Smith</span>
          <span class="time">3 mins ago</span>
      </span>
                                <span class="message">
          Film festivals used to be do-or-die moments for movie makers. They were where...
      </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{$asset_theme}}images/img.jpg"
                                                         alt="Profile Image"></span>
                                <span>
      <span>John Smith</span>
      <span class="time">3 mins ago</span>
  </span>
                                <span class="message">
      Film festivals used to be do-or-die moments for movie makers. They were where...
  </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{$asset_theme}}images/img.jpg"
                                                         alt="Profile Image"></span>
                                <span>
      <span>John Smith</span>
      <span class="time">3 mins ago</span>
  </span>
                                <span class="message">
      Film festivals used to be do-or-die moments for movie makers. They were where...
  </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{$asset_theme}}images/img.jpg"
                                                         alt="Profile Image"></span>
                                <span>
      <span>John Smith</span>
      <span class="time">3 mins ago</span>
  </span>
                                <span class="message">
      Film festivals used to be do-or-die moments for movie makers. They were where...
  </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="language-select">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                       title="{{$language_current['native_name'] or ''}}"
                       aria-expanded="false">
                        <img src="{{$images_path}}{{$language_current['images'] or ''}}"
                             alt="{{$language_current['native_name'] or ''}}">
                        <span class="span-hiden fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        @if(isset($language_all))
                            @foreach($language_all as $language)
                                <li>
                                    <a href="javascript:;" title="{{$language['native_name']}}"
                                       data-value="{{$language['lang_code']}}">
                                        <div class="image-lang"><img src="{{$images_path.$language['images']}}"></div>
                                        <div class="text-lang">{{$language['title']}}</div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>