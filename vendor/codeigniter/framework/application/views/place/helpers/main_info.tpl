<div class="panel panel-default">
  <div class="panel-heading">Общая информация
    <span class="fa fa-pencil pull-right" id="edit_main_info"></span>
  </div>
  <div class="panel-body">
    <table class="table table-striped table-hover" id="place_item_info">
      <tbody>
        <tr>
          <td>Назвние</td>
          <td><%= place.escape('title') %></td>
        </tr>
        <tr>
          <td>Объектов</td>
          <td><%= place.get('places_all') %></td>
        </tr>
        <tr>
          <td>Приборов учета</td>
          <td><%= place.get('meters_all') %></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>