<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content<% if( place.get('id') ){ %>
      modal-info
      <% }else{ %>
      modal-success
      <% } %>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
          <% if( place.get('id') ){ %>
            Редактирование
          <% }else{ %>
            Добавление
          <% } %>
        </h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label class="control-label">Тип<sup>*</sup></label>                                            
          <select class="form-control" id="place_type">
            <% _.each(place_types.toArray() , function(place_type){ %>
            <option value="<%= place_type.get('id') %>" 
              <% if( place_type.get('id') == place.get('type') ) { %>selected<% } %>
              ><%= place_type.get('title') %></option>
              <% }) %>
            </select>
          </div>

          <div class="form-group" id="place_form_title">
            <label class="control-label">Назвние<sup>*</sup></label>                                            

            <div class="form-group input-group">
              <span class="input-group-addon">
                <i id="place_type_helper"></i>
              </span>
              <input class="form-control" type="text" name="Title" placeholder="Название объекта" id="place_change_title" value="<%= place.get('title') %>">
            </div>
          </div>

          <% if( !place.get('id') ){ %>

          <div class="spoiler"><hr>
            <button type="button" class="btn btn-default btn-circle" id="place_show_more">
              <i class="fa  fa-chevron-down"></i>
            </button>
          </div>

          <div id="generator" style="display: none;">
            <br>
            <p>Генерирование по шаблону:</p>
            <div class="progress hide">
              <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="form-group">
              <label class="control-label">Кол-во</label>
              <input class="form-control" type="number" id="count_places" placeholder="">
            </div>
            <div class="form-group" id="result_prev" style="display: none;">
              <label class="control-label">Пример:</label>
              <div id="result"></div>
            </div>
          </div>

          <% } %>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-disabled" id="save">Сохранить</button>
        </div>
      </div>
    </div>
  </div>
