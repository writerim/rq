{extends file='layouts/users.layout.tpl'}
{block name='content'}


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{$lang->line('users')}</h1>
        <ol class="breadcrumb material-breadcrumb">
            <li class="material-breadcrumb__item"><a href="/" class="material-breadcrumb__link">Главная</a></li>
            <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">
                <i class="fa fa-user fa-fw"></i>
                {$lang->line('users')}</span></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12  animated fadeInUp" id="user_list"></div>
</div>

<script type="text/template" id="user_list_tpl">
  {include file="users/helpers/list.tpl"}
</script>

<script src="{$base_url}ts/models/user.js"></script>
<script src="{$base_url}ts/collections/user.js"></script>
<script src="{$base_url}ts/views/user/helpers/list.js"></script>
<script src="{$base_url}ts/views/user/index.js"></script>

{/block}