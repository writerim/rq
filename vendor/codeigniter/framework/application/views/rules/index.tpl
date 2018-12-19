{extends file="layouts/rules.layout.tpl"}
{block name='content'}

  

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{$lang->line('rules')}</h1>
        <ol class="breadcrumb material-breadcrumb">
            <li class="material-breadcrumb__item"><a href="/" class="material-breadcrumb__link">Главная</a></li>
            <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">
                <i class="fa fa-eye-slash fa-fw"></i>
                {$lang->line('rules')}</span></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12  animated fadeInUp" id="rule_list"></div>
</div>

<script type="text/template" id="rule_list_tpl">
  {include file="rules/helpers/list.tpl"}
</script>
<script type="text/template" id="rule_modal_edit_tpl">
  {include file="rules/helpers/modal_edit.tpl"}
</script>

<script type="text/template" id="rule_modal_delete_tpl">
  {include file="rules/helpers/modal_delete.tpl"}
</script>


<script src="{$base_url}ts/models/rule.js"></script>
<script src="{$base_url}ts/collections/rule.js"></script>
<script src="{$base_url}ts/views/rules/list.js"></script>
<script src="{$base_url}ts/views/rules/modal_edit.js"></script>
<script src="{$base_url}ts/views/rules/modal_delete.js"></script>
<script src="{$base_url}ts/views/rules/index.js"></script>


{/block}