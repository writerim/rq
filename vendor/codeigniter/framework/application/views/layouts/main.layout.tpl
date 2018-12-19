{include file="top.tpl"}

    {if !isset($active_menu)}
    {assign var="active_menu" value="place"}
    {/if}
    <div id="wrapper">



        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                {include file="menu.tpl"}
            </div>
        </nav>

    <script>
        var base_url = "{$base_url}";
    </script>

    <script type="text/javascript" src="{$base_url}ts/core/jquery.js"></script>
    <script type="text/javascript" src="{$base_url}ts/core/underscore.js"></script>
    <script type="text/javascript" src="{$base_url}ts/core/backbone.js"></script>
    <script type="text/javascript" src="{$base_url}ts/core/botstrtap.js"></script>
    <script type="text/javascript" src="{$base_url}ts/core/pagination.js"></script>
    <script>
        Backbone.emulateHTTP = true;
        Backbone.emulateJSON = true;
    </script>
    <script type="text/javascript" src="{$base_url}ts/menu.js"></script>


    <div id="page-wrapper" class="gray-bg">


        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                    <i class="fa fa-bars"></i> 
                    <div></div>
                </a>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="login.html">
                            <i class="fa fa-sign-out"></i> Выход
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        {block name="content"}
        Не получилось подгрузить модуль
        {/block}


        <br>
    </div>
</div>

{include file="footer.tpl"}