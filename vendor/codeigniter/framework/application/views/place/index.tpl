{extends file='layouts/place.layout.tpl'}
{block name='content'}

{literal}
<script>
  var breadcrumb = [
  { 
    "name" : "Главная" ,
    "link" : "{/literal}{$base_url}{literal}",
    "icon" : "" 
  } , 
  { 
    "name" : "Объекты" ,
    "link" : "{/literal}{$base_url}{literal}place/",
    "icon" : "fa-cube fa" 
  }
];
</script>
{/literal}


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" id="h1"></h1>
        <ol class="breadcrumb"></ol>
    </div>
</div>

<div class="row">                     
  <div class="col-lg-4 animated fadeInUp" id="main_info"></div>
  <div class="col-lg-8 animated fadeInUp" id="meters"></div>
</div>

<div class="row">                            
  <div class="col-lg-4 animated fadeInUp"  id="users"></div>                    
  <div class="col-lg-8 animated fadeInUp" id="children_list"></div>   
</div>

<script>
  var place_id = {$place->id};
</script>


<script type="text/template" id="h1_tpl">
  {include file='place/helpers/h1.tpl'}
</script>


<script id="main_info_tpl" type="text/template">
  {include file="place/helpers/main_info.tpl"}
</script>


<script id="children_list_tpl" type="text/template">
  {include file="place/helpers/children_place.tpl"}
</script>

<script type="text/template" id="modal_edit_tpl">
  {include file="place/helpers/modal_edit.tpl"}
</script>

<script type="text/template" id="place_modal_delete_tpl">
  {include file="place/helpers/modal_delete.tpl"}
</script>

<script type="text/template" id="breadcrumb_tpl">
  {include file="place/helpers/breadcrumb.tpl"}
</script>
<script type="text/template" id="users_tpl">
  {include file="place/helpers/users.tpl"}
</script>
<script type="text/template" id="meters_tpl">
  {include file="place/helpers/meters.tpl"}
</script>

<script src="{$base_url}ts/models/place.js"></script>
<script src="{$base_url}ts/models/placetype.js"></script>
<script src="{$base_url}ts/collections/place.js"></script>
<script src="{$base_url}ts/collections/placetypes.js"></script>
<script src="{$base_url}ts/views/place/main_info.js"></script>
<script src="{$base_url}ts/views/place/modal_edit.js"></script>
<script src="{$base_url}ts/views/place/modal_delete.js"></script>
<script src="{$base_url}ts/views/place/children_list.js"></script>
<script src="{$base_url}ts/views/place/breadcrumb.js"></script>
<script src="{$base_url}ts/views/place/h1.js"></script>
<script src="{$base_url}ts/views/place/users.js"></script>
<script src="{$base_url}ts/views/place/meters.js"></script>
<script src="{$base_url}ts/views/place/place.js"></script>


{/block} 



