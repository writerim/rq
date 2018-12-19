<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content<% if( rule.get('id') ){ %>
      modal-info
      <% }else{ %>
      modal-success
      <% } %>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
          <% if( rule.get('id') ){ %>
          Редактирование
          <% }else{ %>
          Добавление
          <% } %>
        </h4>
      </div>
      <div class="modal-body">


        <div class="form-group ip_group">
          <label class="control-label ip_label">Название<sup>*</sup></label>                        
          <input class="form-control" id="title" value="<%= rule.get('title') %>">
        </div>

        <table class="table">

          <thead>

            <tr>
              <th>Область</th>
              <th>Видимость</th>
              <th>Управление</th>
            </tr>

          </thead>
          <tbody>


            <% _.each( rule_description.toArray() , function( description , key ){ %>
              <tr>
                <td>
                  
                  <% if( description.get('object') == "places"){ %>
                    {$lang->line('places')}
                  <% }else if( description.get('object') == "converters"){ %>
                    {$lang->line('converters')}
                  <% }else if( description.get('object') == "rules"){ %>
                    {$lang->line('rules')}
                  <% }else if( description.get('object') == "users"){ %>
                    {$lang->line('users')}
                  <% }else if( description.get('object') == "meters"){ %>
                    {$lang->line('meters')}
                  <% } %>

                </td>


                <% var find_check = rule.get('description').findWhere( { object : description.get('object') } ) %>
                <% if( typeof find_check == "undefined" ){ find_check = (new RULE_DESCRIPTION_MODEL).toJSON() } %>

                <td>
                  <div class="form-group">
                    <div class="ckbx-style-8">
                      <input type="checkbox" id="<%= description.get('object') %>_view" value="0" name="ckbx-style-8"
                      <% if( find_check.get('view') ){ %>checked<% } %>
                      >
                      <label for="<%= description.get('object') %>_view"></label>
                    </div>
                  </div>
                </td>
                <td>

                  <div class="form-group">
                    <div class="ckbx-style-8">
                      <input type="checkbox" id="<%= description.get('object') %>_all" value="0" name="ckbx-style-8"
                      <% if( find_check.get('all') ){ %>checked<% } %>
                      >
                      <label for="<%= description.get('object') %>_all"></label>
                    </div>
                  </div>

                </td>
              </tr>
            <% }) %>

          
          </tbody>

        </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-disabled" id="save">Сохранить</button>
      </div>
    </div>
  </div>
</div>
