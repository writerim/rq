<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content<% if( converter.get('id') ){ %>
      modal-info
      <% }else{ %>
      modal-success
      <% } %>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
          <% if( converter.get('id') ){ %>
          Редактирование
          <% }else{ %>
          Добавление
          <% } %>
      </h4>
  </div>
  <div class="modal-body">


    <div class="form-group type_group">                      
        <label class="control-label">Тип точки опроса<sup>*</sup></label>
        <select size="1" class="form-control" id="type">
            <% _.each( converter_types.toArray() , function( converter_type ){ %>
            <option value="<%= converter_type.get('id') %>"><%= converter_type.get('title') %></option>
            <% }) %>
        </select>
    </div>
    <div class="form-group ip_group">
        <label class="control-label ip_label" >Ip<sup>*</sup></label>                        
        <input  class="form-control" id="ip" value="<%= converter.get('ip') %>">
    </div>
    <div class="form-group port_group">
        <label class="control-label">Port<sup>*</sup></label>
        <input class="form-control" type="number" id="port" value="<%= converter.get('port') %>">
    </div>
    <div class="form-group about_group">
        <label class="control-label">Название<sup>*</sup></label>
        <input class="form-control" type="text" id="about" value="<%= converter.get('title') %>">
    </div>
    <div class="form-group">
        <label class="control-label">Включено в опрос</label>
        <div class="ckbx-style-8">
            <input type="checkbox" id="is_excluded" value="0" name="ckbx-style-8" 
            <% if( !converter.get('is_excluded') ){ %>checked<% } %>>
            <label for="is_excluded"></label>
        </div>
  </div>

  <div class="spoiler"><hr>
    <button type="button" class="btn btn-default btn-circle" id="converter_show_more">
      <i class="fa  fa-chevron-down"></i>
  </button>
</div>


<div id="more_info" style="display: none;">

<div class="form-group">
    <label class="control-label">Логин</label>
    <input  class="form-control" id="login" value="<%= converter.get('login') %>">
</div>


<div class="form-group">
    <label class="control-label">Пароль</label>
    <input  class="form-control" id="password" value="<%= converter.get('password') %>">
</div>

<div class="form-group">
    <label class="control-label">Порт для доступа к web интерфейсу</label>
    <input  class="form-control" id="portcontrol" value="<%= converter.get('portcontrol') %>">
</div>


</div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
  <button type="button" class="btn btn-disabled" id="save">Сохранить</button>
</div>
</div>
</div>
</div>
