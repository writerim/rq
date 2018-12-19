<ul class="nav metismenu" id="side-menu">

    <li class="nav-header">
                <div class="dropdown profile-element">
                    <span class="fa fa-user rounded-circle" style="    font-size: 50px;
                            color: #fff;
                            text-align: center;
                            margin: 0 auto;
                            width: 100%;"></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"
                    style="text-align:center;">
                        <span class="block m-t-xs font-bold">{$self->login}<b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    RS
                </div>
            </li>


    <li  {if $active_menu == "places"}class="active"{/if}>
        <a href="{$base_url}place/">
            <i class="fa-cube fa"></i>  <span class="nav-label">Объекты</span>
        </a>
    </li>
    <li  {if $active_menu == "converters"}class="active"{/if}>
        <a href="{$base_url}converter/">
            <i class="glyphicon glyphicon-transfer fa-fw"></i> 
            <span class="nav-label">{$lang->line('converters')}</span>
        </a>
    </li>
    <li class="" id="meters_nav">
        <a href="" aria-expanded="false" >
            <i class="fa fa-flash"></i> 
            <span class="nav-label">Приборы учета</span> 
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
            <li><a href=""><i class="fa fa-tint"></i>Водосчетчики</a></li>
            <li><a href=""><i class="fa fa-fire "></i>Теплосчетчики</a></li>
            <li><a href=""><i class="fa fa-flash"></i>Элестросчетчики</a></li>
            <li><a href=""><i class="fa fa-sitemap"></i> Счетчики импульсов</a></li>
        </ul>
    </li>
    <li >
        <a href="{$base_url}reports/">
            <i class="fa fa-bar-chart-o fa-fw"></i> 
            <span class="nav-label">Отчеты</span>
        </a>
    </li>
    <li  {if $active_menu == "users"}class="active"{/if}>
        <a href="{$base_url}users/">
            <i class="fa fa-user fa-fw"></i> 
            <span class="nav-label">{$lang->line('users')}</span>
        </a>
    </li>
    <li {if $active_menu == "users"}class="rules"{/if} >
        <a href="{$base_url}rules/">
            <i class="fa fa-eye-slash fa-fw"></i> 
            <span class="nav-label">{$lang->line('rules')}</span>
        </a>
    </li>
</ul>

